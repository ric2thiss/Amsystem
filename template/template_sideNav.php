<?php

include 'functions/Account.php';
session_start();
if(!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

function template_sideNav($title){
    $dashboardClass = ($title == "dashboard") ? "active" : "";
    $writePostClass = ($title == "write-post") ? "active" : "";
    $pedingPostClass = ($title == "pending-post") ? "active" : "";
    $profileClass = ($title == "profile") ? "active" : "";
    $publishedPostClass = ($title == "published-post") ? "active" : "";
    $newsfeedPostClass = ($title == "newsfeed") ? "active" : "";

    $userData = get_account_all_information($_SESSION["user_id"]);

    if($userData["isAdmin"] > 0){
        return '
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Menu</div>
                    <a class="nav-link  ' . $dashboardClass . '" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <a class="nav-link ' . $writePostClass . '" href="write-post.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-pen-to-square"></i></div>
                        Write Post
                    </a>
                    <a class="nav-link ' . $pedingPostClass . '" href="pending-post.php">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-clock"></i></div>
                        Pending Post
                    </a>
                    <a class="nav-link ' . $publishedPostClass . '" href="published-post.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-check"></i></div>
                        Published Post
                    </a>
                    <a class="nav-link ' . $newsfeedPostClass . '" href="newsfeed.php">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-comment"></i></div>
                        Newsfeed
                    </a>
                    <a class="nav-link ' . $profileClass . '" href="profile.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Profile
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: </div>
                <div class="text-light text-uppercase">'.get_account_name($_SESSION["user_id"]).'</div>
            </div>
        </nav>
    </div>
    ';
    }else{
        return '
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Menu</div>
                    <a class="nav-link  ' . $dashboardClass . '" href="newsfeed.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Newsfeed
                    </a>
                    <a class="nav-link ' . $writePostClass . '" href="write-post.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-pen-to-square"></i></div>
                        Write Post
                    </a>
                    <a class="nav-link ' . $profileClass . '" href="profile.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Profile
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as: </div>
                <div class="text-dark text-uppercase">'.get_account_name($_SESSION["user_id"]).'</div>
            </div>
        </nav>
    </div>
    ';
    }

}

?>
