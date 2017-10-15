<?php
require_once '../includes/DbOperationsElection.php';
$response = array();
session_start();
if($_SERVER['REQUEST_METHOD']=='POST') {
		$db = new DbOperationsElection();
		$id = $_POST['user_id'];
		$result = $db->createUser(
			$id,$_POST['name'], $_POST['link'], $_POST['gender'],$_POST['zone'],$_POST['district'],$_POST['person']);
		$str = 'http://graph.facebook.com/' . $_POST['link'] . '/picture?type=large&height=500&width=500';
		//copy($str, 'image1.jpeg');

		if($result == 1){
			$response['error'] = false;
			$response['message'] = "User Registered Successfully";
		} elseif($result == 2) {
			$response['error'] = true;
			$response['message'] = "Some error ocurred please try again";

		} elseif($result == 0) {
			$response['error'] = true;
			$response['message'] = "It seems you are already registered, please choose a different email and username";
	 	}
} else {
	echo 'man girl';
	$response['error'] = true;
	$response['message'] = "Invalid Request";
}
echo json_encode($response);

?>
