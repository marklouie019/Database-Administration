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
  <link rel="icon" href="assets/img/ui/blinkchat-fav-logo.svg" type="image/svg+xml">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/img/ui/blinkchat-logo.svg" alt="blinkchat logo"></a>
      <li class="nav-item navbar-profile ml-auto">
        <img src="assets/img/users/louie.jpeg" alt="Profile" class="profile-pic">
        <span class="username mx-3">Mark Louie Villanueva</span>
      </li>
    </div>
  </nav>
  <div class="sideBar">
    <div class="row">
      <div class="col p-0">
        <a onclick="selectSideNavOpt('btnHome')" id="btnHome">
          <div class="sidebar home mb-2 d-flex align-items-center gap-2" id="btnHome">
            <i class="fa-solid fa-house"></i><span> Home</span>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col p-0">
        <a onclick="selectSideNavOpt('btnMessages')" id="btnMessages">
          <div class="sidebar messages mb-2 d-flex align-items-center gap-2">
            <i class="fa-regular fa-comment"></i><span> Messages</span>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col p-0">
        <a onclick="selectSideNavOpt('btnCreate')" id="btnCreate">
          <div class="sidebar create mb-2 d-flex align-items-center gap-2">
            <i class="fa-regular fa-square-plus"></i></i><span> Create</span>
          </div>
        </a>
      </div>
    </div>
  </div>
  <div class="contaier">
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
                  <img src="assets/img/users/<?php echo $postCard['profilePic']; ?>" alt="Profile" class="profile-pic me-3">
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
  <!-- CREATE POST MODAL -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
    aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5);" data-bs-theme="dark">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="confirmationModalLabel">Create a Blink post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- CONTENT -->
          <form action="/upload" method="post" enctype="multipart/form-data">
            <div class="profile pb-3">
              <img src="assets/img/users/louie.jpeg" alt="Profile" class="profile-pic">
              <span class="username mx-3">Mark Louie Villanueva</span>
            </div>
            <div class="form-floating">
              <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2"
                style="height: 100px"></textarea>
              <label for="floatingTextarea2">Write a status so you can Blink ;></label>
            </div>
            <div class="additionals pt-3">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6">
                    <div onclick="uploadFile()" class="upload-file p-2 d-flex align-items-center gap-2 mb-3"
                      id="uploadFile">
                      <i class="fa-regular fa-image"></i>Add pictures
                      <input type="file" id="fileInput" hidden onchange="previewImage(event)">
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="add-location p-2 d-flex align-items-center gap-2" onclick="inputLocation()">
                      <i class="fa-solid fa-location-dot"></i>Add location
                    </div>
                  </div>
                </div>
                <!-- IMAGE PREVIEW -->
                <div class="row">
                  <div class="col">
                    <img id="imagePreview" src="" alt="Image Preview">
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="input-location" id="addLocation">
                      <div class="row">
                        <div class="col my-2">
                          Add location
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-6">
                          <input type="text" id="cityName" class="form-control info-input info-input mb-2"
                            placeholder="City">
                        </div>
                        <div class="col-lg-6">
                          <input type="text" id="provinceName" class="form-control info-input info-input mb-2"
                            placeholder="Province">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <div class="btn-post w-100 text-center align-content-center" data-bs-dismiss="modal">Post</div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script src="assets/js/script.js"></script>
  <script src="https://kit.fontawesome.com/49a3347974.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>