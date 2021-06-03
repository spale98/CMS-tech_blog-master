<div class="col-md-4">

    <?php
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    ?>
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                <button class="btn btn-default" name="submit" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
            </div>
        </form>

        <!-- /.input-group -->
    </div>

    <div class="well">

        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="login" type="submit">Login</button>
            </div>
        </form>
    </div>

    <?php require_once 'db.php'; ?>
    <?php
    $select = "SELECT * FROM categories";
    $select_categories_sidebar = mysqli_query($connection, $select);
    ?>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php while ($row = mysqli_fetch_assoc($select_categories_sidebar)) : ?>
                    <?php $category_id = $row['category_id']; ?>
                    <?php $category_title = $row['category_title']; ?>
                        <li><a href="category.php?category=<?php echo $category_id?>"><?php echo $category_title ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include ('widget.php') ?>

</div>