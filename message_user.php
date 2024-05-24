<?php
    include 'template/template_header.php';
    include 'template/template_top-nav.php';
    include 'template/template_sideNav.php';
    include 'template/template_footer.php';
    include 'functions/Posts.php';
    include 'functions/Members.php';

    $msgErr = '';

    // Ensure recipient ID is captured, assuming it's passed as a GET parameter
    $recipient_id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = sanitize($_POST["title"]);
        $departmentOrg = sanitize($_POST["departmentOrg"]);
        $message = sanitize($_POST["message"]);
        
        if (empty($title) || empty($departmentOrg) || empty($message) || empty($recipient_id)) {
            $msgErr = "All fields are required!";
        } else {
            $insertMsg = write_message($_SESSION["user_id"], $recipient_id, $title, $departmentOrg, $message);
            
            if ($insertMsg === 'success') {
                echo "
                <script>
                    alert('Message sent successfully!');
                    window.location = 'members.php';
                </script>";
            } else {
                echo "<script>alert('Failed to send message.')</script>";
            }
        }
    }

    function sanitize($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
?>

<?= template_header("Message") ?>
<body class="sb-nav-fixed">
    <?= template_topnav() ?>
    <div id="layoutSidenav">
        <?= template_sideNav("message") ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Send Message</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard / Message</li>
                    </ol>

                    <div class="container">
                        <span class="text-danger"><?= $msgErr ?></span>
                        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . urlencode($recipient_id)) ?>" method="post">
                            <div class="form-floating mb-3">
                                <input name="title" type="text" class="form-control" id="floatingInput" placeholder="Title">
                                <label for="floatingInput">Title</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="departmentOrg" type="text" class="form-control" id="floatingInput" placeholder="Org / Department">
                                <label for="floatingInput">Org / Department</label>
                            </div>

                            <div class="form-floating">
                                <textarea name="message" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Description</label>
                            </div>
                            <button type="submit" class="mt-5 btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </main>
            <?= template_footer() ?>
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
