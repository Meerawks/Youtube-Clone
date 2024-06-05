<?php
require('connection.php');


$email = $_POST["email"];
$password = $_POST["password"];

try {
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email); // Bind sanitized parameters
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc(); 
      if (password_verify($password, $user['password'])) {
       echo'login success';
        session_start(); 
        $_SESSION['userID'] = $user['id']; 
        $_SESSION['image'] = $user['profilePic']; 
        
      
        header('Location: index.php'); 
        exit;
      } else {
        echo 'Invalid username/email or password.';
      }
    } else {
      echo 'Invalid username/email or password.';
      echo 'email not found';
    }

    $stmt->close();
  } catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
  }

  $conn->close();



?>