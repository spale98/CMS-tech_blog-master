
<?php if (isset($_GET['edit'])) : ?>

    <?php
    $category_id = escape($_GET['edit']);
    $query = "SELECT * FROM categories WHERE category_id = $category_id ";
    $select_category = mysqli_query($connection, $query);
    ?>

    <?php while ($row = mysqli_fetch_assoc($select_category)) : ?>
    <?php $category_id = escape($row['category_id']); ?>
    <?php $category_title = escape($row['category_title']); ?>
    <form action="" method="post" >
        <div class="form-group">

            <label for="category_title">Edit Category: </label>
            <input class="form-control" type="text" name="category_title" value="<?php if (isset($category_title)) { echo $category_title; } ?>">
        </div>
        <div class="form-group">
            <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
        </div>
    </form>
<?php endwhile; ?>
<?php endif; ?>
<?php if (isset($_POST['update_category'])) : ?>
    <?php
    // Update Category query
    $the_category_title = escape($_POST['category_title']);
    if (empty($the_category_title) || $the_category_title == "") :
        echo 'This field cannot be empty.';
     else :
    $query = "UPDATE categories SET category_title = trim('$the_category_title')  WHERE category_id = '$category_id'";

    $update_query = mysqli_query($connection, $query);

    header ("Location: categories.php");
    ?>

    <?php confirmQuery($update_query); ?>

    <?php endif; ?>
<?php endif; ?>

