<?php
    include("config/db.php");

    if(isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        if($username != '' && $email !='' && $password != '') {
            $pwd_hash = sha1($password);
            $sql = "INSERT INTO users (username, password, email, user_role) VALUES ('$username', '$pwd_hash', '$email', 1)";
            $query = $connect -> query($sql);
            if($query) {
                header('Location: login.php');
            } else {
                $error = 'Failed to Register!';
            }
        } else {
            $error = 'Please fill all data!';
        }
    }
?>

<?php include("inc/header-index.php") ?>
    <!-- Main Content-->
    <div class="container">
        <form class="form-horizontal align-items-center" action="register.php" method="POST">
            <fieldset>
                <legend>Register User</legend>


                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row">
                            <label for="username" class="col-lg-2 col-form-label">Username</label>
                            <div class="col-lg-10">
                                <input type="text" name="username" class="form-control" placeholder="Username">
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row">
                            <label for="email" class="col-lg-2 col-form-label">Email</label>
                            <div class="col-lg-10">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row">
                            <label for="password" class="col-lg-2 col-form-label">Password</label>
                            <div class="col-lg-10">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-lg-10">
                                <input type="submit" name="register" value="Register" class="btn btn-primary">
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-lg-6">
                        <?php if(isset($_POST['register'])): ?>
                        <div class="alert alert-danger alert-dismissible">
                        <p><?php echo $error ?></p>
                        </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
    <!-- Footer-->
<?php include("inc/footer.php") ?>

