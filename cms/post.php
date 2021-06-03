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


            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <?php require_once 'includes/db.php'; ?>

            <?php if(isset($_GET['p_id'])) : ?>

            <?php

            $the_post_id = $_GET['p_id'];

            $view_query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = $the_post_id";
            $update_view_count = mysqli_query($connection, $view_query);


            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_all_posts = mysqli_query($connection, $query);

            ?>

            <?php while ($row = mysqli_fetch_assoc($select_all_posts)) :?>
                <?php $post_title = $row['post_title']; ?>
                <?php $post_author = $row['post_author']; ?>
                <?php $post_date = $row['post_date']; ?>
                <?php $post_content = $row['post_content']; ?>
                <?php $post_image = $row['post_image']; ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $the_post_id ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>
            <?php endwhile;  ?>


            <?php else: ?>


            <?php header("Location: index.php"); ?>

            <?php endif; ?>
            <!-- Pager -->
<!--            <ul class="pager">-->
<!--                <li class="previous">-->
<!--                    <a href="#">&larr; Older</a>-->
<!--                </li>-->
<!--                <li class="next">-->
<!--                    <a href="#">Newer &rarr;</a>-->
<!--                </li>-->
<!--            </ul>-->
            <!-- Blog Comments -->

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


                $query = "UPDATE posts SET post_comment_count =  post_comment_count + 1 ";
                $query .= "WHERE post_id = $the_post_id";

                $update_comment_count = mysqli_query($connection, $query);

            }

            ?>
            <!-- Comments Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form role="form" method="post">
                    <label for="comment_author">Author Name:</label>
                    <input type="text" id="comment_author" class="form-control" name="comment_author" required>
                    <label for="comment_email">Author Email:</label>
                    <input type="email" id="comment_email" class="form-control" name="comment_email" required>
                    <div class="form-group">
                        <label for="comment_content">Your Comment:</label>
                        <textarea id="comment_content" name="comment_content" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- Posted Comments -->

            <?php

            $query = "SELECT * FROM comments WHERE comment_post_id = {$the_post_id} ";
            $query .= "AND comment_status = 'approved' ";
            $query .= "ORDER BY comment_id DESC ";

            $select_comment = mysqli_query($connection, $query);

            if (!$select_comment) {
                die ("query failed " . mysqli_error($connection));
            }

            while ($row = mysqli_fetch_assoc($select_comment)) {
                $comment_date = $row['comment_date'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];

                ?>
                <hr>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                <?php
            }

            ?>

            
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include ('includes/sidebar.php') ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include ('includes/footer.php'); ?>