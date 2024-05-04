<?php
    include 'template/template_header.php';
    include 'template/template_top-nav.php';
    include 'template/template_sideNav.php';
    include 'template/template_footer.php';
    

    // Get user information based on session user ID
    $userData = get_account_all_information($_SESSION["user_id"]);

    // Access user data directly without looping
    if ($userData) {
        $firstname = $userData["USERS_FIRSTNAME"];
        $lastname = $userData["USERS_LASTNAME"];
        $contact = $userData["USERS_CONTACT"];
        $email = $userData["USERS_EMAIL"];
        $id = $userData["USERS_ID_NUMBER"];
        $department = $userData["USERS_DEPARTMENT"];
        $program = $userData["USERS_PROGRAM"];
        $password = $userData["USERS_PASSWORD"];
    } else {
        // Handle case where user data is not found
        echo "<script>alert('User data not found!')</script>";
        // You might want to redirect the user to a different page or display an error message on this page
}

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $newFirstName = $_POST['firstname'];
        $newLastName = $_POST['lastname'];
        $newContact = $_POST['contact'];
        $newEmail = strtolower($_POST['email']);
        $newPassword = $_POST['password'];

        if (empty($newFirstName) || empty($newLastName) || empty($newEmail)) {
            echo "<script>alert('Please fill in all required fields.')</script>";
        } else {
            // Retrieve the user ID from the session
            $userId = $_SESSION['user_id'];
            
            // Update user information
            $result = update_user($userId, $newFirstName, $newLastName, $newContact, $newEmail, $newPassword);
            
            if ($result) {
                echo "<script>alert('User information updated successfully!')</script>";
            } else {
                echo "<script>alert('Failed to update user information.')</script>";
            }
        }
    }

?>

<?=template_header("Settings") ?>
    <body class="sb-nav-fixed">
        <?=template_topnav() ?>
        <div id="layoutSidenav">
        <?=template_sideNav("settings")?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Profile</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard / Profile</li>
                        </ol>
  
                        
                        <div class="container">
                            <div class="card-body">
                                        <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="POST">
                                            <!-- First name last name -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo  $firstname ?>" name="firstname" class="form-control text-uppercase" id="inputFirstName" type="text" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">First Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input value="<?php echo $lastname ?>" name="lastname" class="form-control text-uppercase" id="inputLastName" type="text" placeholder="Enter your last name" />
                                                        <label for="inputLastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Contact -->
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $contact ?>" name="contact" class="form-control text-uppercase" id="inputContact" type="number" placeholder="Contact" />
                                                <label for="inputEmail">Contact</label>
                                            </div>
                                            <!-- Email Address -->
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $email ?>" name="email" class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <!-- Id Number -->
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $id ?>" name="IDNUM" class="form-control" id="inputIDNUM" type="text"  placeholder="ID-Number" disabled />
                                                <label for="inputIdNum">ID-Number</label>
                                            </div>
                                            <!-- Department and Program -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $department ?>" name="department" class="form-control" id="inputDepartment" type="text" placeholder="Department" disabled/>
                                                        <label for="inputDepartment">Department</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $program ?>" name="program" class="form-control" id="inputProgram" type="text" placeholder="Program" disabled />
                                                        <label for="inputProgram">Program</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Password -->
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $password ?>" name="password" class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassowrd">Password</label>
                                            </div>
                                            <!-- Submit -->
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input name="submit"
                                                 type="submit"
                                                 class="btn btn-primary btn-block" value="Update Account">
                                                </div>
                                            </div>
                                        </form>
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
