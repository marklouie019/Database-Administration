<?php
include("connect.php");

// SET TIMEZONE FOR ACCURATE TIMESTAMP
date_default_timezone_set('Asia/Manila');

// INSERT DATA
include("shared/index/insert.php");

// FETCH POSTS FROM THE DATABASE
include("shared/index/read.php");

// DELETE A POST FROM THE DATABASE
include("shared/index/delete.php");

// EDIT POST FROM THE DATABASE
include("shared/index/update.php");

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BlinkChat Feed</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="icon" href="assets/img/ui/blinkchat-fav-logo.svg" type="image/svg+xml">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php include("shared/index/navbar.php"); ?>
  <div class="main-content">
    <div class="feed px-4">
      <!-- PHP BLOCK -->
      <?php
      if (mysqli_num_rows($result)) {
        while ($postCard = mysqli_fetch_assoc($result)) {
          ?>
          <!-- POST CARDS -->
          <div class="postCard my-3" id="postCard">
            <div class="postTop">
              <div class="post-info d-flex">
                <img src="assets/img/users/<?php echo $postCard['profilePic']; ?>" alt="Profile" class="profile-pic me-3">
                <div class="user-name">
                  <?php echo $postCard["firstName"] . " " . $postCard["lastName"]; ?>
                  <br>
                  <!-- TIME AGO FUNCTION-->
                  <?php include("shared/index/time-ago.php"); ?>
                </div>
                <!-- DELETE CONFIRMATION MODAL -->
                <?php include("shared/modals/delete-post.php") ?>
                <!-- OPTIONS BUTTON -->
                <button <?php echo ($postCard['userID'] != 1) ? 'disabled' : '' ?>
                  onclick="showOptions('btnOptions<?php echo $postCard['postID'] ?>', '<?php echo $postCard['postID'] ?>')"
                  type="button" class="btn-delete ms-auto" id="btnOptions<?php echo $postCard['postID'] ?>"
                  data-bs-html="true" data-bs-toggle="popover" data-bs-placement="bottom"
                  data-bs-content="<?php echo ($postCard['userID'] != 1) ? 'You can\'t edit this post.' : 'Options' ?>">
                  <i class=" fa-solid fa-ellipsis" id="icon"></i>
                </button>
                <!-- OPTIONS MODAL -->
                <?php include('shared/modals/options-post.php') ?>
                <!-- EDIT POST MODAL -->
                <?php include('shared/modals/edit-post.php') ?>
              </div>
            </div>
            <div class="postContent">
              <div class="caption">
                <?php echo $postCard['content']; ?>
                <br>
                <?php
                if (!empty($postCard['cityName']) && !empty($postCard['provinceName'])) {
                  echo '<span>📍' . htmlspecialchars($postCard['cityName']) . ', ' . htmlspecialchars($postCard['provinceName']) . '</span>';
                }
                ?>
              </div>
              <?php
              if (!empty($postCard['attachment'])) {
                echo '<div class="attachment img-fluid"><img src="assets/img/users/' . htmlspecialchars($postCard['attachment']) . '" alt="Post Image"></div>';
              }
              ?>
              <hr>
              <div class="interaction-bar">
                <div class="react">
                  <a onclick=""><img src="assets/img/ui/heart.svg" alt="react button"><span class="like">Like</span></a>
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
          <!-- CREATE POST MODAL -->
          <?php include("shared/modals/create-post.php") ?>
          <?php
        }
      } else {
        echo "<p>Oops, there are no posts to display </p>";
      }
      ?>
      <!-- END PHP BLOCK -->
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script>
    var popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    var popoverList = Array.prototype.map.call(popoverTriggerList, function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl, {
        trigger: 'hover'
      });
    });
  </script>
  <script src="assets/js/script.js"></script>
  <script src="https://kit.fontawesome.com/49a3347974.js" crossorigin="anonymous"></script>
</body>

</html>