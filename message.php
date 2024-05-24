<?php
    include 'template/template_header.php';
    include 'template/template_top-nav.php';
    include 'template/template_sideNav.php';
    include 'template/template_footer.php';
    include 'functions/Members.php'; 

    // Get the receiver ID from the session or any other source
    $receiver_id = $_SESSION['user_id'];



    // Fetch messages for the specified receiver
    $messages = getMessagesForReceiver($receiver_id);
?>

<?= template_header("Message") ?>
<body class="sb-nav-fixed">
    <?= template_topnav() ?>
    <div id="layoutSidenav">
        <?= template_sideNav("messages") ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Messages</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard / Messages</li>
                    </ol>

                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                            <div class="list-group">
                                    <?php foreach ($messages as $message): ?>
                                        <?php echo '
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div>
                                            <p style="font-size:11px;">Message from : <strong style="text-transform: uppercase;">'.get_account_name($message['sender_id']).'</strong></p>
                                               
                                            <h5 class="mb-1">' . htmlspecialchars($message['title']) . '</h5>
                                            </div>
                                            <p class="mb-1">' . htmlspecialchars($message['message']) . '</p>
                                             <small>' . htmlspecialchars($message['sent_date']) . '</small>
                                        </a>
                                        '; ?>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                        </div>
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
