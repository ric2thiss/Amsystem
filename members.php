<?php
include 'template/template_header.php';
include 'template/template_top-nav.php';
include 'template/template_sideNav.php';
include 'template/template_footer.php';
include 'functions/Posts.php';
include 'functions/Members.php';


$users = get_users_info();

?>

<?= template_header("Users") ?>
<body class="sb-nav-fixed">
    <?= template_topnav() ?>
    <div id="layoutSidenav">
        <?= template_sideNav("users") ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Users</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard / Users</li>
                    </ol>
                    
                    <div class="container">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Users
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>USER ID</th>
                                            <th>Name</th>
                                            <th>Department</th>
                                            <th>Program</th>
                                            <th>Registration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    foreach ($users as $user) {
                                        $userId = $user['USERID'];
                                        $_GET['id'] = $user['USERS_ID_NUMBER'];
                                        $isAdmin = $user['isAdmin'];  // Assuming there's a field to check if the user is an admin
                                        $displayNone = $isAdmin ? 'style="display:none;"' : '';
                                        $nomessage = ($user['USERID'] == $_SESSION["user_id"]) ? 'style="display:none;"' : '';

                                        echo '
                                        <tr>
                                            <td>' . htmlspecialchars($userId, ENT_QUOTES, 'UTF-8') . '</td>
                                            <td>' . htmlspecialchars($user['USERS_FIRSTNAME'], ENT_QUOTES, 'UTF-8') . ' ' . htmlspecialchars($user['USERS_LASTNAME'], ENT_QUOTES, 'UTF-8') . '</td>
                                            <td>' . htmlspecialchars($user["USERS_DEPARTMENT"], ENT_QUOTES, 'UTF-8') . '</td>
                                            <td>' . htmlspecialchars($user["USERS_PROGRAM"], ENT_QUOTES, 'UTF-8') . '</td>
                                            <td>' . htmlspecialchars($user["reg_date"], ENT_QUOTES, 'UTF-8') . '</td>
                                            <td>
                                                <a href="make_admin.php?id=' . urlencode($userId) . '" ' . $displayNone . '>Make Admin</a><br>
                                                <a href="message_user.php?id=' . urlencode($userId) .'" '.$displayNone.'>Message</a>
                                            </td>
                                        </tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
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
