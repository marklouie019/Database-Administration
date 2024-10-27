<?php
include("connect.php");

$query = "SELECT * FROM posts 
  LEFT JOIN userInfo ON posts.userID = userInfo.userID 
  LEFT JOIN address ON posts.addressID = address.addressID
  LEFT JOIN cities ON address.cityID = cities.cityID
  LEFT JOIN provinces ON address.provinceID = provinces.provinceID
  ";
$result = executeQuery($query);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BlinkChat Feed</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body data-bs-theme="dark">
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/img/ui/blinkchat-logo.svg" alt="blinkchat logo"></a>
      <li class="nav-item navbar-profile ml-auto">
        <img src="assets/img/users/louie.jpeg" alt="Profile" class="profile-pic">
        <span class="username mx-3">Mark Louie Villanueva</span>
      </li>
    </div>
  </nav>
  <div class="base">
    <div class="sideBar"></div>
    <div class="container">
      <div class="main-content">
        <div class="feed">
          <!-- PHP BLOCK -->
          <?php
          if (mysqli_num_rows($result)) {
            while ($postCard = mysqli_fetch_assoc($result)) {
              ?>
              <!-- POST CARDS -->
              <div class="postCard my-3">
                <div class="postTop">
                  <div class="post-info">
                    <img src="assets/img/users/<?php echo $postCard['profilePic']; ?>" alt="Profile"
                      class="profile-pic me-3">
                    <div class="user-name">
                      <?php echo $postCard["firstName"] . " " . $postCard["lastName"]; ?>
                      <br>
                      <span class="time-posted">
                        <?php echo date("F j, Y, g:i a", strtotime($postCard['dateTime'])) . " • " . ucwords($postCard['privacy']); ?>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="postContent">
                  <div class="caption">
                    <?php echo $postCard['content']; ?>
                    <br>
                    <span>📍<?php echo $postCard['cityName'] . ", " . $postCard['provinceName']; ?> </span>
                  </div>
                  <div class="attachment"><img src="assets/img/users/<?php echo $postCard['attachment']; ?>"></div>
                  <hr>
                  <div class="interaction-bar">
                    <div class="react">
                      <a onclick="reactToPost()"><img src="assets/img/ui/heart.svg" alt="react button"><span
                          class="like">Like</span></a>
                    </div>
                    <div class="comment">
                      <a><img src="assets/img/ui/comment.svg" alt="comment button"><span class="comment">Comment</span></a>
                    </div>
                    <div class="share">
                      <a id="btnShare" onclick=""><img src="assets/img/ui/share.svg" alt="share button"><span
                          class="share">Share</span></a>
                    </div>
                  </div>
                </div>
              </div>
              <?php
            }
          } else {
            echo "<p>Oops, there are no posts to display </p>";
          }
          ?>
          <!-- END PHP BLOCK -->
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>