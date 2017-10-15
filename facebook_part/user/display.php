<?php
include('../includes/database.php');
//require_once '../includes/DbOperations.php';
?>
<?php
  //$db = new DbOperations();

	 $query ='SELECT * FROM data';
	 $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>detail</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap1.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../css/jumbotron1-narrow.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li class="active"><a href="">Home</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">all</h3>
      </div>

      <div class="row marketing">
        <div class="col-lg-12">

         <h2>Customers</h2>
		 <table class="table table-striped">
			<tr>
				<th>Imgae</th>
				<th>Name</th>
				<th>User Id</th>
				<th>Gender</th>
				<th>Choose</th>
			</tr>
			<?php
			//check if atleast one row is found
			if($_GET['ms']) {
				$ms=base64_decode($_GET['ms']);
				if($ms==256) {
					if($result->num_rows >0){
						//loop through results
						while($row = $result->fetch_assoc()){
							//Display customer info
							$output ='<tr>';
							$image = '../pictures/uploads/'.$row['name'].'.jpg';
							$output .='<td><img src ="'.$image.'" height=40px width=40px></td>';
							$output .='<td>'.$row['name'].'</td>';
							$output .='<td>'.$row['user_id'].'</td>';
							$output .='<td>'.$row['gender'].'</td>';
							$output .='<td>'.$row['choose'].'</td>';
							//$output .='<td><a href = "edit_customer.php?id='.$row['id'].'" class="btn btn-default btn-sm">Edit</a></td>';
							//$output .='<td><a href = "delete_customer.php?id='.$row['id'].'"class="btn btn-default btn-sm">Delete</a></td>';
							$output .='</tr>';

							//echo output
							echo $output;
						}
					} else {
						echo "sorry, no customers were found";
					}
				} else {
					$meg=base64_encode('trying to be hero');
					header('Location: login.php?meg='.urlencode($meg).'');
					exit;
				}
			} else {
				$meg=base64_encode('trying to be hero');
				header('Location: login.php?meg='.urlencode($meg).'');
				exit;
			}
			?>
		</table>
		 </div>

      </div>

      <footer class="footer">
        <p>&copy; 2016 Company, Inc.</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
