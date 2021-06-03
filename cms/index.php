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
                $show_per_page = 5;

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];

                } else {
                    $page = "";
                }

                if ($page == "" || $page == 1) {
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $show_per_page) - $show_per_page;
                }

                $post_query_count = "SELECT * FROM posts WHERE post_status = 'Published'";
                $find_count = mysqli_query($connection, $post_query_count);

                $count = mysqli_num_rows($find_count);
                $count = ceil($count / $show_per_page);

                $query = "SELECT * FROM posts WHERE post_status = 'Published' LIMIT $page_1, $show_per_page";
                $select_all_posts = mysqli_query($connection, $query);
                ?>

                <?php while ($row = mysqli_fetch_assoc($select_all_posts)) :?>
                    <?php $post_id = $row['post_id']; ?>
                    <?php $post_title = $row['post_title']; ?>
                    <?php $post_author = $row['post_author']; ?>
                    <?php $post_date = $row['post_date']; ?>
                    <?php $post_content = substr($row['post_content'], 0, 120); ?>
                    <?php $post_image = $row['post_image']; ?>
                    <?php $post_status = $row['post_status']; ?>


                    <?php if ($post_status != 'Published') : ?>
                        <?php echo "<h1 class='text-center'>No post here.</h1>"; ?>
                    <?php else : ?>
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
                <?php endif; ?>
                <?php endwhile; ?>
                <!-- Pager -->
<!--                <ul class="pager">-->
<!--                    <li class="previous">-->
<!--                        <a href="#">&larr; Older</a>-->
<!--                    </li>-->
<!--                    <li class="next">-->
<!--                        <a href="#">Newer &rarr;</a>-->
<!--                    </li>-->
<!--                </ul>-->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include ('includes/sidebar.php') ?>

        </div>
        <!-- /.row -->

        <hr>

    <ul class="pager">
        <?php for ($i = 1; $i <= $count; $i++) : ?>
            <?php if ($i == $page ) : ?>
                <li><a  class="active_link" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php else : ?>
                <li><a href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>
    </ul>

<?php include ('includes/footer.php'); ?>