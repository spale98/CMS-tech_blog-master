<?php include "../functions.php"; ?>
<?php
if (isset($_POST['create_post'])) {

    $post_title = escape($_POST['title']);
    $post_category_id = escape($_POST['post_category']);
    $post_author = escape($_POST['post_author']);
    $post_status = escape($_POST['post_status']);

    $post_image = escape($_FILES['image']['name']);
    $post_image_temp = escape($_FILES['image']['tmp_name']);

    $post_tags = escape($_POST['tags']);
    $post_content = escape($_POST['content']);
    $post_date = date('d-m-y');
//    $post_comment_count = 4;




    move_uploaded_file($post_image_temp, "../images/$post_image");


    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status, post_view_count) " ;
    $query .= "VALUES( {$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}', 0 ) ";

    $create_post = mysqli_query($connection, $query);

    confirmQuery($create_post);

    $the_post_id = mysqli_insert_id($connection);
    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
}
?>
<form action="" method="post" enctype="multipart/form-data" class="col-lg-8">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" class="form-control" id="post_category">
            <?php
            $query = "SELECT * FROM categories";
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
        <label for="post_author">Post Category</label>
        <select name="post_author" class="form-control" id="post_author">
            <?php
            $query = "SELECT * FROM users";
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
        <label for="post_status">Post Status</label>
        <select name="post_status" class="form-control" id="post_status">
            <option value="Draft">Select Options</option>
            <option value="Published">Publish</option>
            <option value="Draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image"">
    </div>
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="tags">
    </div>
    <div class="form-group">
        <label for="body">Post Content</label>
        <textarea type="text" class="form-control" id="editor" name="content" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post"
    </div>
 </form>

<script>
    ClassicEditor.create(document.getElementById('editor'));
</script>