<?php

	// Trim POST variables of whitespace and slashes
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$target_dir = "../img/";
	$target_file = $target_dir . basename($_FILES["movie"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// *************SERVER VALIDATION***************
	if (isset($_POST["upload"])) {

		include 'db.php'; //Database connection

		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["movie"]["tmp_name"]);

    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
		if (file_exists($target_file)) {
		    echo "Sorry, file already exists.";
		    $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		    echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
		    $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($_FILES["movie"]["tmp_name"], $target_file)) {
		        echo "The file ". basename( $_FILES["movie"]["name"]). " has been uploaded.";
		    } else {
		        echo "Sorry, there was an error uploading your file.";
		    }
		}

		$title = $conn->escape_string(test_input($_POST["title"]));
		$genre = $conn->escape_string(test_input($_POST["genre"]));
		$year = $conn->escape_string(test_input($_POST["year"]));
		$pic_url = basename( $_FILES["movie"]["name"]);

		$id = $_SESSION['id'];

		date_default_timezone_set("Africa/Lagos");
		$upload_date = date("Y-m-d");


    $sql = "INSERT INTO `movies`(user_id, title, genre, year, pic_url, upload_date) ". "VALUES ('$id', '$title','$genre','$year','$pic_url', '$upload_date')";


    if ( $conn->query($sql) ){

		  $_SESSION['success'] = '<div class="alert alert-success" role="alert">Movie uploaded successfully.</div>';
		  $conn->close();
			header("location: status.php");
			exit();
		}

    else {
      $_SESSION['error'] = '<div class="alert alert-danger" role="alert">'.$conn->error.'</div>';
      $conn->close();
      header("location: status.php");
      exit();
    }

	}

?>