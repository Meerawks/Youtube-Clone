<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    
    <link rel="stylesheet" href="styles.css" type="text/css">
    <title>Youtube</title>
   
</head>
<style>
.video-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-gap: 20px;
  margin: 0 auto;
  padding: 20px;
  
}

.video-item {
  width: 350px;
  border-radius: 4px;
  padding: 10px;
  text-align: center;
}

.video-item a {
  text-decoration: none;
  color: #000;
}

.video-item img {
  width: 100%;
  height: 180px;
  border-radius: 10px;
  object-fit: cover;
}

.video-info {
    width: 100%;
    text-align: left;
}
.right-div{
    margin-top: 10px;
    display: flex;
    gap:10px;
}
.video-info h3 a {
  font-weight: bold;
  font-size: 1em;
  color: white;
}
.profileinfo{
  width:40px !important;
  height: 40px !important;
  clip-path: circle();
  z-index: -1;
}
.video-info p {
  font-size: 1em;
  color: white;
  line-height: 1.5;
}
</style>
</style>
<script>
    function showDropdown() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
</script>
<body>
    <div class="top">
    <div class="header" id="header">
        <div class="left-menu">
            <img src="./Images/menu.png" alt="menu icon" class="menu-icon">
        <img src="./Images/youtubepk.png" alt="youtube icon" class="youtube-icon">
        <p class="region">PK</p>
        </div>
        <div class="center-menu">
            <input type="text" id="search" class="search-bar" placeholder="Search">
            <button class="search"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="30" viewBox="0,0,256,256"
               style="fill:#000000;">
               <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(8.53333,8.53333)"><path d="M13,3c-5.511,0 -10,4.489 -10,10c0,5.511 4.489,10 10,10c2.39651,0 4.59738,-0.85101 6.32227,-2.26367l5.9707,5.9707c0.25082,0.26124 0.62327,0.36648 0.97371,0.27512c0.35044,-0.09136 0.62411,-0.36503 0.71547,-0.71547c0.09136,-0.35044 -0.01388,-0.72289 -0.27512,-0.97371l-5.9707,-5.9707c1.41266,-1.72488 2.26367,-3.92576 2.26367,-6.32227c0,-5.511 -4.489,-10 -10,-10zM13,5c4.43012,0 8,3.56988 8,8c0,4.43012 -3.56988,8 -8,8c-4.43012,0 -8,-3.56988 -8,-8c0,-4.43012 3.56988,-8 8,-8z"></path></g></g>
               </svg>
            </button>
            <button class="mic"> <img src="./Images/microphone.png" class="microphone">
               </button>

        </div>
        <div class="right-menu">
            <img src="./Images/create.png" class=" right create" alt="create icon">
            <img src="./Images/notification-27.png" class="right notification" alt="notification icon">
            <?php
            
            
            $userID = 0;
            $image="./Images/default_profile.png";
            session_start();
            if(isset($_SESSION['userID'])){
                $userID = $_SESSION['userID'];  
              
            }   
            if (isset($_GET['logout'])){
                $userID = 0;
                $image="./Images/default_profile.png";
                $_SESSION['userID'] = $userID;
                echo("<script>console.log('userid after logout: " . $userID . "');</script>");
        }
           
            if($userID!=0){
                $image = $_SESSION['image'];
                $submenu='Log Out';
              
            }
            
            ?>
            <img src="<?php echo $image; ?>" class="profile" alt="right user profile photo" id="profile" style=" clip-path: circle();">
            <div class="sub-menu-wrap" id="sub-menu">
                <div class="sub-menu">
                    <div class="user-info">   
                       <?php
                        if($userID==0){
                            $url1='signup.html';
                            echo '<a href='.$url1.' class="signin-text"><p class="signin-text">Sign Up</p></a>';
                            $url2 = 'login.php';
                            echo '<a href='.$url2.' class="signin-text"><p class="signin-text">Log In</p></a>';
                        } else {
                        
                            $url1='upload.html';
                            echo '<a href='.$url1.' class="signin-text"><p class="signin-text">Upload</p></a>';

                            echo '<a href="index.php?logout=0" class="signin-text"><p class="signin-text">Log Out</p></a>';
                        }
                       
                       ?>
                       
                    </div>
                </div>
            </div>
       
        </div>
        
    </div>
    <div class="suggestions">
        <p class="suggestion all">All</p>
        <p class="suggestion gaming">Gaming</p>
        <p class="suggestion mixes">Mixes</p>
        <p class="suggestion Music">Music</p>
        <p class="suggestion css">CSS</p>
        <p class="suggestion Podcast">Podcast</p>
        <p class="suggestion Live">Live</p>
        <p class="suggestion Gym">Gym</p>
        <p class="suggestion J-pop">J-pop</p>
        <p class="suggestion Java">Java</p>
        <p class="suggestion Web Development">Web Development</p>
        <p class="suggestion news">News</p>
    </div>
</div>
    <div class="main">
    <div class="side-nav">
        <div class="side-bar home-div" >
            <img src="./Images/home.png" class="icons home" alt="home icon">
            <p>Home</p>
        </div>
        <div class="side-bar shorts-div">
            <img src="./Images/shorts.png" class="icons shorts" alt="shorts icon">
            <p>Shorts</p>
        </div>
        <div class="side-bar Subscriptions-div">
            <img src="./Images/subscription.png" class="icons subscription" alt="subscription icon">
            <p>Subscriptions</p>
        </div>
        <div class="line"><p></p></div>
        <div class="side-bar you-div">
            <p style="font-weight: 700; font-size: large; margin-left: 0px;">You</p>
            <img src="./Images/arrow-right.png" class="icons you" alt="you icon" style="margin-left: -10px;">
        </div>
        <div class="side-bar channel-div" >
            <img src="./Images/profile.png" class="icons channel" alt="home icon">
            <p>Your</p>
            <p class="channel-text">channel</p>
        </div>
        <div class="side-bar history-div" >
            <img src="./Images/history.png" class="icons history" alt="history icon">
            <p>History</p>
        </div>
        <div class="side-bar video-div" >
            <img src="./Images/video.png" class="icons video" alt="video icon">
            <p>Your</p>
            <p class="channel-text">videos</p>
        </div>
        <div class="side-bar watch-later-div" >
            <img src="./Images/history2.png" class="icons watch-later" alt="watch-later icon">
            <p>Watch</p>
            <p class="channel-text">later</p>
        </div>
        <div class="side-bar show-more-div" >
            <img src="./Images/arrow-down.png" class="icons show-more" alt="show-more icon">
            <p>Show</p>
            <p class="channel-text">more</p>
        </div>
        <div class="line"><p></p></div>
    </div>
    <div class="video-panel" style="  display: flex;
flex-direction: row;
flex-wrap: wrap;">
    <?php

    require('connection.php'); 
  
$sql = "SELECT * FROM videos";
             
try {
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $result = $stmt->get_result();


  
  if ($result->num_rows > 0) {
    while ($video = $result->fetch_assoc()) {
      $title = $video['title'];
      $description = substr($video['description'], 0, 100) . '...'; // Truncate description
      $video_path = $video['video'];
      $userid=$video['userid'];
      $thumbnail=$video['thumbnail'];
      
     $stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->bind_param('i', $userid); // Bind sanitized parameters
    $stmt->execute();
    $userResults = $stmt->get_result();
    $user = $userResults->fetch_assoc();       
    

      
$username=$user['username'];
$profilepic = $user['profilePic'];
      echo <<<HTML
        <div class="video-item">
          <a href="videopage.php?videopath=$video_path">
          
            <img src="$thumbnail" alt="$title">
          </a>
          <div class="right-div">
          <img class='profileinfo' src="$profilepic" alt="profile pic">
          <div class="video-info">
          
            <h3><a href="$video_path">$title</a></h3>
            <p>uploaded by $username</p>
         </div>
          </div>
        </div>
      HTML;
    }
    echo '</div>'; // Close the container


  } else {
    echo 'No videos found.';
  }

  $stmt->close();
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}

$conn->close();

?>
    
</div>
</div>   
    
</body>
</html>