<?php include "../functions.php"; ?>
<?php
if (isset($_POST['create_user'])) {

    $user_id = escape($_POST['user_id']);
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    $username = escape($_POST['username']);
    $user_email = escape($_POST['user_email']);

    $user_image = escape($_FILES['image']['name']);
    $user_image_temp = escape($_FILES['image']['tmp_name']);

    $user_password = escape($_POST['user_password']);
    $user_role = escape($_POST['user_role']);
//    $post_comment_count = 4;




    // TODO: Fix image upload
    move_uploaded_file($user_image_temp, "../images/$user_image");

    $query = "INSERT INTO users (user_firstname, user_lastname, username, user_email, user_password, user_role, user_image) ";
    $query .= "VALUES ('{$user_firstname}', '{$user_lastname}', '{$username}', '{$user_email}', '{$user_password}', '{$user_role}', '{$user_image}')";

    $create_user = mysqli_query($connection, $query);

    confirmQuery($create_user);

    echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
}
?>

<form action="" method="post" enctype="multipart/form-data" class="col-lg-8">
    <div class="form-group">
        <div class="form-group">
            <label for="firstname">Firstname</label>
            <input type="text" class="form-control" name="user_firstname">
        </div>
        <div class="form-group">
            <label for="lastname">Lastname</label>
            <input type="text" class="form-control" name="user_lastname">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="user_email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="user_password">
        </div>
        <div class="form-group">
            <label for="image">User Profile Picture</label>
            <input type="file" name="image">
        </div>
        <div class="form-group">
            <label for="user_role">Select the Role Option:</label>
            <select name="user_role" class="form-control" id="user_role">
<!--                <option value="subscriber" >Select Options</option>-->
                <option value="Admin">Admin</option>
                <option value="Subscriber">Subscriber</option>
                <option value="" ></option>
                <option value="" ></option>

            </select>
        </div>

    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User"
    </div>
 </form>