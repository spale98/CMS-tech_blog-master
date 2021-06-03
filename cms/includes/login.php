<?php include "db.php"; ?>
<?php include "../admin/functions.php"; ?>
<?php session_start(); ?>

<?php

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    /**
     * SQL Injection
     */
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user = mysqli_query($connection, $query);

    confirmQuery($select_user);


    while ($row = mysqli_fetch_assoc($select_user)) {
        $db_user_id = $row['user_id'];
        $db_user_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }

    if (password_verify($password, $db_user_password)) {

        $_SESSION['username'] = $db_user_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        header("Location: ../admin");

    } else {
        header("Location: ../index.php");
    }
}
