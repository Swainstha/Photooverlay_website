<?php require_once '../includes/DbOperations.php'; ?>
<?php
if($_POST) {
  $db = new DbOperations();

  if ($db->userLogin1($_POST['email'],$_POST['password'])) {
    $user = $db->getUserByUserName1($_POST['email']);
    $ms=base64_encode(256);
    header('Location: display.php?ms='.urlencode($ms).'');
  } else {
    $meg=base64_encode('user input is wrong');
    header('Location: login.php?meg='.urlencode($meg).'');
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/jumbotron-narrow.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li class="active"><a href="">Home</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">TO Login</h3>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">
		<?php
		if(isset($_GET['meg'])) {
			if($_GET['meg']){
				$msg=base64_decode($_GET['meg']);
        echo $msg;
			}
		}
		?>
		 <form role="form" method="post">
			<div class="form-group">
				<label>Enter Email Address</label>
				<input name="email" type="text" class="form-control" placeholder="Email">
			</div>
			<div class="form-group">
				<label>Enter password</label>
				<input name="password" type="password" class="form-control" placeholder="password">
			</div>
			<input type="submit" class="btn btn-default" value="Login">
		</form>
		 </div>

      </div>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
