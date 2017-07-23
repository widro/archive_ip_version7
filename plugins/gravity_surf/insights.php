<?php
/*
Plugin Name: Gravity Surf
Plugin URI: http://gravity.com/
Description: Gravity Surf for Wordpress
Version: 1.4.0
Author: Gravity
Author URI: http://gravity.com
*/

if (!function_exists('add_action')) { // don't taze me bro!
  echo "Oh Haiz!  I is just a plugin.  Please don't call me directly. Kthxbye!";
  exit;
}

register_activation_hook(__FILE__, array('InsightsBase', '_install_grvplugin'));
register_deactivation_hook(__FILE__, array('InsightsBase', '_uninstall_grvplugin'));
add_filter('init', 'gravity_hook_crawler', 1);
add_action('init', 'gravity_hook_quest', 1);
add_action('wp_footer', 'gravity_hook_beacon', 1);
add_action('parse_query', 'gravity_hook_search');
add_action('comment_post', 'gravity_hook_comment', 1);
add_action('admin_init', 'gravity_hook_update_article', 1);
add_action('edit_post', 'gravity_hook_publish_article', 1);
add_action('user_register', 'gravity_hook_subscription', 1);
add_filter('the_content', 'gravity_hook_article_button', 1);
add_action('wp_footer', 'gravity_hook_magellan', 2);
?>
<?php
function insights_errhandle($log_level, $log_text, $error_file, $error_line) {
  if ($log_level == E_NOTICE) {
    return;
  }
  // try to log this issue
  $url = "http://insights.gravity.com/services/Event/log/?version=1&apikey=9z9djs9z";
  $url .= "&loglevel=" . urlencode(print_r($log_level, true)) . "&logtext=" . urlencode(print_r($log_text, true));
  $url .= "&get=" . urlencode(print_r($_GET, true)) . "&post=" . urlencode(print_r($_GET, true));
  $url .= "&server=" . urlencode(print_r($_SERVER, true));
  $url .= "&apptype=content_plugin";
  $url .= "&error_file=" . urlencode(print_r($error_file, true)) . "&errorline=" . urlencode(print_r($error_line, true));
  $file = @fopen($url, "r");
  @stream_set_timeout($file, 4);
}

?>
<?php
  /**
 * This class is written using php4 for maximum compat
 * @author Gravity Insights
 *
 */
class InsightsBase {
  var $baseVersion = '2.0.0';

  // stores the configuration settings for this plugin
  var $config = false;

  /**
   * endpoint we're connecting to make the get/posts
   * @var string
   */
  var $endpoint = 'api.gravity.com';
  var $honey = '/v1/insights/js/badger.cc.js';

  var $plugintype = 'content';
  var $action = '';
  var $site_guid = '';
  var $browser_useragent = '';
  var $url = '';
  var $referrer = '';
  var $ip = '';
  var $user_guid = '';
  var $external_user_id = 0;
  var $user_id = 0;
  var $username = '';
  var $subsite = '';
  var $article_id = 0;
  var $article_author_id = 0;
  var $article_title = '';
  var $article_categories = '';
  var $article_tags = '';
  var $comment_id = 0;
  var $payload = '';
  var $data = '';
  var $version = '';
  var $admin_button_state = '';

  /*
  * holds an array of forums that shouldn't be processed when posts are made
  * @var array - the exclusion list
  */
  var $hiddenForums = array();

  /*
  * constructor for plugin base class
  */
  function insightsBase() {
    if (!$this->config) {
      $this->_setConfiguration();
    }
  }

  /*
  * sets the plugin configuration
  */
  function _setConfiguration() {
    require(INSIGHTS_PLUGIN_ROOT . 'insightsconfig.php');
    $this->config = $insights_config;
    $this->site_guid = $this->config['site_guid'];
    $this->admin_button_state = $this->config['admin_button_state'];
    if (!empty($this->config['hidden_forums'])) {
      $this->hiddenForums = $this->config['hidden_forums'];
    }
  }

  /*
  * plugin activation method
  */
  function _install_grvplugin() {
    set_error_handler('insights_errhandle');
    delete_option('grv_allposts');
    delete_option('grv_active');
    $insights = new InsightsBase();
    $insights->username = urlencode("grvplugin");
    $insights->url = urlencode(get_bloginfo('url'));
    $insights->payload = urlencode("{ blogname: " . get_bloginfo('name') . ", url: " . get_bloginfo('url') . ", blogdesc: " . get_bloginfo('description') . ", admin_email: " . get_bloginfo('admin_email') . ", site_lang: " . get_bloginfo('language') . ", wpversion: " . get_bloginfo('version') . ", html_type: " . get_bloginfo('html_type') . ", rss_url: " . get_bloginfo('rss_url') . ", plugin_base_version: " . urlencode($insights->baseVersion) . ", plugin_platform version: " . urlencode(INSIGHTS_VERSION) . "}");
    $site_info = array();
    $site_info['phpinfo'] = $insights->grv_phpinfo_array(true);
    $site_info['server'] = $_SERVER;
    $site_info['curl'] = $insights->_verifyCurl();
    $insights->data = urlencode(serialize($site_info));
    $insights->_activatePlugin(); // engage!
    $insights->_setGrvOptions('grv_active', 1);
    restore_error_handler();
  }

  /*
  * plugin deactivation method
  */
  function _uninstall_grvplugin() {
    set_error_handler('insights_errhandle');
    $insights = new InsightsBase();
    $insights->username = urlencode("grvplugin");
    $insights->url = urlencode(get_bloginfo('url'));
    $insights->payload = urlencode("{ blogname: " . get_bloginfo('name') . ", url: " . get_bloginfo('url') . ", blogdesc: " . get_bloginfo('description') . ", admin_email: " . get_bloginfo('admin_email') . ", site_lang: " . get_bloginfo('language') . ", wpversion: " . get_bloginfo('version') . ", html_type: " . get_bloginfo('html_type') . ", rss_url: " . get_bloginfo('rss_url') . ", plugin_base_version: " . urlencode($insights->baseVersion) . ", plugin_platform version: " . urlencode(INSIGHTS_VERSION) . "}");
    if (get_option('grv_active') == "1") { // only send deactivate if plugin is active...
      $insights->_setGrvOptions('grv_active', 0); // set to inactive
      $insights->_deactivatePlugin(); // really bro?
    }
    restore_error_handler();
  }

  /*
  * set plugin options handler
  */
  function _setGrvOptions($option_name, $new_value) { // if doesn't exist, add new val, else, update with new val
    if (get_option($option_name) != $new_value) {
      update_option($option_name, $new_value);
    } else {
      add_option($option_name, $new_value, '', 'yes');
    }
  }

#  function _getGrvOptions($option_name) { // if option exists, return FALSE, else, return option
#    (get_option($option_name)) ? get_option($option_name) : FALSE; // return option value or NULL
#  }

	/*
	* remove plugin options handler
	*/
  function _delGrvOptions() { // deletes 1 or more options
    $args = func_get_args();
    $num = count($args);

    if ($num == 1) {
      return (delete_option($args[0]) ? TRUE : FALSE);
    }
    elseif (count($args) > 1) {
      foreach ($args as $option) {
        if (!delete_option($option))
          return FALSE;
      }
      return TRUE;
    }
    return FALSE;
  }

  /**
   * will determine if this forum should be hidden from insights or not
   * if the forum is ok to send, it will return false, other wise true means it's hidden
   * @param int $forumId
   */
  function _notHiddenForum($forumId) {
    if (in_array($forumId, $this->hiddenForums)) {
      return false;
    }
    return true;
  }

  function _setCookie() {
    $vaGuid = md5(uniqid("", TRUE));
    $vaGuid = strtolower($vaGuid);
    $expire = time() + 315360000;
    setcookie("grvinsights", $vaGuid, $expire, '/');
    return $vaGuid;
  }

  /*
  * verifies availability of cURL
  */
  function _verifyCurl() {
    $curl_func_status = TRUE;
    $curl_funcs = array('curl_init', 'curl_setopt_array', 'curl_exec', 'curl_close'); // array of curl functions we use
    foreach ($curl_funcs as $curl_func) { // verify availability of each curl function in use
      if (!function_exists($curl_func)) {
        $curl_func_status = FALSE;
        break;
      }
    }
    if (extension_loaded('curl') && $curl_func_status) {
      return "cURL: extension loaded and all functions available";
    } else {
      return "cURL: extension not loaded or some/all functions disabled";
    }
  }

  function _getBeaconCode() {
    if (defined('GRVINSIGHTS_BOARD_NAME')) {
      if (GRVINSIGHTS_BOARD_NAME != '') {
        $this->board = GRVINSIGHTS_BOARD_NAME;
      }
    }

    if ($this->site_guid == '@@SITE_GUID_GOES_HERE@@') {
      return "<div style='position:fixed;top:10px;background-color:gold;'>
                    <h1>YOU ARE USING AN INVALID INSIGHTS PLUGIN SITE GUID,
                      PLEASE VIEW THE README.txt FILE FOR INSTRUCTIONS</h1></div>";
    }

    $output = "<script type='text/javascript'>
            var gravityInsightsParams = new Object();
            gravityInsightsParams.v = '{$this->version}';
            gravityInsightsParams.type = '{$this->plugintype}';
            gravityInsightsParams.site_guid = '{$this->site_guid}';
            gravityInsightsParams.article_id = {$this->article_id};
            gravityInsightsParams.external_user_id = {$this->user_id};
            gravityInsightsParams.username = '{$this->username}';

            document.write(unescape('%3Cscript src=\'http://{$this->endpoint}{$this->honey}\' type=\'text/javascript\'%3E%3C/script%3E'));";
    $output .= "\n</script>";

    return $output;
  }

  function _activatePlugin() {
    $this->action = 'activate';
    $this->_post();
  }

  function _deactivatePlugin() {
    $this->action = 'deactivate';
    $this->_post();
  }

  function _publishArticle() {
    $this->action = 'publish';
    $this->_post();
  }

  function _deleteArticle() {
    $this->action = 'delete';
    $this->_post();
  }

  function _newSubscription() {
    $this->action = 'subscription';
    $this->_post();
  }

  function _newComment() {
    $this->action = 'comment';
    $this->_post();
  }

  function _search() {
    $this->action = 'search';
    $this->_post();
  }

  function _postFopen($queryStr) {
    $q = trim($queryStr);
    $url = "http://{$this->endpoint}/v1/beacons/?{$q}";
    $oldTimeout = ini_get('default_socket_timeout');
    ini_set('default_socket_timeout', 3);
    if ($fp = fopen($url, 'r')) {
      stream_set_blocking($fp, 0);
      $res = fread($fp, 1024);
    }
    ini_set('default_socket_timeout', $oldTimeout);
    $info = stream_get_meta_data($fp);
    if (@$info['timed_out'] || !$fp || is_null($info)) {
      $this->_handleTimeout($info, $res, $queryStr);
    }
  }

  function _post() {
    if (strstr($this->site_guid, '@')) {
      return;
    }
    $queryStr = $this->_generateQueryString();

    $curl_func_status = TRUE;

    if (!extension_loaded('curl')) {
      $curl_func_status = FALSE;
    }

    if ($curl_func_status) {
      $curl_funcs = array('curl_init', 'curl_setopt_array', 'curl_exec', 'curl_close'); // array of curl functions we use
      foreach ($curl_funcs as $curl_func) { // verify availability of each curl function in use
        if (!function_exists($curl_func)) {
          $curl_func_status = FALSE;
          break;
        }
      }
    }

    // if cURL extension loaded, and, all functions we use are available, use CURL to POST
    if ($curl_func_status) {
      $options = array(
        CURLOPT_POST => true, // yes, I'm sending post data
        CURLOPT_HEADER => false, // no, I don't want return headers
        CURLOPT_VERBOSE => true,
        CURLOPT_URL => "http://{$this->endpoint}/v1/beacons/?", // post request url
        CURLOPT_FRESH_CONNECT => false, // don't use cached version of url
        CURLOPT_RETURNTRANSFER => true, // yes, do not return web page directly - NECESSARY FOR ERROR HANDLER BELOW
        CURLOPT_FORBID_REUSE => true, // force the connection to explicitly close, and not be pooled for reuse.
        CURLOPT_TIMEOUT => 2, // only wait 2 seconds
        CURLOPT_POSTFIELDS => $queryStr // here's my dataz
      );

      $ch = curl_init();
      curl_setopt_array($ch, $options);
      if (curl_exec($ch) === false) {
        trigger_error(urlencode(INSIGHTS_VERSION) . " (" . curl_errno($ch) . ") " . curl_error($ch));
      }
      curl_close($ch);
    } else {
      // due to fsock lib issues, if the request is small enough, use GET
      if (strlen($queryStr) < 3000 && ini_get('allow_url_fopen') === '1') {
        $this->_postFopen($queryStr);
      } else if (function_exists("fsockopen")) {
        $postListener = "/v1/beacons/";
        $ip = gethostbyname($this->endpoint);
        $fp = fsockopen($ip, 80, $errno, $errstr, 4);
        if ($fp) {
          $out = "POST {$postListener} HTTP/1.1\r\n";
          $out .= "Host: {$this->endpoint}\r\n";
          $out .= "Content-type: application/x-www-form-urlencoded\r\n";
          $out .= "Content-Length: " . strlen($queryStr) . "\r\n";
          $out .= "Connection: Close\r\n\r\n";
          fwrite($fp, $out);
          fwrite($fp, $queryStr . "\r\n\r\n");
          stream_set_timeout($fp, 4);
          $res = fread($fp, 512);
          $info = stream_get_meta_data($fp);
          if ($info['timed_out']) {
            $this->_handleTimeout($info, $res, $queryStr);
          }
        } else {
          $this->_handleTimeout("TIMEOUT FP IS FALSE", $fp, $queryStr);
        }
        fclose($fp);
        // check response code:
        if (!strpos($res, '200 OK')) {
          trigger_error("Did not received a 200 OK Response: " . print_r($res, true) . "\n\nQUERY: " . $queryStr, E_USER_WARNING);
        }
      }
    }
  }

  function _generateQueryString() {
    $params = array();
    if (empty($this->user_guid)) {
      $params['user_guid'] = (empty($_COOKIE["grvinsights"])) ? "" : urlencode($_COOKIE["grvinsights"]);
    } else {
      $params['user_guid'] = $this->user_guid;
    }

    if ($this->action == 'publish') {
      $params['data'] = urlencode('{"pv":"' . $this->version . '"}');
    } else {
      $params['data'] = '';
    }

    if (defined('GRVINSIGHTS_BOARD_NAME')) {
      if (GRVINSIGHTS_BOARD_NAME != '') {
        $this->board = GRVINSIGHTS_BOARD_NAME;
      }
    }
    // href and referrer are set here so in case of bad data coming in we know
    // what site to contact to resolve the issue

    $params['type'] = $this->plugintype;
    $params['site_guid'] = $this->site_guid;
    $params['browser_useragent'] = $this->browser_useragent;

    if ($this->article_id) {
      $params['url'] = urlencode(get_permalink($this->article_id));
    } else {
      $params['url'] = (empty($_SERVER['HTTP_HOST'])) ? urlencode("http://" . $GLOBALS['domain']) : urlencode("http://" . $_SERVER['HTTP_HOST']);
    }

    $params['referrer'] = (empty($_SERVER['HTTP_REFERER'])) ? '' : urlencode($_SERVER['HTTP_REFERER']);
    $params['username'] = $this->username;
    $params['external_user_id'] = $this->external_user_id;
    $params['subsite'] = $this->subsite;
    $params['action'] = $this->action;
    $params['article_id'] = $this->article_id;
    $params['article_author_id'] = $this->article_author_id;
    $params['article_title'] = $this->article_title;
    $params['article_categories'] = $this->article_categories;
    $params['article_tags'] = $this->article_tags;
    $params['payload'] = $this->payload;
    $params['data'] = $this->data;

    $query = '';
    foreach ($params as $k => $v) {
      $query .= "{$k}={$v}&";
    }
    $query = trim($query, "&");
    return $query;
  }

  function _handleTimeout($meta, $res, $queryStr) {
    $server = print_r($_SERVER, true);
    $meta = print_r($meta, true);
    $result = print_r($res, true);
    // try to log this issue
    $url = "http://insights.gravity.com/services/Event/log/?version=1&apikey=9z9djs9z";
    $url .= "&server=" . urlencode($server) . "&response=" . urlencode($result) . "&meta=" . urlencode($meta) . "&query=" . urlencode($queryStr);
    $file = @fopen($url, "r");
    stream_set_timeout($file, 2);
  }

  /*
   * capture phpinfo into an array for debugging customer issues
   * @param $return set to TRUE for plugin to capture info
   */
  function grv_phpinfo_array($return = false) {
    ob_start();
    phpinfo(-1);

    $pi = preg_replace(
      array('#^.*<body>(.*)</body>.*$#ms', '#<h2>PHP License</h2>.*$#ms',
        '#<h1>Configuration</h1>#', "#\r?\n#", "#</(h1|h2|h3|tr)>#", '# +<#',
        "#[ \t]+#", '#&nbsp;#', '#  +#', '# class=".*?"#', '%&#039;%',
        '#<a>(?:.*?)" src="(?:.*?)=(.*?)" alt="PHP Logo" /></a>'
            . '<h1>PHP Version (.*?)</h1>(?:\n+?)</td></tr>#',
        '#<h1><a href="(?:.*?)\?=(.*?)">PHP Credits</a></h1>#',
        '#<tr>(?:.*?)" src="(?:.*?)=(.*?)"(?:.*?)Zend Engine (.*?),(?:.*?)</tr>#',
        "# +#", '#<tr>#', '#</tr>#'),
      array('$1', '', '', '', '</$1>' . "\n", '<', ' ', ' ', ' ', '', ' ',
        '<h2>PHP Configuration</h2>' . "\n" . '<tr><td>PHP Version</td><td>$2</td></tr>' .
            "\n" . '<tr><td>PHP Egg</td><td>$1</td></tr>',
        '<tr><td>PHP Credits Egg</td><td>$1</td></tr>',
        '<tr><td>Zend Engine</td><td>$2</td></tr>' . "\n" .
            '<tr><td>Zend Egg</td><td>$1</td></tr>', ' ', '%S%', '%E%'),
      ob_get_clean());

    $sections = explode('<h2>', strip_tags($pi, '<h2><th><td>'));
    unset($sections[0]);

    $pi = array();
    foreach ($sections as $section) {
      $n = substr($section, 0, strpos($section, '</h2>'));
      preg_match_all(
        '#%S%(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?%E%#',
        $section, $askapache, PREG_SET_ORDER);
      foreach ($askapache as $m)
        $pi[$n][$m[1]] = (!isset($m[3]) || $m[2] == $m[3]) ? $m[2] : array_slice($m, 2);
    }

    return ($return === false) ? print_r($pi) : $pi;
  }

}

if (!defined('INSIGHTS_PLUGIN_ROOT')) {
  define("INSIGHTS_PLUGIN_ROOT", ABSPATH . 'wp-content/plugins/gravity_surf/');
}

if (!defined('INSIGHTS_VERSION')) {
  define("INSIGHTS_VERSION", 'wp-1.4.0');
}

function gravity_get_user($current_user) {

  if ($current_user->ID == 0) { // check for logged in vs unregistered
    if (!empty($COOKIE['comment_author_email_' . COOKIEHASH])) { // try for cookie useremail
      $user_name = $COOKIE['comment_author_email_' . COOKIEHASH];
      $user_id = 0;
    } else {
      $user_name = 'Unregistered';
      $user_id = 0;
    }
  } else {
    $user_name = $current_user->user_login;
    $user_id = $current_user->ID;
  }
  return array('user_name' => $user_name, 'user_id' => $user_id);
}

function gravity_get_categories($post_categories) {
  global $wpdb;
  $i = 1; // init foreach counter
  $catnames = ''; // reset
  $cat_total = 0; // reset
  $cat_total = count($post_categories);
  if ($cat_total > 1) {
    foreach ($post_categories as $cat_id) {
      if ($cat_id) {
        if ($cat_total == $i) {
          $catnames .= get_cat_name($cat_id);
        } else {
          $catnames .= get_cat_name($cat_id) . ",";
        }
      }
      $i++;
    }
    $catnames = implode("|", explode(",", $catnames)); // format for beacon
  } else {
    $catnames = '';
    $cat_id = 0;
  }
  return $catnames;
}

function gravity_get_tags($post_tags) {
  if (!is_array($post_tags)) {
    $tags = implode("|", explode(",", $post_tags)); // format for beacon
  } else if (isset($post_tags['post_tag'])) {
    $tags = implode("|", explode(",", $post_tags['post_tag'])); // format for beacon
  } else {
    $tags = '';
  }
  return $tags;
}

function gravity_hook_beacon($content) {
  global $current_user, $wp_query, $post;

  set_error_handler('insights_errhandle');
  $user = gravity_get_user($current_user);

  if ($wp_query->is_single) {   // check for thread viewing -single page
    $article_id = (int) $post->ID;
  } else {
    $article_id = 0;
  }

  $insights = new InsightsBase();
  $insights->article_id = (int) $article_id;
  $insights->version = urlencode(INSIGHTS_VERSION);
  $insights->external_user_id = urlencode($user['user_id']);
  $insights->username = urlencode($user['user_name']);
  $output = $insights->_getBeaconCode();
  echo $output;
  restore_error_handler();
}

function gravity_hook_publish_article($article_id) {
  if (empty($_POST)){
    return;
  } else if (($_POST['post_type'] == 'post') && ($_POST['action'] == 'edit' || $_POST['action'] == 'editpost' || $_POST['action'] == 'post-quickpress-publish')) {

    if ($_POST['original_post_status'] !== NULL && $_POST['original_post_status'] !== 'publish' && $_POST['visibility'] !== "public" && $_POST['visibility'] !== NULL) {
      return; // bail: it wasn't previously published, and, it's not going to be public
    }
    set_error_handler('insights_errhandle');
    global $current_user;

    if (empty($article_id) && !empty($_POST['action'])) {
      if ($_POST['action'] == 'post-quickpress-publish') { //QUICKPRESS POST
        if (!$article_id) {
          $article_id = urlencode($_POST['quickpress_post_ID']);
        }
      } else if ($_POST['action'] == 'editpost') { //NORMAL POST
        $article_id = urlencode($_POST['post_ID']);
      }
    }

    $catnames = (isset($_POST['post_categories'])) ? gravity_get_categories($_POST['post_categories']) : gravity_get_categories($_POST['post_category']);
    $tags = (empty($_POST['tax_input']['post_tag'])) ? gravity_get_tags($_POST['tags_input']) : gravity_get_tags($_POST['tax_input']);

    $insights = new InsightsBase();
    $insights->version = urlencode(INSIGHTS_VERSION);
    $insights->browser_useragent = urlencode($_SERVER['HTTP_USER_AGENT']);
    $insights->username = urlencode($current_user->user_login);
    $insights->article_id = (int) $article_id;
    $insights->article_author_id = urlencode($current_user->ID);
    $insights->article_title = urlencode($_POST['post_title']);
    $insights->article_categories = urlencode($catnames);
    $insights->article_tags = urlencode($tags);
    $insights->payload = urlencode($_POST['content']);
    $insights->data = urlencode($_POST['post_status']) . ":" . urlencode($_POST['visibility']);

    if ($insights->_notHiddenForum($insights->forum_id)) {
      if ($_POST['action'] == "post-quickpress-publish") {
        $insights->data = urlencode($_POST['action'] . ":public");
        $insights->_publishArticle();
      } else if ($_POST['post_status'] == 'publish' && $_POST['visibility'] == "public") {
        $insights->_publishArticle();
      } else if (($_POST['post_status'] !== "publish" && $_POST['original_post_status'] == 'publish') || ($_POST['visibility'] !== "public")) {
        $insights->_deleteArticle();
      }
    }
    restore_error_handler();
  }
}

function gravity_hook_update_article() {
  if (isset($_REQUEST['trashed']) || isset($_REQUEST['_status'])) {

    set_error_handler('insights_errhandle');
    global $current_user;

    $insights = new InsightsBase();
    $insights->version = urlencode(INSIGHTS_VERSION);
    $insights->browser_useragent = urlencode($_SERVER['HTTP_USER_AGENT']);
    $insights->username = urlencode($current_user->user_login);
    $insights->article_author_id = urlencode($current_user->ID);
    $insights->data = urlencode("bulk_edit") . ":" . urlencode($_REQUEST['action']);

    $catnames = (isset($_REQUEST['post_categories'])) ? gravity_get_categories($_REQUEST['post_categories']) : gravity_get_categories($_REQUEST['post_category']);
    $tags = (empty($_REQUEST['tax_input']['post_tag'])) ? gravity_get_tags($_REQUEST['tags_input']) : gravity_get_tags($_REQUEST['tax_input']['post_tag']);

    if ($insights->_notHiddenForum($insights->forum_id)) {
      if ($_REQUEST['trashed'] > 1) { // doh! bulk delete!!
        $ids = explode(",", $_REQUEST['ids']); // explode string of article ID's into array
        foreach ($ids as $id) {
          $insights->url = urlencode(get_permalink($id)); // get the permalink url
          $insights->article_id = (int) $id;
          $insights->data = urlencode("bulk_edit:delete");
          $insights->_deleteArticle();
        }
      } else if ($_REQUEST['trashed'] == 1) {
        $insights->article_id = (int) $_REQUEST['ids'];
        $insights->url = urlencode(get_permalink($insights->article_id));
        $insights->data = urlencode("published:delete");
        $insights->_deleteArticle();
      }
      if (isset($_REQUEST['_status'])) {
        foreach ($_REQUEST['post'] as $id) {
          $curr_status = get_post_status($id);
          $insights->url = urlencode(get_permalink($id));
          $insights->article_id = (int) $id;
          $insights->article_categories = urlencode(gravity_get_categories($catnames));
          $insights->article_tags = urlencode(gravity_get_tags($tags));
          if ($_REQUEST['_status'] == "publish" && $_REQUEST['_status'] != $curr_status) {
            $insights->data = urlencode("bulk_edit:publish");
            $insights->_publishArticle();
          } else if ($curr_status == "publish" && $_REQUEST['_status'] == "-1") {
            $insights->data = urlencode("bulk_edit:publish");
            $insights->_publishArticle();
          } else if ($curr_status == "publish" && $_REQUEST['_status'] !== "-1" && $curr_status != $_REQUEST['_status']) {
            $insights->data = urlencode("bulk_edit:delete");
            $insights->_deleteArticle();
          } else if ($curr_status != "publish" && $_REQUEST['_status'] != 'publish') {
            return; //do nada
          }
        }
      }
    }
    restore_error_handler();
  }
}

function gravity_hook_comment($comment_id) {
  global $commentdata, $current_user;

  if ($current_user->ID == 0) { // check for logged in vs unregistered
    $user_name = $commentdata['comment_author_email'];
    $user_id = (is_null($commentdata['user_ID'])) ? 0 : $commentdata['user_ID'];
  } else {
    $user_name = $current_user->user_login;
    $user_id = $current_user->ID;
  }

  set_error_handler('insights_errhandle');
  $insights = new InsightsBase();
  $insights->version = urlencode(INSIGHTS_VERSION);
  $insights->browser_useragent = urlencode($_SERVER['HTTP_USER_AGENT']);
  $insights->external_user_id = (int) $user_id;
  $insights->username = urlencode($user_name);
  $insights->article_id = (int) $commentdata['comment_post_ID'];
  $insights->comment_id = (int) $comment_id;
  $insights->payload = urlencode($commentdata['comment_content']);
  $insights->email = urlencode($commentdata['comment_author_email']);
  $insights->poster_ip = $_SERVER['REMOTE_ADDR'];
  if ($insights->_notHiddenForum($insights->forum_id)) {
    $insights->_newComment();
  }
  restore_error_handler();
}

function gravity_get_search_terms() {
  global $wp_query;
  $query = '';

  if (isset($wp_query->query_vars['s'])) {
    $query = $wp_query->query_vars['s'];
  } else if (!empty($_REQUEST['s'])) {
    $query = $_REQUEST['s'];
  } else if (!empty($_REQUEST['search_term'])) {
    $query = $_REQUEST['search_term'];
  } else if (!empty($_GET['s'])) {
    $query = $_GET['s'];
  }
  return $query;
}

function gravity_hook_search($the_search_form) {
  global $current_user, $wp_query;

  if (($wp_query->is_search) && (!empty($the_search_form->query['s']))) {
    set_error_handler('insights_errhandle');
    // check for logged in vs unregistered
    $user = gravity_get_user($current_user);
    $search_terms = gravity_get_search_terms();
    $insights = new InsightsBase();
    $insights->version = urlencode(INSIGHTS_VERSION);
    $insights->browser_useragent = urlencode($_SERVER['HTTP_USER_AGENT']);
    $insights->external_user_id = (int) $user['user_id'];
    $insights->username = urlencode($user['user_name']);
    $insights->payload = urlencode($search_terms);
    $insights->_search();
    restore_error_handler();
  }
}

function gravity_hook_subscription($user_id) {
  ($user_id) ? $user = new WP_User($user_id) : $user_id = 0;

  if ($user_id && $_REQUEST['action'] == "register") {
    set_error_handler('insights_errhandle');
    $insights = new InsightsBase();
    $insights->version = urlencode(INSIGHTS_VERSION);
    $insights->browser_useragent = urlencode($_SERVER['HTTP_USER_AGENT']);
    $insights->external_user_id = (int) $user_id;
    $insights->username = urlencode($user->user_login);
    $insights->payload = urlencode($user->roles[0]);
    $insights->_newSubscription();
    restore_error_handler();
  }
}

function gravity_hook_article_button($content) {
  global $wp_query;

  set_error_handler('insights_errhandle');
  $insights = new InsightsBase();

  if ($insights->admin_button_state && $wp_query->is_single) {
    $content .= "<p><a id=\"magellan\"></a><p>";
  }
  restore_error_handler();
  return $content;
}

function gravity_hook_magellan() {
  global $wp_query;

  set_error_handler('insights_errhandle');
  $insights = new InsightsBase();

  if ($insights->admin_button_state && $wp_query->is_single) {
    echo "<script type='text/javascript' src='http://www.gravity.com/assets/js/magellan.js'></script>";
  }
  restore_error_handler();
}

function gravity_hook_quest() {
  if (!$_SERVER['REQUEST_URI'] == "/quest" || !$_SERVER['REQUEST_URI'] == "/?quest=1") {
    return;
	} else if ($_SERVER['REQUEST_URI'] == "/quest" || $_SERVER['REQUEST_URI'] == "/?quest=1") {
    set_error_handler('insights_errhandle');
    $insights = new InsightsBase();
    $site_guid = $insights->site_guid;
    $host = $_SERVER['HTTP_HOST'];
    $canvas = <<<MAGELLAN
    <!doctype html>

    <title>The Best of {$_SERVER['HTTP_HOST']}</title>
    <style>
    * { margin: 0; padding: 0; }
    body { overflow: hidden; background: transparent; }
    iframe { border: 0; width: 100%; }
    </style>
    <body>
    <script src="http://code.jquery.com/jquery-1.4.4.min.js" charset="utf-8"></script>
    <script type="text/javascript" charset="utf-8">
      var cookie = document.cookie.match('(?:^|;) ?grvinsights=([^;]*)(?:;|$)');
      insights = cookie ? cookie[1] : (location.href = "/");
      $('body').append('<iframe id="canvas_frame" src="http://www.gravity.com/canvas?h=$host&s=$site_guid&u='+insights+'" frameborder="0" allowtransparency="true"></iframe>');
      function resize() { $('iframe').css('height', $(window).height()); }
      $(window).resize(function() { resize(); });
      resize();
    </script>
MAGELLAN;

    echo $canvas;
    restore_error_handler();
    exit;
  }
}

function gravity_hook_crawler() {
  if (!isset($_SERVER['HTTP_GRVCRAWLER']) || !isset($_GET['grvcrawler'])) {
    return;
  } else if (isset($_SERVER['HTTP_GRVCRAWLER']) && isset($_GET['grvcrawler'])) {
    global $wpdb;
    set_error_handler('insights_errhandle');
    $lower = ((((int) $_SERVER['HTTP_GRVPAGE'] * (int) $_SERVER['HTTP_GRVPOSTS']) - (int) $_SERVER['HTTP_GRVPOSTS']) + 1);
    $upper = (((int) $_SERVER['HTTP_GRVPOSTS']));
    ($lower == 1) ? ($lower = 0) : ($lower = $lower);
    $posts = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC LIMIT $lower, $upper"));
    $post_max = count($posts); // get max posts returned
    $tag_counter = 0; // reset tag counter
		header("Content-type: text/xml; charset=utf-8");
?>
<?php echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n"; ?>
<rss version="2.0">
<channel>
  <title type="text">grvcrawler</title>
	<link><?=get_bloginfo('url')?></link>
	<description>grvcrawler helps gravity surf personalize your site for visitors</description>
	<pubDate><?=date("r");?></pubDate>
	<gravity type="scraper">
	<results_on_page><?=$post_max?></results_on_page>
	<posts>
<?php foreach ($posts as $post) {
	$tags = get_the_tags($post->ID);
  if($tags){
    $tag_max = count($tags);
    $tag_counter = 1; $post_tags = '';
    foreach ($tags as $tag) {
      if ($tag_counter == $tag_max) {
        $post_tags .= $tag->name;
      } else {
        $post_tags .= $tag->name . "|";
      }
      $tag_counter++;
    }
	}
?>
		<item>
			<pubDate><?php echo $post->post_date;?></pubDate>
  			<title><![CDATA[<?php echo htmlspecialchars($post->post_title, ENT_QUOTES);?>]]></title>
  			<link><![CDATA[<?php echo get_permalink($post->ID);?>]]></link>
			<content><![CDATA[<?php echo $post->post_content;?>]]></content>
			<tags><![CDATA[<?php echo $post_tags;?>]]></tags>
			<category><![CDATA[]]></category>
		</item>
<?php } ?>
	</posts>
	</gravity>
</channel>
</rss>
<?php
    restore_error_handler();
    exit;
  }
}