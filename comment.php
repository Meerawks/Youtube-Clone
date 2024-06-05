<?php
require('connection.php');
 session_start();
        
if(isset($_POST['addComment']) and (isset($_SESSION['userID']))!=0){ 

       $userID = $_SESSION['userID'];  
       $profile = $_SESSION['image']; 
       $videoid=$_GET['videoid'];

   $sql = "SELECT * from videos where videoid=?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $videoid); // Bind video ID from URL
   $stmt->execute();
   $result = $stmt->get_result();
   $row = $result->fetch_assoc();
   $videopath = $row['video'];
   $comment=$_POST["comment"];

       $sql = "INSERT INTO comments (videoid,userid, comment)
       VALUES ('$videoid','$userID','$comment')";
       if ($conn->query($sql) === TRUE) {
        
         } else {
           echo "Error: " . $sql . "<br>" . $conn->error;
         }

   

}else{

}
header("location:videopage.php?videopath=$videopath");
?>