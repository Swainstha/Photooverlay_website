      <?php
      session_start();

		if($_SERVER['REQUEST_METHOD']=='POST') {
      //$var = $_SESSION['choose'];
      if($_SESSION['theme']=='flags') {
        $var= $_POST['flagname'];
        $name2="pictures/merged/".$name.$var."/jpg";
        $image="pictures/flags/".$var.".png";
      }
      else if($_SESSION['theme']=='election') {
        $zone=$_POST['zone'];
        $district = $_POST['district'];
        $person = $_POST['person'];
        $name2="pictures/merged/".$name.$person."/jpg";
        $image="pictures/election/".$zone."/".$district."/".$person;
      }
			$str = 'http://graph.facebook.com/' . $_POST['link'] . '/picture?type=large&height=500&width=500';
			$temp= 'pictures/uploads/'.$_POST['name'].'.jpg';
      if(file_exists($temp)==0) {
        copy($str, $temp);
      }
      $stars = imagecreatefromjpeg($str);
			$gradient = imagecreatefrompng($image);
      $x=imagesx($stars);
      $y=imagesy($stars);
      $temp=imagecreatetruecolor($x,$y);

      imagecopyresized($temp,$gradient,0,0,0,0,$x,$y,imagesx($gradient),imagesy($gradient));

      $white=imagecolorallocate($temp,255,255,255);
      $w = imagesx($temp); // image width
      $h = imagesy($temp); // image height
      for($xi = 0; $xi < $w; $xi++) {
      for($yi = 0; $yi < $h; $yi++) {
      // Get the colour of this pixel
      $rgb = imagecolorat($temp, $xi, $yi);

      $r = ($rgb >> 16) & 0xFF;
      if($r<=200)continue;         // Don't bother calculating rest if over threshold

      $g = ($rgb >> 8) & 0xFF;
      if($g<=200)continue;         // Don't bother calculating rest if over threshold

      $b = $rgb & 0xFF;
      if($b<=200)continue;         // Don't bother calculating rest if over threshold

      // Change this pixel to black
      imagesetpixel($temp,$xi,$yi,$white);
    }
    }
          $white=imagecolorallocate($stars,255,255,255);
      imagecolortransparent($temp,$white);
      imagealphablending($stars, false);
      imagesavealpha($stars, true);
      imagecopymerge($stars, $temp, 0, 0, 0, 0, $x, $y, 50);

			//$name2="merged/hello.jpg";
			imagejpeg($stars,$name2);

      imagedestroy($temp);
			imagedestroy($gradient);
      imagedestroy($stars);
			echo $name2;
		}

        ?>
