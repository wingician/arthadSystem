<?php
function loadCustomTemplate($template) {
global $wp_query;
if(!file_exists($template))return;
$wp_query->is_page = true;
$wp_query->is_single = false;
$wp_query->is_home = false;
$wp_query->comments = false;
// if we have a 404 status
if ($wp_query->is_404) {
// set status of 404 to false
unset($wp_query->query["error"]);
$wp_query->query_vars["error"]="";
$wp_query->is_404=false;
}
// change the header to 200 OK
header("HTTP/1.1 200 OK");
//load our template
include($template);
exit;
}
function templateRedirect() {
$basename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
loadCustomTemplate(TEMPLATEPATH.'/custom/'."/$basename.php");
}
add_action('template_redirect', 'templateRedirect');
?>
