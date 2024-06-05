<?php
@ob_start();
session_start();
$comments= [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark YouTube Theme Video Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    font-family: sans-serif;
    background-color: #181818;
    color: #fff;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 1024px;

    padding: 20px;
}

main,.comment-section{
    padding: 10px;
    border-radius: 10px;
    background-color: #212121;
}
.comment-profile{
  clip-path: circle();
  width:20px;
}
.comment-section {
  background-color: #212121; /* Dark background for comments section */
  color: #fff; /* White text for readability */
  padding: 20px;
  border-radius: 5px;
  margin-top: 20px; /* Add spacing after video info */
}
.image-name{
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 5px;
}
/* Overall comment section styling */
.comment-section {
  background-color: #181818; /* Dark background color */
  color: #f0f0f0; /* Light colored text */
  padding: 16px; /* Padding for spacing */
}

/* Title styling */
.comment-section h2 {
  margin-bottom: 8px; /* Space between title and comments */
}

/* Styling for each comment */
.comment {
  margin-bottom: 15px !important; /* Space between comments */
  border-radius: 10px;
  height: 40px;
}

/* Username and timestamp styling */
.comment .username,
.comment .timestamp {
  font-size: 0.9em; /* Smaller font size for username and timestamp */
  color: #b3b3b3; /* Lighter color for less emphasis */
}

/* Username styles */
.comment .username {
  font-weight: bold;
}

/* Styling for the comment text */
.comment .comment-text {
  margin-top: 4px; /* Add some space between username/timestamp and comment */
}

.comment-section h2 {
  font-size: 18px;
  margin-bottom: 10px;
}

.comment-form {
  margin-bottom: 15px;
}

.comment-form label {
  display: block;
  margin-bottom: 5px;
}

.comment-form textarea {
  width: 95%;
  padding: 10px;
  border: 1px solid #444; /* Darker border for comments section */
  border-radius: 5px;
  font-family: sans-serif;
  background-color: #333; /* Slightly darker background for textarea */
  color: #fff; /* White text for textarea */
}

.comment-form button {
margin-top: 10px;
  background-color: #068ad6; /* Green for submit button */
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 50px;
  cursor: pointer;
  transition: 0.3s;
}

.comment-form button:hover {
  background-color: #0b5db5;
}

/* Styles for individual comments can be added here (optional) */
.comments-list {
  /* Add styles for the comments list, like margins or borders */
}

.comment { /* Example style for individual comments */
  background-color: #333; /* Slightly darker background for comments */
  padding: 10px;
  border-bottom: 1px solid #444; /* Add a separator line */
  margin-bottom: 5px;
  color: #fff;
}

.comment .comment-author { /* Styles for comment author */
  font-weight: bold;
  margin-bottom: 5px;
}

.comments{
margin-top: 20px;
}

.video-container {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
}
.video-wrapper {
    flex: 2;
}

.video-info {
    flex: 1;
    padding: 10px;
}

.uploader-details {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.uploader-details img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.uploader-details a {
    color: inherit;
    text-decoration: none;
    font-weight: 600;
}

.video-info h2 {
    font-size: 20px;
    margin-top: 0px;
    margin-bottom: 15px;
}

.like-dislike {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.like-dislike i {
    font-size: 18px;
    margin-right: 5px;
    color: #ccc;
}

.like-dislike span {
    font-weight: bold;
}

.like-dislike-buttons {
    display: flex;
    justify-content: space-between;
}

.like-btn,
.dislike-btn {
    background-color: #333;
    color: #fff;
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

.like-btn:hover,
.dislike-btn:hover {
    background-color: #444;
}

</style>
<body>
    <div class="container">
    

        <main class="main">
            <?php
        require('connection.php');
       if(!is_null($comments)){
       $sql = "SELECT * from videos where video=?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("s", $_GET['videopath']); // Bind video ID from URL
       echo("<script>console.log('PHP: " . $_GET['videopath'] . "');</script>");
       $stmt->execute();
       $result = $stmt->get_result();
       $row = $result->fetch_assoc();
       $videoid = $row['videoid'];
       $sql = "SELECT c.comment, c.videoid, u.username,u.profilePic
       FROM comments c
      INNER JOIN users u ON c.userid = u.id
      WHERE c.videoid = $videoid";

$result = $conn->query($sql);

$comments = [];
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$comments[] = $row;
}

}
       }
       

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get video details from database using prepared statement for security
            $sql = "SELECT videos.title, videos.description, videos.video, users.profilePic, users.username FROM videos
                    INNER JOIN users ON videos.userid = users.id
                    WHERE videos.video = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_GET['videopath']); // Bind video ID from URL
            echo("<script>console.log('PHP: " . $_GET['videopath'] . "');</script>");
            $stmt->execute();
            $result = $stmt->get_result();

        
            if(isset($_POST['addComment']) and (isset($_SESSION['userID']))!=0){ 
           
                   $userID = $_SESSION['userID'];  
                   $profile = $_SESSION['image']; 
                   
   
               $sql = "SELECT * from videos where video=?";
               $stmt = $conn->prepare($sql);
               $stmt->bind_param("s", $_GET['videopath']); // Bind video ID from URL
               echo("<script>console.log('PHP: " . $_GET['videopath'] . "');</script>");
               $stmt->execute();
               $result = $stmt->get_result();
               $row = $result->fetch_assoc();
               $videoid = $row['videoid'];
               $comment=$_POST["comment"];
   
                   $sql = "INSERT INTO comments (videoid,userid, comment)
                   VALUES ('$videoid','$userID','$comment')";
                   if ($conn->query($sql) === TRUE) {
                    
                     } else {
                       echo "Error: " . $sql . "<br>" . $conn->error;
                     }
   
               
   
          }else{
               //code to be executed  
          }
            

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo("<script>console.log('aFTER ROW: " . $row["video"]. "');</script>");

                ?>

                <div class="video-container">
                    <div class="video-wrapper">
                    <video width="1000" height="550" controls autoplay>
                            <source src="<?php echo $row["video"]; ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                    <div class="video-info">
                    <h2><?php echo $row["title"]; ?></h2>
                        <div class="uploader-details">
                            <img src="<?php echo $row["profilePic"]; ?>" alt="<?php echo $row["username"]; ?>'s profile picture">
                            <a href="#"><?php echo $row["username"]; ?></a>
                        </div>
                        
                        
                        <p><?php echo $row["description"]; ?></p>

                    
                    </div>
                </div>

                <?php

            } else {
                echo "No video found!";
            }
        
          
            
            ?>
        </main>
       
   <div class="comment-section">
  <h2>Comments</h2>
  <div class="comment-form">
    <form method="POST" action="comment.php?videoid=<?php echo $videoid;?>">
    <label for="comment"></label>
    <textarea id="comment" name="comment" rows="2" placeholder="Leave a comment..."></textarea>
    <button type="submit" name='addComment' value="addComment">Comment</button>
    </form>
  </div>
  <div class="comment-section">
  <h2>Comment(<?php  
  if(is_null($comments))
  {echo 0;
}
  else{
    echo count($comments);
  }
  ?>)</h2>
  <?php 
  
  if(!is_null($comments)){
    
  foreach ($comments as $comment):
    $profilePicUrl =$comment['profilePic'];
    
  ?>
    <div class="comment">
      <div class="image-name">
      <img src="<?php echo $profilePicUrl; ?>"  alt='Profile Picture' class="comment-profile">
      <span class="username"><?php echo $comment["username"]; ?></span>
      <span class="timestamp">1 hour ago</span>
      </div>
      <p class="comment-text"><?php echo $comment["comment"]; ?></p>
    </div>
  <?php endforeach; 
  }?>
</div>
</div>



</body>
</html>
