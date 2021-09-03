<?php
    session_start();
?>
<?php
    include("config/db.php");
    $id = $_SESSION['id'];
    $query = "SELECT * FROM profile WHERE id = '$id'";
    $result = mysqli_query($connect, $query) or die('error');
    if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $avatar = $row['avatar'];
            $profession = $row['profession'];
        }
    }
?>
<?php if(!$_SESSION['username']) :?>
    <?php header('Location: login.php'); ?>
<?php else :?>

<?php include("inc/header-index.php") ?>


    <div class="container">
        <?php if($_SESSION['id'] == 1): ?>
        <h1>Admin DashBoard</h1>
        <?php else: ?>
        <h1>User DashBoard</h1>
        <?php endif; ?>
        <h1 style="text-align: center";><?php echo $_SESSION['username'] ?></h1>
        <div class="row">
            <div class="col-lg-12">
                <p style="text-align: center">
                    <img src= <?php echo $avatar; ?> alt="Avatar" style="width: 200px;height: 200px;border-radius: 50%" />
                </p>
            </div>
        </div>
    </div>

<?php include("inc/footer.php") ?>

<?php endif; ?>
