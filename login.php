<?php
session_start();
include("config/db.php");

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username != '' && $password != '') {
        $passwd = sha1($password);
        $sql = "SELECT * FROM users WHERE username ='$username' AND password ='$passwd'";
        $result = mysqli_query($connect, $sql) or die('Error');

        if(mysqli_num_rows($result) != 0) {

            $row = $result->fetch_assoc();
            $id = $row['id'];
            $username = $row['username'];
            $password = $row['password'];
            $email = $row['email'];

            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $email;
            header('Location: index.php');
        } else {
            $error = "Username or Password is Incorrect!";
        }
    } else {
        $error = 'Please fill all data!';
    }
}
?>
<?php if(isset($_SESSION['username'])) :?>
    <?php header('Location: index.php'); ?>
<?php else :?>
<?php include("inc/header-index.php") ?>
    <!-- Main Content-->
    <div class="container">
        <form class="form-horizontal align-items-center" action="login.php" method="POST">
            <fieldset>
                <legend>Login User</legend>


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
                                <input type="submit" name="login" value="Login" class="btn btn-primary">
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-lg-6">
                            <?php if(isset($_POST['login'])): ?>
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

<?php endif; ?>