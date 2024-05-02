<?php
    include 'template/template_header.php';
    include 'template/template_top-nav.php';
    include 'template/template_sideNav.php';
    include 'template/template_footer.php';
    include 'functions/Posts.php';

    include 'template/template_posts.php';

    $posts = getAllPost_admin();
    $pendingCount = countAllPost_admin();
    $activeCount = countAllPublishedPost_admin();

    $userData = get_account_all_information($_SESSION["user_id"]);



?>

<?=template_header("Newsfeed") ?>
    <body class="sb-nav-fixed">
        <?=template_topnav() ?>
        <div id="layoutSidenav">
            <?=template_sideNav("newsfeed")?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h2 class="mt-4">Welcome, <?php echo $userData["USERS_FIRSTNAME"]?></h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row d-flex flex-col">
                            <?php get_all_post() ?>
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
