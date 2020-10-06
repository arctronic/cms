<?php
    include "include/db.php";
    include "include/header.php";
?>
<!-- Navigation -->
<?php include "include/nav.php" ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <?php
                if(isset($_POST['submit'])){
                    $search = htmlentities( $_POST["search"]);
                    $query = "SELECT * FROM posts WHERE (post_tag LIKE '%$search%') OR (post_content LIKE '%$search%')";
                    $search_query = $pdo->query($query);
                    if(!$search_query){
                        die("Query Failed ". mysqli_error($connection));
                    }
                    $count = $search_query->rowCount();
                    if($count == 0){
                        echo "<h1>No result</h1>";
                    }else{

                        while($row = $search_query->fetch(PDO::FETCH_ASSOC)){
                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_thumbnail = $row['post_thumbnail'];
                            $post_content = $row['post_content'];
                            ?>

            <h1 class="page-header">
                Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_thumbnail; ?>" alt="">
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

            <?php } 
            }
            }
            ?>




        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "include/sidebar.php" ?>

    </div>
    <!-- /.row -->

    <hr>
    <?php
    include "include/footer.php";
?>