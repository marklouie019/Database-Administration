<?php
include("connect.php");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BlinkChat Feed</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    html {
      padding: 0;
    }

    .profile-pic {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .navbar {
      border-bottom: 1px solid #4F4E4E !important;
      background: #262525 !important;
      box-shadow: 0px 4px 17.6px 0px rgba(0, 0, 0, 0.25) !important;
    }

    .navbar-profile {
      display: flex;
      align-items: center;
    }

    .navbar-profile .username {
      margin-left: 10px;
      color: white;
    }

    .base {
      display: flex;
    }

    .sideBar {
      width: 305px;
      height: 100vh;
      background: #333232;
      padding-top: 80px;
      padding-left: 20px;
      position: fixed;
    }

    .container {
      display: flex;
      justify-content: center;
      padding-left: 305px;
      padding-top: 60px;
    }

    .feed {
      width: 645px;
      height: 100vh;
      background: transparent;
      margin-top: 30px;
    }

    .createPost {
      display: flex;
      align-items: center;
      padding: 10px;
      border-radius: 15px;
      border: 1px solid #3D3B3B;
      background: linear-gradient(94deg, #333232 0.46%, #363535 99.54%);
    }

    .postInput {
      margin-left: 10px;
      padding-left: 20px;
      padding-top: 7px;
      border-radius: 27.5px;
      background: #4F4E4E;
      width: 100vw;
    }

    .postInput p {
      font-size: 20px;
      color: #B0B0B0;
      line-height: normal;
    }

    .postCard {
      padding-top: 10px;
      padding-bottom: 70px;
      border-radius: 15px;
      border: 1px solid #3D3B3B;
      background: linear-gradient(94deg, #333232 0.46%, #363535 99.54%);
      overflow: hidden;
    }

    .postCard h4 {
      font-size: 15px;
    }

    .postTop{
      padding-inline: 10px;
    }

    .timePosted {
      color: #A7A7A7;
      font-size: 15px;
    }
  </style>
</head>

<body data-bs-theme="dark">
  <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/img/blinkchat-logo.svg" alt="blinkchat logo"></a>
      <li class="nav-item navbar-profile ml-auto">
        <img src="assets/img/user-avatar.jpg" alt="Profile" class="profile-pic">
        <span class="username mx-3">Mark Louie Villanueva</span>
      </li>
    </div>
  </nav>
  <div class="base">
    <div class="sideBar">
      <h1>Friends</h1>
    </div>
    <div class="container">
      <div class="feed">
        <div class="createPost">
          <img src="assets/img/user-avatar.jpg" alt="user" class="profile-pic">
          <div class="postInput">
            <p>Post something to blink a friend!</p>
          </div>
        </div>
        <div class="postCard my-3">
          <div class="postTop d-flex m-2">
            <img src="assets/img/user-avatar.jpg" alt="Profile" class="profile-pic me-3">
            <p>Mark Louie Villanueva<br><span class="timePosted">7m</span></p>
          </div>
          <div class="postContent">
            <img src="assets/img/siargao.jpg" class="">
          </div>
        </div>
        <div class="postCard my-3">
          <div class="postTop d-flex m-2">
            <img src="assets/img/user-avatar.jpg" alt="Profile" class="profile-pic me-3">
            <p>Mark Louie Villanueva<br><span class="timePosted">7m</span></p>
          </div>
          <div class="postContent">
            <img src="assets/img/siargao.jpg" class="">
          </div>
        </div>
        <div class="postCard my-3">
          <div class="postTop d-flex m-2">
            <img src="assets/img/user-avatar.jpg" alt="Profile" class="profile-pic me-3">
            <p>Mark Louie Villanueva<br><span class="timePosted">7m</span></p>
          </div>
          <div class="postContent">
            <img src="assets/img/siargao.jpg" class="">
          </div>
        </div>
        <div class="postCard my-3">
          <div class="postTop d-flex m-2">
            <img src="assets/img/user-avatar.jpg" alt="Profile" class="profile-pic me-3">
            <p>Mark Louie Villanueva<br><span class="timePosted">7m</span></p>
          </div>
          <div class="postContent">
            <img src="assets/img/siargao.jpg" class="">
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>

</html>