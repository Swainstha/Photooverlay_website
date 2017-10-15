<?php
session_start();
require_once('Facebook/autoload.php' );//include facebook api library

######### edit details ##########
$appId = '215024412304823'; //Facebook App ID
$appSecret = 'eef9340f71cfd805710d3bf124fb7518'; // Facebook App Secret
$return_url = 'http://photooverlay.com/test/process.php';  //return url (url to script)
$homeurl = 'http://photooverlay.com/process.php';  //return to home
$fbPermissions = 'publish_actions, user_photos, public_profile';  //Required facebook permissions
##################################

if(isset($_GET['name'])){
	$_SESSION["pic_id"] = $_GET['name']; // Picture ID from Index page
}
$PicLocation = 'merged/'.$_SESSION["pic_id"].'.jpg';
$fb = new Facebook\Facebook([
  'app_id' => $appId,
  'app_secret' => $appSecret,
  'default_graph_version' => 'v2.4',
	'persistent_data_handler'=>'session'
]);

//try to get access token
try{
	$helper = $fb->getRedirectLoginHelper();
	$session = $helper->getAccessToken();
}catch(FacebookRequestException $ex){
	die(" Facebook Message: " . $ex->getMessage());
} catch(Exception $ex){
	die( " Message: " . $ex->getMessage());
}

//get picture ready for upload
$data = ['message' => '','source' => $fb->fileToUpload($PicLocation)];

//try upload photo to facebook wall
if($session){
	try{
		$photo_response = $fb->post('/me/photos', $data, $session);
		$graph_node = $photo_response->getGraphNode();
	} catch(FacebookRequestException $ex){
		die(" Facebook Message: " . $ex->getMessage());
	} catch(Exception $ex){
		die( " Message: " . $ex->getMessage());
	}
}else{
	//if login requires redirect user to facebook login page
	$login_url = $helper->getLoginUrl($return_url, array('scope'=> $fbPermissions));
	header('Location: '. $login_url);
	exit();
}

if(isset($graph_node["id"]) && is_numeric($graph_node["id"]))
{
	$str='http://m.facebook.com/photo.php?fbid='.$graph_node["id"].'&prof=1';
	header('Location: '.$str);
	exit();
}
?>
