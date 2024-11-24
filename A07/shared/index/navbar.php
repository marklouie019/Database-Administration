<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="assets/img/ui/blinkchat-logo.svg" alt="blinkchat logo"></a>
        <li class="nav-item navbar-profile ml-auto">
            <img src="assets/img/users/louie.jpeg" alt="Profile" class="profile-pic">
            <span class="username mx-3">Mark Louie Villanueva</span>
        </li>
    </div>
</nav>

<!-- SIDEBAR -->
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