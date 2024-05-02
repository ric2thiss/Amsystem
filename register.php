<?php
// session_start();

// Redirect user to login page if already logged in
// if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true ) {
//     header("Location: login.php");
//     exit();
// }

include 'template/template_header.php';
include 'template/template_footer.php';
include 'functions/Account.php';

$msgErr = '';
$msg ='';
$firstname = $lastname = $contact = $email = $IDNUM = $department = $program = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $firstname = sanitizeInput($_POST["firstname"]);
    $lastname = sanitizeInput($_POST["lastname"]);
    $contact = sanitizeInput($_POST["contact"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $IDNUM = sanitizeInput($_POST["IDNUM"]);
    $department = sanitizeInput($_POST["department"]);
    $program = sanitizeInput($_POST["program"]);
    $password = $_POST["password"];

    // Hash the password
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Validate required fields
    if (empty($firstname) || empty($lastname) || empty($contact) || empty($email) || empty($IDNUM) || empty($department) || empty($program) || empty($password)) {
        $msgErr = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msgErr = "Invalid email format!";
    } else {
        // Perform further validation if needed
        // Insert into database or perform other actions
        $insert = Create_Account($firstname, $lastname, $contact, $email, $IDNUM, $department, $program, $password);
        $msg = $insert;

        $firstname = $lastname = $contact = $email = $IDNUM = $department = $program = $password = "";

    }
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>



<?=template_header("Create Account - Portal")?>
    <body class="bg">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                        <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <span class="text-center"><?php echo $msgErr?></span>
                                    <span class="text-center text-danger"><?php echo $msg?></span>
                                    <div class="card-body">
                                        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                                            <!-- First name last name -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $firstname?>" name="firstname" class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input value="<?php echo $lastname?>" name="lastname" class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" />
                                                        <label for="inputLastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Contact -->
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $contact?>" name="contact" class="form-control" id="inputContact" type="number" placeholder="Contact" />
                                                <label for="inputEmail">Contact</label>
                                            </div>
                                            <!-- Email Address -->
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $email?>" name="email" class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <!-- Id Number -->
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $IDNUM?>" name="IDNUM" class="form-control" id="inputIDNUM" type="text"  placeholder="ID-Number"/>
                                                <label for="inputIdNum">ID-Number</label>
                                            </div>
                                            <!-- Department and Program -->
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $department?>" name="department" class="form-control" id="inputDepartment" type="text" placeholder="Department" />
                                                        <label for="inputDepartment">Department</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input value="<?php echo $program?>" name="program" class="form-control" id="inputProgram" type="text" placeholder="Program" />
                                                        <label for="inputProgram">Program</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Password -->
                                            <div class="form-floating mb-3">
                                                <input value="<?php echo $password?>" name="password" class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassowrd">Password</label>
                                            </div>
                                            <!-- Submit -->
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input name="submit"
                                                 type="submit"
                                                 class="btn btn-primary btn-block" value="Create Account">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <?=template_footer()?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
