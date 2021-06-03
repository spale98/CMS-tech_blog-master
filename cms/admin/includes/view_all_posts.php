<?php
    if (isset($_POST['checkBoxArray'])) {
        foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
            $bulk_options = escape($_POST['bulk_options']);


            switch ($bulk_options) {
                case 'Published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue} ";
                    $update_post_to_published = mysqli_query($connection, $query);
                    confirmQuery($update_post_to_published);
                    echo "<p class='bg-success'> The Post has been Published. </p>";
                    break;
                case 'Draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$checkBoxValue}";
                    $update_post_to_draft = mysqli_query($connection, $query);
                    confirmQuery($update_post_to_draft);
                    echo "<p class='bg-success'>The Post is set as a Draft</p>";
                    break;
                case 'delete':
                    $query = "DELETE FROM comments WHERE comment_post_id = {$checkBoxValue}";
                    $delete_comment = mysqli_query($connection, $query);
                    confirmQuery($delete_comment);
                    $query = "DELETE FROM posts WHERE post_id = {$checkBoxValue}";
                    $delete_post = mysqli_query($connection, $query);
                    confirmQuery($delete_post);
                    echo "<p class='bg-success'>The Post has been Deleted</p>";
                    break;
                case 'clone':
                    $query = "SELECT * FROM posts WHERE post_id = {$checkBoxValue}";
                    $select_post = mysqli_query($connection, $query);

                    confirmQuery($select_post);

                    while ($row = mysqli_fetch_array($select_post)) {
                        $post_title = escape($row['post_title']);
                        $post_category_id = escape($row['post_category_id']);
                        $post_author = escape($row['post_author']);
                        $post_date = escape($row['post_date']);
                        $post_content = escape($row['post_content']);
                        $post_image = escape($row['post_image']);
                        $post_status = escape($row['post_status']);
                        $post_tags = escape($row['post_tags']);
                    }

                    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status, post_view_count) ";
                    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}', 0)";

                    $clonePost = mysqli_query($connection, $query);
                    confirmQuery($clonePost);
                    break;
                case 'reset':

                    $query = "UPDATE posts SET post_view_count = 0 WHERE post_id = {$checkBoxValue}";
                    $update_post_view_count = mysqli_query($connection, $query);

                    confirmQuery($update_post_view_count);

                    echo "<p class='bg-success'>Post Views has been Reset</p>";
                    break;
                default:
                    echo "<p class='bg-info'>Please, choose any option.</p>";
                    break;
            }
        }
    }
?>

<form action="" method="post">
    <table class="table table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select name="bulk_options" id="" class="form-control">
                <option value="">Select Options</option>
                <option value="Published">Publish</option>
                <option value="Draft">Draft</option>
                <option value="delete">Delete</option>
                <option value="clone">Clone</option>
                <option value="reset">Reset Views</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New Post</a>
        </div>
        <thead>
            <tr>
                <th><input id='selectAllBoxes' type='checkbox'></th>
                <th>Post Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Views</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM posts ORDER BY post_id DESC";
        $select_all_posts = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_all_posts)) {
            $post_id = escape($row['post_id']);
            $post_author = escape($row['post_author']);
            $post_title = escape($row['post_title']);
            $post_category = escape($row['post_category_id']);
            $post_status = escape($row['post_status']);
            $post_image = escape($row['post_image']);
            $post_tags = escape($row['post_tags']);
            $post_date = escape($row['post_date']);
            $post_view_count = escape($row['post_view_count']);

            echo "<tr>";
            ?>
            <td>
                <input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'>
            </td>
            <?php
                echo "<td>$post_id</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_title</td>";

                $query = "SELECT * FROM categories WHERE category_id = $post_category ";
                $select_category = mysqli_query($connection, $query);

                $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                $select_comments = mysqli_query($connection, $query);
                
                $count_comments = mysqli_num_rows($select_comments);

                while ($row = mysqli_fetch_assoc($select_category)) {
                    $category_id = escape($row['category_id']);
                    $category_title = escape($row['category_title']);

                    echo "<td>$category_title</td>";
                }
                echo "<td>$post_status</td>";
                echo "<td><img src='../images/$post_image' width='100' class='img-responsive'></td>";
                echo "<td>$post_tags</td>";
                echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";
                echo "<td>$post_date</td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to reset the number of views?');\" href='posts.php?reset={$post_id}' name='reset'>$post_view_count</a></td>";
                echo "<td><a href='../post.php?&p_id={$post_id}' target='_blank' name='edit'>View Post</a></td>";
                echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' name='edit'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='posts.php?delete={$post_id}' name='delete'>Delete</a></td>";

            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</form>
    <?php
    if (isset($_GET['delete'])) {

        $the_post_id = escape($_GET['delete']);

        $query = "DELETE FROM comments WHERE comment_post_id = {$the_post_id}";
        $delete_comments = mysqli_query($connection, $query);

        confirmQuery($delete_comments);

        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";

        $delete_post = mysqli_query($connection, $query);

        confirmQuery($delete_post);



        header("Location: posts.php");
    }
    ?>
    <?php
    if (isset($_GET['reset'])) {

        $the_post_id = escape($_GET['reset']);

        $query = "UPDATE posts SET post_view_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
        $update_post_view_count = mysqli_query($connection, $query);

        confirmQuery($update_post_view_count);


        header("Location: posts.php");
    }
    ?>