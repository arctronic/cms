<?php include "include/header.php" ?>

<div id="wrapper">
    <?php include "include/nav.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Welcome
                        <small>Author</small>
                    </h1>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Author</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Images</th>
                                <th>Tag</th>
                                <th>Comments</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "../include/db.php";
                            $sql = "SELECT * from posts";
                            $data = $pdo->query($sql);
                            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                                echo "<td>" . $row['post_id'] . "</td>";
                                echo "<td>" . $row['post_author'] . "</td>";
                                echo "<td>" . $row['post_title'] . "</td>";
                                echo "<td>" . $row['post_category_id'] . "</td>";
                                echo "<td>" . $row['post_status'] . "</td>";
                                echo "<td>" . $row['post_thumbnail'] . "</td>";
                                echo "<td>" . $row['post_tag'] . "</td>";
                                echo "<td>" . $row['post_comment_count'] . "</td>";
                                echo "<td>" . $row['post_date'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                            echo "</tr>";
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>

    <!-- /#page-wrapper -->
    <?php include "include/footer.php" ?>