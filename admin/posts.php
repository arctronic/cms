<?php include "include/header.php" ?>

<div id="wrapper">
    <?php include "include/nav.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome <br> <small>Author</small></h1>
                    <!-- <?php include "include/view_all_post.php"; ?> -->
                    <!-- <br>
                    <small>
                        <?php
                        if (isset($_POST['create_post'])) {
                            echo "Post successfully added!";
                            unset($_POST['create_post']);
                        }
                        ?>
                    </small> -->

                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                        switch ($source) {
                            case 'add_post':
                                include "include/add_post.php";
                                break;
                            default:
                                include "include/view_all_post.php";
                                break;
                        }
                    }
                    ?>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>

    <!-- /#page-wrapper -->
    <?php include "include/footer.php" ?>