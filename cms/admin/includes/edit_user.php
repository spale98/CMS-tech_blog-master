<?php include "../functions.php"; ?>

<?php
    if (isset($_GET['edit_user'])) {

        $the_user_id = $_GET['edit_user'];


        $query = "SELECT * FROM users WHERE user_id = {$the_user_id}";
        $select_user = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_user)) {
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
        ?>

        <?php
        if (isset($_POST['edit_user'])) {

            $user_id = escape($_POST['user_id']);
            $user_firstname = escape($_POST['user_firstname']);
            $user_lastname = escape($_POST['user_lastname']);
            $username = escape($_POST['username']);
            $user_email = escape($_POST['user_email']);

            $user_image = escape($_FILES['image']['name']);
            $user_image_temp = escape($_FILES['image']['tmp_name']);

            $user_password = escape($_POST['user_password']);
            $user_role = escape($_POST['user_role']);


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

            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_password = '{$hashed_password}', ";
            $query .= "user_role = '{$user_role}' ";
            $query .= "WHERE user_id = {$the_user_id} ";

            $update_user = mysqli_query($connection, $query);

            confirmQuery($update_user);

            echo "<p class='bg-success'>User Updated <a href='users.php'>View Users</a> </p>";
        }
    } else {
        header("Location: index.php");
    }
?>

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
            <input type="password" autocomplete="off" class="form-control" name="user_password" ">
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

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User"
    </div>
</form>