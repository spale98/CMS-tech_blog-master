<table class="table table-hover">
    <thead>
    <tr>
        <th>User Id</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
        <th colspan="3">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM users";
    $select_all_users = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $first_name= $row['user_firstname'];
        $last_name = $row['user_lastname'];
        $user_email= $row['user_email'];
        $user_role = $row['user_role'];

        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$username</td>";
        echo "<td>$first_name</td>";
        echo "<td>$last_name</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";
        if ($user_role == 'Subscriber') {
            echo "<td><a href='users.php?change_to_admin=$user_id'>Admin</a></td>";
        } else {
            echo "<td><a href='users.php?change_to_sub=$user_id'>Subscriber</a></td>";
        }
        echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='users.php?delete=$user_id'>Delete</a></td>";
        echo "</tr>";
    }
    ?>

    <?php
    if (isset($_GET['change_to_admin']))
    {
        $the_user_id = escape($_GET['change_to_admin']);

        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $the_user_id";
        $change_to_admin = mysqli_query($connection, $query);
        confirmQuery($change_to_admin);

        header("Location: users.php");
    }
    if (isset($_GET['change_to_sub']))
    {
        $the_user_id = escape($_GET['change_to_sub']);

        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $the_user_id";
        $change_to_sub = mysqli_query($connection, $query);
        confirmQuery($change_to_sub);

        header("Location: users.php");
    }
    ?>

    <?php
    if (isset($_GET['delete'])) {

        if (isset($_SESSION['user_role'])) {

            if ($_SESSION['user_role'] == 'Admin') {


                $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);

                $query = "DELETE FROM users WHERE user_id= {$the_user_id}";

                $delete_user = mysqli_query($connection, $query);

                confirmQuery($delete_user);

                header("Location: users.php");
            }
        }
    }
    ?>
    </tbody>
</table>

