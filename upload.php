<?php
session_start();
    require('connection.php');
    require 'vendor/autoload.php';
  
$videoid=rand(1,1000);

$userID = $_SESSION['userID']; 
 
$allowed_extensions = array('mp4', 'avi', 'wmv', 'mov');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING); // Sanitize title
  $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING); // Sanitize description

  // Validate file upload
  if (isset($_FILES['video']) && !empty($_FILES['video']['name'])) {
    $file_name = $_FILES['video']['name'];
    $file_size = $_FILES['video']['size'];
    $file_tmp = $_FILES['video']['tmp_name'];
    $file_type = $_FILES['video']['type'];
    $file_ext = strtolower(end(explode('.', $file_name)));

    // Check allowed file size (adjust as needed)
    if ($file_size > 50000000) { // 50MB limit
      echo 'Error: File size exceeds limit (50MB).';
      exit;
    }

    // Check allowed extensions
    if (!in_array($file_ext, $allowed_extensions)) {
      echo 'Error: Invalid file type. Only ' . implode(', ', $allowed_extensions) . ' are allowed.';
      exit;
    }

    // Generate a unique filename
    $new_file_name = uniqid('', true) . '.' . $file_ext;

    // Upload the video to a designated folder (create if needed)
    $upload_path = 'uploads/';
    if (!file_exists($upload_path)) {
      mkdir($upload_path, 0777, true); // Create directory with full permissions
    }
    $destination = $upload_path . $new_file_name;

    if (move_uploaded_file($file_tmp, $destination)) {

        $sec = 2;
    $thumbnail = 'thumbnails/'.$file_name.'.png';
    $ffmpeg = FFMpeg\FFMpeg::create();
    $video = $ffmpeg->open($destination);
    $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($sec));
    $frame->save($thumbnail);
    echo "<script>console.log(".json_encode($destination).")</script>";
      try {
        $stmt = $conn->prepare('INSERT INTO videos (videoid, userid, video,thumbnail, title, description) VALUES (?, ?, ?, ?,?, ?)');
        $stmt->bind_param('iissss',$videoid, $userID,$destination,$thumbnail, $title, $description );
        $stmt->execute();

        echo 'Video uploaded successfully!';
        $stmt->close();
      } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
      } finally {
      
      }

    } else {
      echo 'Error: Failed to upload video.';
    }

  } else {
    echo 'Error: Please select a video to upload.';
  }
} else {
  echo 'Error: Invalid request method.';
}

$conn->close();
header('Location: index.php'); 
?>