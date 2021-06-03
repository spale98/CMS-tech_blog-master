<?php include ('includes/header.php'); ?>
<?php include ('includes/navigation.php'); ?>
<?php include ('admin/functions.php'); ?>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if (isset($_GET['p_id'])) {
                 $the_post_id = $_GET['p_id'];
                 $the_post_author = $_GET['author'];
                }
            ?>

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php

            if(isset($_GET['p_id'])) {
                $the_post_id = $_GET['p_id'];
            }

            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}' AND post_status = 'Published'";
            $select_all_posts = mysqli_query($connection, $query);
            ?>

            <?php while ($row = mysqli_fetch_assoc($select_all_posts)) :?>
                <?php $post_id = $row['post_id']; ?>
                <?php $post_title = $row['post_title']; ?>
                <?php $post_author = $row['post_author']; ?>
                <?php $post_date = $row['post_date']; ?>
                <?php $post_content = $row['post_content']; ?>
                <?php $post_image = $row['post_image']; ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>


                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
            <?php endwhile; ?>

            <?php

            if (isset($_POST['create_comment'])) {

                $the_post_id = $_GET['p_id'];

                $comment_author = $_POST['comment_author'];
                $comment_email = $_POST['comment_email'];
                $comment_content = $_POST['comment_content'];

                $query = "INSERT INTO comments (comment_author, comment_email, comment_post_id, comment_content, comment_date, comment_status) ";
                $query .= "VALUES ('{$comment_author}', '{$comment_email}', '{$the_post_id}', '{$comment_content}', now(), 'unapproved')";

                $create_comment = mysqli_query($connection, $query);

                confirmQuery($create_comment);
            }
            
            ?>

        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include ('includes/sidebar.php') ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include ('includes/footer.php'); ?>