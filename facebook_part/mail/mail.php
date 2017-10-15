<?php 
if(isset($_POST))
{
	$email=$_POST['email'];
	$comment=$_POST['comment'];
	$headers = "From: photooverlay@photooverlay.com";
	
	if (($email != "" )&&( $comment !=""))
	{
		mail($email,"Reply To Your Post",$comment,$headers);
		echo "done";
	} else {
		header('Location: first.php');
	}
	
}
?>

