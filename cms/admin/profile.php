<?php include ('includes/header.php'); ?>
<?php include ('functions.php'); ?>

<?php
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        $query = "SELECT * FROM users WHERE username = '{$username}' ";
        $select_user_profile = mysqli_query($connection, $query);

        confirmQuery($select_user_profile);

        while ($row = mysqli_fetch_assoc($select_user_profile)) {
            $user_id = $row['user_id'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $username = $row['username'];
            $user_email = $row['user_email'];

            $user_image = $_FILES['image']['name'];
            $user_image_temp = $_FILES['image']['tmp_name'];

            $user_password = $row['user_password'];
            $user_role = $row['user_role'];
        }
    }

?>

<?php
if (isset($_POST['update_user'])) {

//    $user_id = $_POST['user_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    $user_password = $_POST['user_password'];
    $user_role = $_POST['user_role'];


    if (!empty($user_password)) {
        //$query = "SELECT user_password FROM users WHERE user_id = $the_user_id";
        $get_user_query = mysqli_query($connection, $query);
        confirmQuery($get_user_query);

        $row = mysqli_fetch_array($get_user_query);

        $db_user_password = $row['user_password'];

        if ($db_user_password != $user_password) {
            $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
        }
    }

    // TODO: Fix image upload
//    move_uploaded_file($user_image_temp, "../images/$user_image");

//    global $user_id;

    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$hashed_password}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE user_id = {$user_id}";

    $update_user = mysqli_query($connection, $query);
    confirmQuery($update_user);

    /**
     * Is this correct?
     */
    $query = "SELECT * FROM users WHERE user_id = '{$user_id}' ";
    $get_id_for_seesion = mysqli_query($connection, $query);

    confirmQuery($get_id_for_seesion);

    while ($row = mysqli_fetch_assoc($select_user_profile)) {
        $username = $row['username'];
    }

    $_SESSION['username'] = $username;


}
?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include ('includes/navigation.php'); ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header">
                        Your Profile
                        <small>Manage your profile, <i><?php echo $_SESSION['username'] ?></i></small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data" class="col-lg-8">
                        <div class="form-group">
                            <div class="form-group">
                                <label for="firstname">Firstname</label>
                                <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname ?>">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Lastname</label>
                                <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" value="<?php echo $username ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="user_email" value="<?php echo $user_email ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="user_password" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="image">User Profile Picture</label>
                                <input type="file" name="image">
                            </div>
                            <div class="form-group">
                                <label for="user_role">Select the Role Option:</label>
                                <select name="user_role" class="form-control" id="user_role">
                                    <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
                                    <?php if ($user_role == 'Subscriber') : ?>
                                        <option value="Admin">Admin</option>
                                    <?php else: ?>
                                        <option value="Subscriber">Subscriber</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="update_user" value="Update Profile Information"
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include ('includes/footer.php'); ?>
