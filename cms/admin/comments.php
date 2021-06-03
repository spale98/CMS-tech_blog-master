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
                        Comments
                        <small>Comment Management</small>
                    </h1>

                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }

                    switch($source) {
                        case 'add_post';
                            include "includes/add_post.php";
                            break;
                        case 'edit_post';
                        include "includes/edit_post.php";
                        break;
                        case '200';
                            echo "Nice 200";
                            break;
                        case '300';
                            echo "Nice 300";
                            break;
                        default:

                            include "includes/view_all_comments.php";

                    }
                    ?>



                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

    <?php include ('includes/footer.php'); ?>
