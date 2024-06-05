<?php

// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "youtubeclone";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else{
 echo "connection successful";
}

  
  $id=rand(1,1000);
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash password for security

  $target_dir = "profilepics/"; // Change this to your desired upload directory
  $target_file = $target_dir . basename($_FILES["profilePicture"]["name"]);
  $uploadOk = true;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



  // Check if $uploadOk is set to 0 by an error
  if (!$uploadOk) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["profilePicture"]["tmp_name"], $target_file)) {
      // Build the SQL query with sanitized data and uploaded filename
      $sql = "INSERT INTO users (id,username, email, password, profilePic)
              VALUES ('$id','$username', '$email', '$password', '$target_file')";

      // Execute the query and handle the result
      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }


// Close the connection
$conn->close();
session_start();
$_SESSION['userID'] = $id;
$_SESSION['image'] = $target_file;

header('Location: index.php');
exit;
?>
