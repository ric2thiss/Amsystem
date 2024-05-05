<?php
    include 'template/template_header.php';
    include 'template/template_top-nav.php';
    include 'template/template_sideNav.php';
    include 'template/template_footer.php';
    include 'functions/Posts.php';

    $posts = getAllPost_admin();
    $pendingCount = countAllPost_admin();
    $activeCount = countAllPublishedPost_admin();

    $userData = get_account_all_information($_SESSION["user_id"]);

    // echo "<script>alert({$_SESSION["user_id"]})</script>";

    if(!$userData["isAdmin"] > 0){
       header("Location: newsfeed.php");
    }


?>

<?=template_header("Dashboard") ?>
    <body class="sb-nav-fixed">
        <?=template_topnav() ?>
        <div id="layoutSidenav">
            <?=template_sideNav("dashboard")?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Pending Posts 
                                        <h1><?php echo $pendingCount ?></h1>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Posts</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Active Posts
                                    <h1><?php echo $activeCount ?></h1>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Posts</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Archive Posts
                                    <h1><?php echo $pendingCount ?></</h1>
                                    </div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Posts</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Bar Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div> -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Pending Posts
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Post ID</th>
                                            <th>USER ID</th>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Department</th>
                                            <th>Description</th>
                                            <th>Date / Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        foreach($posts as $post){
                                            $accountname = get_account_name($post["USERID"]);
                                            $_GET["id"]= $post['POST_ID'];
                                            echo '
                                            <tr>
                                                <td>'.$post["POST_ID"].'</td>
                                                <td>'.$post["USERID"].'</td>
                                                <td>'.$accountname.'</td>
                                                <td>'.$post["POST_TITLE"].'</td>
                                        <td>'.$post["POST_DEPARTMENTORG"].'</td>
                                        <td>'.$post["POST_DESCRIPTION"].'</td>
                                                <td>'.$post["post_date"].'</td>
                                                    <td>
                                                    <a href="approve.php?id='.$_GET["id"].'">Approve</a><br>
                                                    <a href="delete.php?id='.$_GET["id"].'">Delete</a>
                                                    </td>
                                            </td>
                                        </tr>
                                            
                                            ';
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
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
