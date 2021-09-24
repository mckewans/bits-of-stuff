<!doctype html>
<html lang="en"><head>
<meta charset="utf-8" >
<meta name="keywords" content="" >
<meta name="description" content="" >

<title>Page Title</title>

<link rel="stylesheet" href="css/styles.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png" />
<link rel="apple-touch-icon" href="img/favicon.png" /> 


</head>

<body>

<div id="content">

<?php

$allowedExts = array("gif", "jpeg", "jpg", "png", "pdf");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

date_default_timezone_set("Europe/London");

$folder = date("d-m-Y-H-i");

if ( !file_exists("uploads/".$folder) and !is_dir("uploads/".$folder) ) {
	
	mkdir("uploads/".$folder, 0700);
	
}

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "application/pdf"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
?>		

<h3>File Uploaded Successfully.</h3>
<?		
    echo "<p><strong>Upload</strong>: " . $_FILES["file"]["name"] . "</p>";
    echo "<p><strong>Type</strong>: " . $_FILES["file"]["type"] . "</p>";
    echo "<p><strong>Size</strong>: " . round($_FILES["file"]["size"] / 1024) . " kB</p>";
    echo "<p><strong>Temp file</strong>: " . $_FILES["file"]["tmp_name"] . "</p>";

    if (file_exists("uploads/" . $folder . "/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "uploads/" . $folder . "/" . $_FILES["file"]["name"]);
	  
      echo "<p>Stored in : uploads/" . $folder . "/" . $_FILES["file"]["name"]."</p>";
	  
      }
    }
  }
else
  {
  echo "Invalid file type : " . strtoupper($temp[1]);
  }

?>

</div>

</body>
</html>>