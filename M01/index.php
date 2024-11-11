<?php
include("connect.php");

// SET TIMEZONE FOR ACCURATE TIMESTAMP
date_default_timezone_set('Asia/Manila');

// CHECK IF FORM IS SUBMITTED
if (isset($_POST['btnUploadPost'])) {
  $userID = 1;
  $caption = nl2br($_POST['caption']);
  $cityName = $_POST['cityName'];
  $provinceName = $_POST['provinceName'];
  $privacy = $_POST['privacy'];
  $timeStamp = date('Y-m-d H:i:s');

  // PROCESS FILE UPLOAD IF FILE IS PRESENT
  // CHECK FILE > RETRIEVE TEMPORARY FILE PATH > MOVE FILE
  $attachmentName = '';
  if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
    $attachmentTmpPath = $_FILES['attachment']['tmp_name'];
    $attachmentName = basename($_FILES['attachment']['name']);
    $uploadDir = 'assets/img/users/';
    $uploadFilePath = $uploadDir . $attachmentName;
    move_uploaded_file($attachmentTmpPath, $uploadFilePath);
  }

  // CHECK OR INSERT CITY & PROVINCE
  $cityQuery = "SELECT cityID FROM cities WHERE cityName = '$cityName'";
  $cityResult = executeQuery($cityQuery);

  if (mysqli_num_rows($cityResult) > 0) {
    $city = mysqli_fetch_assoc($cityResult);
    $cityID = $city['cityID'];
  } else {
    $insertCityQuery = "INSERT INTO cities(cityName) VALUES ('$cityName')";
    executeQuery($insertCityQuery);
    $cityID = mysqli_insert_id($conn);
  }

  $provinceQuery = "SELECT provinceID FROM provinces WHERE provinceName = '$provinceName'";
  $provinceResult = executeQuery($provinceQuery);

  if (mysqli_num_rows($provinceResult) > 0) {
    $province = mysqli_fetch_assoc($provinceResult);
    $provinceID = $province['provinceID'];
  } else {
    $insertprovinceQuery = "INSERT INTO provinces(provinceName) VALUES ('$provinceName')";
    executeQuery($insertprovinceQuery);
    $provinceID = mysqli_insert_id($conn);
  }

  // INSERT OR GET ADDRESS ID
  $addressQuery = "SELECT addressID FROM address WHERE cityID = '$cityID' AND provinceID = '$provinceID'";
  $addressResult = executeQuery($addressQuery);

  if (mysqli_num_rows($addressResult) > 0) {
    $addressRow = mysqli_fetch_assoc($addressResult);
    $addressID = $addressRow['addressID'];
  } else {
    $addressInsertQuery = "INSERT INTO address (cityID, provinceID) VALUES ('$cityID', '$provinceID')";
    executeQuery($addressInsertQuery);
    $addressID = mysqli_insert_id($conn);
  }

  // INSERT THE POST INTO THE DATABASE
  $postQuery = "INSERT INTO posts(content, attachment, privacy, dateTime, addressID, userID) 
                VALUES ('$caption', '$attachmentName', '$privacy', '$timeStamp', '$addressID', '$userID')";
  executeQuery($postQuery);

  header("Location: index.php");
}

// FETCH POSTS FROM THE DATABASE
$query = "SELECT * FROM posts 
  LEFT JOIN userInfo ON posts.userID = userInfo.userID 
  LEFT JOIN address ON posts.addressID = address.addressID
  LEFT JOIN cities ON address.cityID = cities.cityID
  LEFT JOIN provinces ON address.provinceID = provinces.provinceID
  ORDER BY dateTime DESC
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
  <div class="main-content">
    <div class="feed px-4">
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
                    <?php
                    // MODIFY THE TIMESTAMP INTO TIME AGO FORMAT USING DATETIME
                    $postTime = new DateTime($postCard['dateTime']);
                    $currentTime = new DateTime();
                    $interval = $currentTime->diff($postTime);

                    if ($interval->y > 0) {
                      echo $interval->y . " year" . ($interval->y > 1 ? "s" : "") . " ago";
                    } elseif ($interval->m > 0) {
                      echo $interval->m . " month" . ($interval->m > 1 ? "s" : "") . " ago";
                    } elseif ($interval->d > 0) {
                      echo $interval->d . " day" . ($interval->d > 1 ? "s" : "") . " ago";
                    } elseif ($interval->h > 0) {
                      echo $interval->h . " hour" . ($interval->h > 1 ? "s" : "") . " ago";
                    } elseif ($interval->i > 0) {
                      echo $interval->i . " minute" . ($interval->i > 1 ? "s" : "") . " ago";
                    } else {
                      echo "Just now";
                    }
                    echo " • " . ucwords($postCard['privacy']);
                    ?>
                  </span>
                </div>
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
  <!-- CREATE POST MODAL -->
  <div class="modal fade p-0" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
    aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5);" data-bs-theme="dark">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center" id="confirmationModalLabel">Create a Blink post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- CONTENT -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="profile pb-3">
              <img src="assets/img/users/louie.jpeg" alt="Profile" class="profile-pic">
              <span class="username mx-3">Mark Louie Villanueva</span>
            </div>
            <div class="form-floating">

              <textarea class="form-control" placeholder="Leave a comment here" id="caption" name="caption"
                style="height: 100px" oninput="validateForm()"></textarea>
              <label for="caption">Write a status so you can Blink ;></label>
            </div>
            <div class="additionals pt-3">
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-6">
                    <div onclick="uploadFile()" class="upload-file p-2 d-flex align-items-center gap-2 mb-3"
                      id="uploadFile">
                      <i class="fa-regular fa-image"></i>Add pictures
                      <input type="file" id="fileInput" hidden onchange="previewImage(event)" name="attachment">
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
                  <div class="col my-sm-3 mb-lg-3">
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
                            placeholder="City" name="cityName">
                        </div>
                        <div class="col-lg-6">
                          <input type="text" id="provinceName" class="form-control info-input info-input mb-2"
                            placeholder="Province" name="provinceName">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="set-privacy">
                      <select class="form-select mb-3" aria-label="Default select example" name="privacy">
                        <option selected value="Public"><i class="fa-solid fa-globe"></i>Public
                        </option>
                        <option value="Friends"><i class="fa-solid fa-user-group"></i>Friends
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" class="btn-post w-100 text-center align-content-center" data-bs-dismiss="modal"
              name="btnUploadPost" id="btnUploadPost" disabled>
              Post</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <script>
    // FUNCTION TO CHECK IF POST IS EMPTY OR NOT
    function validateForm() {
      var caption = document.getElementById('caption').value.trim();
      var fileInput = document.getElementById('fileInput');
      var btnUploadPost = document.getElementById('btnUploadPost');

      if (caption.length > 0 || fileInput.files.length > 0) {
        btnUploadPost.disabled = false;
        btnUploadPost.style.background =
          "linear-gradient(91deg, #FFD600 0.19%, #FF7C1C 0.2%, #FFCA38 70.96%, #B86E00 116.39%)";
      } else {
        btnUploadPost.disabled = true;
        btnUploadPost.style.background = "#626161";
      }
    }

    document.getElementById('fileInput').addEventListener('change', validateForm);
  </script>
  <script src="assets/js/script.js"></script>
  <script src="https://kit.fontawesome.com/49a3347974.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>