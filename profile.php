<?php session_start(); ?>
<?php
    include('config/db.php');
    if(isset($_FILES['avatar'])) {
        $profession = $_POST['profession'];
        if($profession != '') {
            $upload = 1;
            $file_name = $_FILES['avatar']['name'];
            $file_size = $_FILES['avatar']['size'];
            $file_tmp = $_FILES['avatar']['tmp_name'];
            $file_type = $_FILES['avatar']['type'];
            $target_dir = "assets/upload";
            $target_file = $target_dir.'/'. basename($file_name);
            $check = getimagesize($file_tmp);

            $file_ext = strtolower(end(explode('.', $file_name)));
            $extension = array("jpeg", "jpg", "png");


            if(in_array($file_ext, $extension) == false) {
                $msg = "Please choose the image which has the extension as jpeg, jpg, png";
            }
            if(file_exists($target_file)) {
                $msg = "File already exits!";
            }
            if($check == false) {
                $msg = "File is not an image";
            }
            if(!isset($msg)) {
                move_uploaded_file($file_tmp, "assets/upload/" . $file_name);
                $url = $_SERVER['HTTP_REFERER'];
                $short_url = explode('/', $url);
                $path = $short_url[0].'/'.$short_url[1].'/'.$short_url[2].'/'.$short_url[3];
                $full_url = $path.'/'.'assets/upload/'.$file_name;
                $id = $_SESSION['id'];
                $sql = "INSERT INTO profile(profession, avatar, user_role, user_id) VALUES ('$profession', '$full_url', $id, $id)";

                $query = $connect->query($sql);

                if($query) {
                    header('Location: dashboard.php');
                } else {
                    $msg = "Failed to Upload";
                }
            }
        } else {
            $msg = "Please fill all";
        }

    }
?>
<?php if(!isset($_SESSION['username'])) :?>
    <?php header('Location: index.php'); ?>
<?php else :?>
    <?php include("inc/header-index.php") ?>
    <!-- Main Content-->
    <div class="container">
        <form class="form-horizontal align-items-center" action="profile.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Login User</legend>


                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <label for="rofession" class="col-lg-2 col-form-label">Profession</label>
                            <div class="col-lg-10">
                                <input type="text" name="profession" class="form-control" placeholder="Profession">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="row">
                            <label for="avatar" class="col-lg-2 col-form-label">Avatar</label>
                            <div class="col-lg-10">
                                <input type="file" name="avatar" class="form-control" placeholder="Avatar">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="col-lg-10">
                                <input type="submit" name="profile" value="Add Profile" class="btn btn-primary">
                                <button type="reset" class="btn btn-danger">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group">
                        <div class="col-lg-6">
                            <?php if(isset($_POST['profile'])): ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <p><?php echo $msg ?></p>
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