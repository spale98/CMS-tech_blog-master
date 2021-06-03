<?php
    session_start();
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">TECH Blog</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <?php require_once 'db.php'; ?>
                <?php
                $query = "SELECT * FROM categories";
                $select_all_categories = mysqli_query($connection, $query);
                ?>
                <?php while ($row = mysqli_fetch_assoc($select_all_categories)) {
                    $category_id = $row['category_id'];
                    $category_title = $row['category_title'];

                    echo "<li><a href='category.php?category=$category_id'> $category_title </a></li>";
                } ?>

                <li>
                    <a href="admin">Admin</a>
                </li>
                <?php if (isset($_SESSION['user_role'])) : ?>
                    <?php if (isset($_GET['p_id'])) : ?>
                        <?php $the_post_id = $_GET['p_id']; ?>

                        <li>
                            <a href="admin/posts.php?source=edit_post&p_id=<?php echo $the_post_id ?>">Edit Post</a>
                        </li>

                    <?php endif; ?>
                <?php endif; ?>
                <li>
                    <a href="registration.php">Registration</a>
                </li>
                <li>
                    <a href="contact.php">Contact Us</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
