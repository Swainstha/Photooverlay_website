<?php
  session_start();
  include('includes/database2.php');
  $theme = $_GET['theme'];
  if($theme=='flags') {
    $flagname = $_GET['flagname'];
  } else if($theme=='election') {
    $zone=$_GET['zone'];
    $district=$_GET['district'];
    $person = $_GET['person'];
    $query3 = "SELECT * FROM person WHERE image_name='".$person."'"; //defining variable with sql code to select data
    $check3 = $mysqli->query($query3) or die($mysqli->error.__LINE__);//mysqli object has query to select data(query3)
    $name=$check3->fetch_assoc(); //get data[here maybe row]
    $first_name= $name['first_name'];
	  $middle_name=$name['middle_name'];
	  $last_name=$name['last_name'];
    $city = $name['city'];
    $_SESSION['count']=$name['counter'];
    $_SESSION['person']=$person;
  if(strlen($middle_name)>1) {
    $final_name=$first_name." ".$last_name;
  } else {
    $final_name=$first_name." ".$middle_name." ".$last_name;
  }

  }



?>
<!DOCTYPE html>
<html>

<head>
    <title>Photooverlay - Bring your photos to life</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:site_name" content="photoverlay.com">
    <meta  property="og:url"           content="http://www.photooverlay.com/test/first.php" />
    <meta  property="og:type"          content="website" />
    <meta  property="og:title"         content="" />
    <meta  property="og:description"   content="" />
    <meta  property="og:image"         content="http://www.photooverlay.com/test/pictures/flags/finland.png" />
    <meta  property="fb:app_id"        content="436422293368977" />
    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="../css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/freelancer.min.js"></script>
    <style>
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid blue;
  border-right: 16px solid green;
  border-bottom: 16px solid red;
  border-left: 16px solid pink;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>

<body>

    <script type="text/javascript">
    var img= "";
    var theme = "<?php echo $theme ?>";
    var first_name = "";
    if(theme == "flags") {
      var flagname = "<?php echo $flagname ?>";
      var p1 = " I voted. Click here to add an overlay to your profile picture.";
      var p2 = "";

      var p4 = "http://photooverlay.com/test/vote.html";

    } else if(theme == "election") {
      var zone = "<?php echo $zone ?>";
      var district = "<?php echo $district ?>";
      var person = "<?php echo $person; ?>";
      var fullname = "<?php echo $final_name?>";
      var p1 = "Vote " + fullname + " for Mayor of " + "<?php echo $city?>";
      var p2 = "I support " + fullname + " What about yuh?";

      var p4 = "http://photooverlay.com/test/first.php?theme=election&zone=" + zone + "&district=" + district + "&person=" + person;
      console.log(fullname);
    }
        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                winclose();
                getFBData();
                if(theme=="flags") {

                  getInfo();
                } else if(theme=="election") {

                  getInfo1();
                }
                sendData();
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
                    console.log("nonono");
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
                console.log("not Logged in");
                winopen();
            }
        }

        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            }, {
                scope: 'id,link,name,first_name,last_name,user_photos,picture,gender,email'
            });
        }


        function getFBData() {
            FB.api('/me', function(response) {
                console.log("1");
                var im1 = document.getElementById("profileImage").setAttribute("src", "http://graph.facebook.com/" + response.id + "/picture?type=small");
                var im2 = document.getElementById("showImage").setAttribute("src", "http://graph.facebook.com/" + response.id + "/picture?type=large&width=500&height=500");
                document.getElementById("username").innerHTML = response.name;

            });
        }

        function getInfo() {
          console.log("2");
            try {
                var support = "<?php echo $flagname?>";
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "v1/registerUser.php", true);
            } catch (e) {
                console.log(e.message);
            }
            FB.api('/me', {
                    fields: 'id,link,name,picture,first_name,last_name,gender,email'
                },
                function(response) {
                    //var im = document.getElementById("profileImage").setAttribute("src", "http://graph.facebook.com/" + response.id + "/picture?type=normal");
                    var c = document.getElementById("phpImage").setAttribute("href", "http://photooverlay.com/test/process.php?name=" + response.id + "&flagname=" + flagname);
                    console.log(response.id);
                    var im = document.getElementById("username").setAttribute("href", "http://facebook.com/" + response.id);
                    var im = "http://graph.facebook.com/" + response.id + "/picture?type=large&height=500&width=500";
                    /*var str = JSON.stringify(response.location);
                    var res = str.split("\"");
                    var loc = res[7];
                    var a = loc.split(",");
                    var loc_city = a[0];
                    var loc_country = a[1];


                    var str = JSON.stringify(response.hometown);
                    var res = str.split("\"");
                     var loc = res[7];
                    var a = loc.split(",");
                    var home_city = a[0];
                    var home_country = a[1];*/

                    console.log("user_id=" + response.id + "&link=" + im + "&name=" + response.name  + "&gender=" + response.gender + "&image=" + support);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("user_id=" + response.id + "&link=" + im + "&name=" + response.name  + "&gender=" + response.gender + "&image=" + support);
                });

        }
        function getInfo1() {
          console.log("2");
            try {
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "v1/registerUserElection.php", true);
            } catch (e) {
                console.log(e.message);
            }
            FB.api('/me', {
                    fields: 'id,link,name,picture,first_name,last_name,gender'
                },
                function(response) {
                    //var im = document.getElementById("profileImage").setAttribute("src", "http://graph.facebook.com/" + response.id + "/picture?type=normal");
                    var c = document.getElementById("phpImage").setAttribute("href", "http://photooverlay.com/test/process.php?name=" + response.id + "&zone=" + zone + "&district=" + district + "&person=" +person);
                    var im = "http://graph.facebook.com/" + response.id + "/picture?type=large&height=500&width=500";
                    var im1 = document.getElementById("username").setAttribute("href", "http://facebook.com/" + response.id);
                    console.log("user_id=" + response.id + "&link=" + im + "&name=" + response.name  + "&gender=" + response.gender + "&zone=" + zone + "&district=" + district + "&person=" + person);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("user_id=" + response.id + "&link=" + im + "&name=" + response.name  + "&gender=" + response.gender + "&zone=" + zone + "&district=" + district + "&person=" + person);
                });
        }

        function sendData() {
            try {
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "merge.php", true);
            } catch (e) {
                console.log(e.message);
            }
            FB.api('/me', {
                    fields: 'id,link,name,picture,first_name,last_name'
                },
                function(response) {
                    first_name = response.id;
                    console.log(first_name);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    if(theme=="flags") {
                      xhttp.send("link=" + response.id + "&name=" + response.id + "&theme=" + theme + "&flagname=" + flagname );
                      img = "pictures/merged/" + response.id + flagname + ".jpg";
                      console.log("link=" + response.id + "&name=" + response.id + "&theme=" + theme + "&flagname=" + flagname );
                    }
                    else if(theme=="election") {
                      xhttp.send("link=" + response.id + "&name=" + response.id + "&theme=" + theme + "&zone=" + zone + "&district=" + district + "&person=" + person );
                      img = "pictures/merged/" + response.id + person;
                      console.log("link=" + response.id + "&name=" + response.id + "&theme=" + theme + "&zone=" + zone + "&district=" + district + "&person=" + person );
                    }
                    console.log(img);
                    while (imageExists(img) == 0);
                    document.getElementById("loading").style.display = "none";
                    var im = document.getElementById("mergedImage").setAttribute("src", img );
                });
        }

        function makeProfPic() {

            try {
                  var xhttp = new XMLHttpRequest();
                  xhttp.open("POST", "update_count.php", true);
                  console.log("yes");
                  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhttp.send("t=oye");
                } catch(e){}
                  if(theme=="flags") {
                    var a = "http://photooverlay.com/test/process.php?name=" + first_name + "&flagname=" + flagname;
                  } else if(theme=="election") {
                    var a = "http://photooverlay.com/test/process.php?name=" + first_name + "&zone=" + zone + "&district=" + district + "&person=" +person;
                  }
                  console.log(a);
                  window.open(a, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=500,height=500");

        }

        function winclose() {
            document.getElementById("fuck").style.display = "none";
            document.getElementById("zeus").style.display = "block";
        }

        function winopen() {
            document.getElementById("fuck").style.display = "block";
            document.getElementById("zeus").style.display = "none";
        }

        function imageExists(image_url) {

            var http = new XMLHttpRequest();

            http.open('HEAD', image_url, false);
            http.send();

            return http.status != 404;

        }

        function displaypic() {
          winclose();
          getFBData();
          if(theme=="flags") {
            getInfo();
          } else if(theme=="election") {
            getInfo1();
          }
          sendData();
        }

        function dontShareInFB() {
          document.getElementById("posting").style.display = "none";
          document.getElementById("sharing").style.display = "block";
        }

        function shareInFB() {
          var p3="";
              if(theme=="flags") {
                p3 = "http://photooverlay.com/test/pictures/share/" + first_name + flagname + ".png";

              } else if(theme=="election") {
                console.log("not okay");
                p3 = "http://photooverlay.com/test/pictures/share/" +  first_name + person;
              }
              document.getElementById("posting").style.display = "block";
              document.getElementById("sharing").style.display = "none";
            console.log(p3);
          FB.ui({
              method: 'feed',
              link: p4,
              caption: '',
              description: p2,
              name: p1,
              picture: p3
            }, function(response){
                //makeProfPic();
            });
          }

        window.fbAsyncInit = function() {
            FB.init({
                appId: '436422293368977',
                cookie: true, // enable cookies to allow the server to access
                // the session
                xfbml: true, // parse social plugins on this page
                version: 'v2.8' // use graph api version 2.8
            });

            // Now that we've initialized the JavaScript SDK, we call
            // FB.getLoginStatus().  This function gets the state of the
            // person visiting this page and can return one of three states to
            // the callback you provide.  They can be:
            //
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into
            //    your app or not.
            //
            // These three cases are handled in the callback function.

            FB.getLoginStatus(function(response) {
              console.log(response);
                statusChangeCallback(response);
            });

        };

        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.
        function testAPI() {
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me', function(response) {
                console.log('Successful login for: ' + response.name);

            });
        }
    </script>

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="../">Photo Overlay</a>
                <img class="image-responsive" id="profileImage" src=""></img>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                  <li class="hidden">
                      <a href="#page-top"></a>
                  </li>
                  <li class="page-scroll">
                    <a id="username" href=""></a>
                  </li>
                    <li class="page-scroll">
                        <a href="../#portfolio">Templates</a>
                    </li>
                    <li class="page-scroll">
                        <a href="../photo_new/front.html">Customize</a>
                    </li>
                    <li class="page-scroll">
                        <a href="../#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div id="fuck" class="section" style="padding-top:70px">
      <br>
      <br>
      <br>
      <br>
        <div class="wrapper container text-center" style="color:gray;font-size:12px;">
            <div class="fb-login-button" data-max-rows="1"  data-show-faces="true" data-auto-logout-link="false" data-scope="basic_info" data-size="xlarge" onlogin="displaypic()">
            </div>
        </div>
    </div>
    <br>
    <br>
    <div id="zeus" style="display:none">
      <br><br><br>
    <!--  <div class="col-md-6" style="text-align:center;padding-top:10px;">
          <a href="../photo_new/front.html" class="btn btn-primary btn-block">Make Your Own Overlay</a>
      </div>
      <div class="col-md-6" style="text-align:center;padding-top:10px;">
          <a href="flags.html" class="btn btn-primary btn-block">Click here to choose a different template</a>
      </div>-->
    <div class="row">
      <div class="col-md-6" style="margin:auto;padding-top:20px;">
          <img id="showImage" style="margin:0 auto;" class="img-responsive" width="500" height="500" src="" />
      </div>
        <div class="col-md-6" style="margin:auto;padding-top:20px;">
            <div id="loading" class="loader" style="text-align:center;margin:0 auto;margin-top:200px;margin-bottom:200px;"></div>
            <img id="mergedImage" style="margin:0 auto;" class="img-responsive" width="500" height="500" src="" />
        </div>
    </div>
    <div class="col-md-6" style="padding-top:10px;">
      <!--<div class="fb-share-button"
        data-href=""
        data-image=""
        data-layout="button_count">
      </div>-->

    </div>
    <div class="col-md-6" style="padding-top:10px;">
      <div id="sharing" style="display:block">
        <button id="shareImage" type="button" style="background-color:#3b5998" class="btn btn-block btn-primary" onclick="shareInFB()">Share In Facebook</button>
        <button id="dontShareImage" type="button" style="background-color:#3b5998" class="btn btn-block btn-primary" onclick="dontShareInFB()">Dont Share</button>
      </div>
      <div id="posting" style="display:none">
        <button id="post" type="button" style="background-color:#3b5998" class="btn btn-block btn-primary" onclick="makeProfPic()"><img src="//login.create.net/images/icons/user/facebook_30x30.png" style="padding-right:5px">Make Profile Picture in Facebook</button>
      </div>
    </div>
  </div>

</body>

</html>
