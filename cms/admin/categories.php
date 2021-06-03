<?php include ('includes/header.php'); ?>
<?php include ('functions.php'); ?>

<div id="wrapper">
    <!-- Navigation -->
    <?php include ('includes/navigation.php'); ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="page-header">
                        Categories
                        <small>Category Management</small>
                    </h1>

                    <div class="col-xs-12 col-lg-6">

                        <?php insertCategories(); ?>

                        <form action="" method="post" >
                            <div class="form-group">
                                <label for="category_title">Add Category: </label>
                                <input class="form-control" type="text" name="category_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                            </div>
                        </form>

                        <?php include('includes/update_categories.php'); ?>


                    </div>
                    <div class="col-xs-12 col-lg-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="col-lg-2">Category Id</th>
                                <th>Category Title</th>
                                <th colspan="2">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php findAllCategories(); ?>

                            <?php deleteCategory(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include ('includes/footer.php'); ?>
