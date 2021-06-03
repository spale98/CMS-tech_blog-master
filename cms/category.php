<?php include ('includes/header.php'); ?>
<?php include ('includes/navigation.php'); ?>
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
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
                <?php
                require_once 'includes/db.php';

                if (isset($_GET['category'])) {
                    $the_post_category_id = $_GET['category'];
                }

                $query = "SELECT * FROM posts WHERE post_category_id = $the_post_category_id";
                $select_all_posts = mysqli_query($connection, $query);
                ?>

                <?php while ($row = mysqli_fetch_assoc($select_all_posts)) :?>
                    <?php $post_id = $row['post_id']; ?>
                    <?php $post_title = $row['post_title']; ?>
                    <?php $post_author = $row['post_author']; ?>
                    <?php $post_date = $row['post_date']; ?>
                    <?php $post_content = substr($row['post_content'], 0, 120); ?>
                    <?php $post_image = $row['post_image']; ?>





                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>


                <p class="lead">
                    by <a href="index.php"><?php echo $post_author ?></a>
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
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include ('includes/sidebar.php') ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include ('includes/footer.php'); ?>