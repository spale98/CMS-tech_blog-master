<table class="table table-hover">
    <thead>
    <tr>
        <th>Comment Id</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response to</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * FROM comments";
    $select_all_posts = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_posts)) {
        $comment_id = escape($row['comment_id']);
        $comment_post_id = escape($row['comment_post_id']);
        $comment_date = escape($row['comment_date']);
        $comment_author = escape($row['comment_author']);
        $comment_email = escape($row['comment_email']);
        $comment_content = escape($row['comment_content']);
        $comment_status = escape($row['comment_status']);

        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_content</td>";
        echo "<td>$comment_email</td>";
        echo "<td>$comment_status</td>";

        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $select_post = mysqli_query($connection, $query);


        while ($row = mysqli_fetch_assoc($select_post)) {
            $post_id = escape($row['post_id']);
            $post_title = escape($row['post_title']);

            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
        }
        echo "<td>$comment_date</td>";
        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='comments.php?delete=$comment_id'>Delete</a></td>";
        echo "</tr>";
    }
    ?>

    <?php
    if (isset($_GET['approve']))
    {
        $the_comment_id = escape($_GET['approve']);

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
        $approve_comment_query = mysqli_query($connection, $query);
        confirmQuery($approve_comment_query);

        header("Location: comments.php");
    }
    if (isset($_GET['unapprove']))
    {
        $the_comment_id = escape($_GET['unapprove']);

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
        $unapprove_comment_query = mysqli_query($connection, $query);
        confirmQuery($unapprove_comment_query);

        header("Location: comments.php");
    }
    ?>

    <?php
    if (isset($_GET['delete'])) {

        $the_comment_id = escape($_GET['delete']);

        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";

        $delete_comment = mysqli_query($connection, $query);

        confirmQuery($delete_comment);

        header ("Location: comments.php");
    }
    ?>
    </tbody>
</table>

