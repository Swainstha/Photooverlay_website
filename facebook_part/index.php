<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Facebook Cover or Profile Pic with PHP Demo</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.js"></script>
<script type="text/javascript">
//Fade in/out effect for cover images using jquery
$(document).ready(function() {
	coverpics = $('.fbcovers img');
  	$(coverpics).fadeTo("fast", 0.70);
	coverpics.mouseenter(OnEnter).mouseleave(OnLeave);
    function OnEnter(){$(this).fadeTo("fast", 1);}
    function OnLeave(){$(this).fadeTo("fast", 0.70);}
});
</script>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center" class="fbpicwrapper">
<h1>Change Facebook Cover or Profile Pic with PHP</h1>
<div class="fbpic_desc">Please click on cover image you like the most for your profile!</div>
<ul class="fbcovers">
	<li><a href="process.php?pid=1"><img src="pictures/cover_pics/cover1.jpg" width="850" height="315" border="0" /></a></li>
    <li><a href="process.php?pid=2"><img src="pictures/cover_pics/cover2.jpg" width="850" height="315" border="0" /></a></li>
    <li><a href="process.php?pid=3"><img src="pictures/cover_pics/cover3.jpg" width="850" height="315" border="0" /></a></li>
    <li><a href="process.php?pid=4"><img src="pictures/cover_pics/cover4.jpg" width="850" height="315" border="0" /></a></li>
    <li><a href="process.php?pid=5"><img src="pictures/cover_pics/cover5.jpg" width="850" height="315" border="0" /></a></li>
    <li><a href="process.php?pid=6"><img src="pictures/cover_pics/cover6.jpg" width="850" height="315" border="0" /></a></li>
    <li><a href="process.php?pid=7"><img src="pictures/cover_pics/cover7.jpg" width="850" height="315" border="0" /></a></li>
    <li><a href="process.php?pid=8"><img src="pictures/cover_pics/cover8.jpg" width="850" height="315" border="0" /></a></li>
    <li><a href="process.php?pid=9"><img src="pictures/cover_pics/cover9.jpg" width="850" height="315" border="0" /></a></li>
    <li><a href="process.php?pid=10"><img src="pictures/cover_pics/cover10.jpg" width="850" height="315" border="0" /></a></li>
    <li><a href="process.php?pid=11"><img src="pictures/cover_pics/cover11.jpg" width="850" height="315" border="0" /></a></li>
</ul>
</div>

</body>
</html>
