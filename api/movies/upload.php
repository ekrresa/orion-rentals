<?php

	// Trim POST variables of whitespace and slashes
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$target_dir = "img/";
	$target_file = $target_dir . basename($_FILES["movie"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if (isset($_POST["upload"])) {

		include_once 'models/Movie.php';

		// get database connection
		$database = new Database();
		$db = $database->getConnection();

		// prepare user object
		$movie = new Movie($db);

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

		$title = test_input($_POST["title"]);
		$genre = test_input($_POST["genre"]);
		$year = test_input($_POST["year"]);
		$pic_url = basename( $_FILES["movie"]["name"]);

		if ($movie->uploadMovie($title, $genre, $year, $pic_url)) {

		  $_SESSION['success'] = 'Movie uploaded successfully';
			header("location: status.php");
			exit();
		}

    else {
      $_SESSION['error'] = 'Unable to upload movie';
      header("location: status.php");
      exit();
    }

	}

?>