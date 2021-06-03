<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
if (isset($_POST['submit'])) {

    $message = '';

}
?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <div class="message">
                            <p class="bg-info text-center"><?php echo $message ?></p>
                        </div>
                        <h1>Contact Us</h1>
                        <form role="form" action="contact.php" method="post" id="email-form" autocomplete="off">
                            <div class="form-group">
                                <label for="email" class="sr-only">Email:</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com" required>
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject:</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Your Subject" required>
                            </div>
                            <div class="form-group">
                                <label for="message" class="sr-only">Message:</label>
                                <textarea name="body" id="message" class="form-control" placeholder="Enter Your Message" rows="10" required></textarea>
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                        </form>


                    </div>

                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php";?>
