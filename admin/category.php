<?php include "include/header.php" ?>
<?php
    if(isset($_GET["category_title"]) && isset($_GET["submit"]) && $_GET["category_title"]!=""){
        require_once "../include/db.php";
        $_SESSION['category_title'] = $_GET["category_title"];

        $sql = "INSERT INTO category(category_title) VALUES(:category_title)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ':category_title' =>$_SESSION['category_title']
        ));
        unset($_SESSION['category_title']);
        header('location: category.php');
    }else{
        $ping_back = "Blank Category couldn't be added!";
    }
?>
<div id="wrapper">
    <!-- <?php if ($pdo) echo "Working"; ?> -->
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
                    <div class="col-xs-6">
                        <form method="GET">
                            <div class="form-group">
                                <label for="category_title">Category</label>
                                <input class="form-control" type="text" name="category_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                            </div>
                        </form>
                    </div>
                    <div class="col-xs-6">
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <?php
                                    require_once "../include/db.php";
                                    $query = "SELECT * from category";
                                    $cat_data = $pdo->query($query);
                                    while ($row = $cat_data->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<td>" . $row['category_id'] . "</td><td>" . $row['category_title'] . "</td></tr>";
                                    }
                                    ?>

                                </tr>
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
    <?php include "include/footer.php" ?>