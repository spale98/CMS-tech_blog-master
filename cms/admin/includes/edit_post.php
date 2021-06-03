<?php

if (isset($_GET['p_id'])) {

    $the_post_id = escape($_GET['p_id']);
}
    $query = "SELECT * FROM posts WHERE post_id = {$the_post_id}";
    $select_all_posts = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_all_posts)) {
        $post_id = escape($row['post_id']);
        $post_category_id = escape($row['post_category_id']);
        $post_author = escape($row['post_author']);
        $post_title = escape($row['post_title']);
        $post_status = escape($row['post_status']);
        $post_image = escape($row['post_image']);
        $post_tags = escape($row['post_tags']);
        $post_comments = escape($row['post_comments']);
        $post_date = escape($row['post_date']);
        $post_content = escape($row['post_content']);
    }



if (isset($_POST['update_post'])) {

    $post_author = escape($_POST['author']);
    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['post_category']);
    $post_status = escape($_POST['post_status']);
    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']);
    $post_tags = escape($_POST['tags']);
//    $post_date = trim($_POST['content'];
    $post_content= escape($_POST['content']);

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if (empty($post_image)) {
        $query = "SELECT post_image FROM posts where post_id = $the_post_id ";
        $select_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = escape($row['post_image']);
        }
    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_author = '{$post_author}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} ";

    $update_post = mysqli_query($connection, $query);

    confirmQuery($update_post);

    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id=$post_id'>View Post</a> or <a href='posts.php?source=view_all_posts'>Edit More Posts</a></p>";

    }
?>

<form action="" method="post" enctype="multipart/form-data" class="col-lg-8">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title ?>">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" class="form-control" id="post_category">
            <?php
            $query = "SELECT * FROM categories WHERE category_id = {$post_category_id}";
            $select_category = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_category)){
                $default_category_title = escape($row['category_title']);
            }
            ?>
            <?php echo "<option value='$post_category_id'>{$default_category_title}</option>"; ?>
            <?php
            $query = "SELECT * FROM categories WHERE category_title != '{$default_category_title}'";
            $select_categories = mysqli_query($connection, $query);
            confirmQuery($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories)) {
                $category_id = escape($row['category_id']);
                $category_title = escape($row['category_title']);

                echo "<option value='$category_id'>{$category_title}</option>";
            }

            ?>
        </select>

    </div>
    <div class="form-group">
        <label for="author">Post Author</label>
        <select name="author" class="form-control" id="author">

           <?php echo "<option value='$post_author'>{$post_author}</option>"; ?>
            <?php
            $query = "SELECT * FROM users where username != '{$post_author}'";
            $select_users = mysqli_query($connection, $query);
            confirmQuery($select_users);

            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = escape($row['user_id']);
                $username = escape($row['username']);

                echo "<option value='$username'>{$username}</option>";
            }

            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="post_status">Post Category</label>
        <select name="post_status" class="form-control" id="post_status">
            <option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
            <?php if ($post_status === "Published") : ?>
                <option value="Draft">Draft</option>
            <?php else : ?>
                <option value="Published">Publish</option>
            <?php endif; ?>
        </select>

    </div>
    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img src="../images/<?php echo $post_image ?>">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags" value="<?php echo $post_tags ?>">
    </div>
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea type="text" class="form-control" name="content" cols="30" rows="10" id="editor"><?php echo $post_content ?></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Publish Post"
    </div>
</form>

<script>
    ClassicEditor.create(document.getElementById('editor'));
</script>