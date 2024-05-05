<?php
session_start();
if(isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}



include 'template/template_header.php';
include 'template/template_footer.php';
include 'functions/Account.php';

$msgErr = '';
$msg ='';
$idNum = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $idNum = $_POST["IDNUM"];
    $password = $_POST["password"];

    // Validate required fields
    if (empty($idNum) || empty($password)) {
        $msgErr = "ID number and password are required!";
        echo "<script>alert('$msgErr')</script>";
    } else {
        // Perform further validation if needed
        // Authenticate user
        $loginMsg = Login_Account($idNum, $password);

        if ($loginMsg === 'success') {
            // echo "<script>alert('$loginMsg')</script>";
            $_SESSION["user_id"] = $idNum;
            header('Location: index.php');
            exit();
        } else {
            // Authentication failed, display error message
            $msgErr = $loginMsg;
            echo "<script>alert('$msgErr')</script>";
        }
    }
}

?>


<?=template_header("Login - Portal")?>
    <body class="bg">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
                                            <div class="form-floating mb-3">
                                                <input name="IDNUM" class="form-control" id="inputIdNum" type="text" placeholder="ID-Number" />
                                                <label for="inputIdNum">ID Number</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="password" class="form-control" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <input type="submit" class="btn btn-primary" value="Login">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
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
