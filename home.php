<?php
    include 'template/template_header.php';
    include 'template/template_top-nav.php';
    include 'template/template_sideNav.php';
    include 'template/template_footer.php';
    include 'functions/Posts.php';

    include 'template/template_posts.php';

    // $posts = getAllPost_admin();
    // $pendingCount = countAllPost_admin();
    // $activeCount = countAllPublishedPost_admin();

    $userData = get_account_all_information($_SESSION["user_id"]);



?>


<style>
    .profile_container{
        box-shadow: 0px 10px 27px 0px rgba(0,0,0,0.1);
    }
</style>

<?=template_header("Profile") ?>
    <body class="sb-nav-fixed">
        <?=template_topnav() ?>
        <div id="layoutSidenav">
            <?=template_sideNav("profile")?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="container profile_container border mx-auto row mt-5">
                            <div class=" d-flex align-items-center p-4">
                                <img src="./assets/profile.webp" alt="profile" width="20%">
                                <div class=" d-flex flex-column">
                                    <span class="text-uppercase"><?php echo $userData["USERS_FIRSTNAME"]. " " . $userData["USERS_LASTNAME"]?></span>
                                    <span class="text-uppercase">ID : <?php echo $userData["USERS_ID_NUMBER"] ?></span>
                                    <span>Department: <?php echo $userData["USERS_DEPARTMENT"]?></span>
                                    <span class="text-uppercase">Program : <?php echo $userData["USERS_PROGRAM"] ?></span>

                                    <span>Registration Date/Time: <?php echo $userData["reg_date"]?></span>
                                </div>
                            </div>
                        </div>

                        <ol class="breadcrumb mb-4 mt-4">
                            <li class="breadcrumb-item">Dashboard > Home </li>
                        </ol>
                        <div class="p-3 row d-flex flex-col" style="box-shadow: 0px 10px 27px 0px rgba(0,0,0,0.1);">
                            <?php get_all_my_posts($_SESSION["user_id"]) ?>
                        </div>
    

                    </div>
                </main>
                <?=template_footer()?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
