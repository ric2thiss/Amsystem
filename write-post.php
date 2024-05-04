<?php
    include 'template/template_header.php';
    include 'template/template_top-nav.php';
    include 'template/template_sideNav.php';
    include 'template/template_footer.php';
    include 'functions/Posts.php';

    $msgErr = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Corrected REQUEST_METHOD condition
        $title = sanitize($_POST["title"]);
        $departmentOrg = sanitize($_POST["departmentOrg"]);
        $description = sanitize($_POST["description"]);
    
        if (empty($title) || empty($departmentOrg) || empty($description)) {
            $msgErr = "All fields are required!";
        } else {
            $insertMsg = write_post($_SESSION["user_id"]); // Call write_post function
    
            // Check message returned from write_post function
            if ($insertMsg === 'success') {
                // Post inserted successfully
                echo "
                <script>
                    alert('Post inserted successfully!')
                    window.location = 'home.php';
                </script>";
                // You can redirect or perform other actions here
            } else {
                // Failed to insert post
                echo "<script>alert('Failed to insert post.')</script>";
            }
        }
    }
    
    function sanitize($data) {
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<?=template_header("Write Post") ?>
    <body class="sb-nav-fixed">
        <?=template_topnav() ?>
        <div id="layoutSidenav">
        <?=template_sideNav("write-post")?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Add Post</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard / Write Post</li>
                        </ol>
  
                        <div class="container">
                            <span class="text-danger"><?php echo $msgErr ?></span>
                            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
                                <div class="form-floating mb-3">
                                    <input name="title" type="text" class="form-control" id="floatingInput" placeholder="Title">
                                    <label for="floatingInput">Title</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input name="departmentOrg" type="text" class="form-control" id="floatingInput" placeholder="Org / Department">
                                    <label for="floatingInput">Org / Department</label>
                                </div>

                                <div class="form-floating">
                                    <textarea name="description" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Description</label>
                                </div>
                                <button type="submit" class="mt-5 btn btn-primary"> Post Announcement</button>
                        </form>


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
