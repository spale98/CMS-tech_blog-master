<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
    if (isset($_POST['submit'])) {

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $email = mysqli_real_escape_string($connection, $email);
        $password = mysqli_real_escape_string($connection, $password);
        $first_name = mysqli_real_escape_string($connection, $first_name);
        $last_name = mysqli_real_escape_string($connection, $last_name);

        if (!empty($username) && !empty($email) && !empty($password)){

            $username_query = "SELECT * FROM users WHERE username = '{$username}'";
            $db_username = mysqli_query($connection, $username_query);

            $email_query = "SELECT * FROM users WHERE user_email = '{$email}'";
            $db_email = mysqli_query($connection, $email_query);

            if (strlen($password) >= 8 && preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password)) {


                // Check is username or email already exists
                if (mysqli_num_rows($db_username) >= 1 || mysqli_num_rows($db_email) >= 1 ) {
                    $message = "Username od Email already exists";
                } else {
                    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

                    $query = "INSERT INTO users (user_firstname, user_lastname, username, user_email, user_password, user_role) ";
                    $query .= "VALUES ('{$first_name}', '{$last_name}', '{$username}', '{$email}', '{$password}', 'Subscriber')";

                    $register_user = mysqli_query($connection, $query);

                    $message = "Your Registration has been submitted. <a href='index.php'>Go To Home Page</a>";
                }

            } else {
                $message = "Your password is short.<br>Please, Enter a password with a combination of letters and numbers";
            }


        } else {
            $message = "Please, fill all fields.";
        }



    } else {
        $message = "";
    }
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <div class="message">
                        <p class="bg-info text-center"><?php echo $message ?></p>
                    </div>
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="first_name" class="sr-only">First Name:</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter Desired First Name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="sr-only">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Desired Last Name" required>
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password" required>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>


                </div>

            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
