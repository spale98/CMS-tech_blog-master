<?php

function onlineUsers()
{


    if (isset($_GET['onlineusers'])) {

        global $connection;

        if (!$connection) {
            session_start();
            include("../../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 5;

            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '$session'";
            $send_query = mysqli_query($connection, $query);
            // Count is anyone online
            $count = mysqli_num_rows($send_query);

            if ($count == NULL) {
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', $time)");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = $time WHERE session = '$session'");
            }

            $user_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > $time_out");
            echo mysqli_num_rows($user_online);
        } // if (!$connection)
    } // get request
}

onlineUsers();