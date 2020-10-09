<?php include "include/header.php" ?>
<?php
if (isset($_GET["category_title"]) && isset($_GET["submit"]) && $_GET["category_title"] != "") {
    require_once "../include/db.php";
    session_start();
    $_SESSION['category_title'] = $_GET["category_title"];

    $sql = "INSERT INTO category(category_title) VALUES(:category_title)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':category_title' => $_SESSION['category_title']
    ));
    unset($_SESSION['category_title']);
    header('location: category.php');
} else {
    $ping_back = "Blank Category couldn't be added!";
}

if (isset($_GET['del']) && $_GET['del'] != '') {
    $del_id = $_GET['del'];
    $sql = "DELETE FROM category WHERE category_id = :category_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':category_id' => $del_id
    ));
    $_GET['del'] = '';
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


                        <!-- editing category code -->
                        <?php
                        if (isset($_GET['edit']) && $_GET['edit'] != '') {
                            $cat_edit_id = $_GET['edit'];
                            $sql = "SELECT * FROM category where category_id = $cat_edit_id";
                            $data = $pdo->query($sql);
                            while($row = $data->fetch(PDO::FETCH_ASSOC)){
                                $cat_edit_title = $row['category_title'];
                            }
                            echo "<form method='GET'>";
                            echo "<div class='form-group'>";
                            echo "<label for='category_title'>Edit</label>";
                            echo "<input class='form-control' type='text' name='edit_title' value = '$cat_edit_title'>";
                            echo "<input type='hidden' name='_id' value = '$cat_edit_id'>";
                            echo "</div>";
                            echo "<div class='form-group'>";
                            echo "<input class='btn btn-primary' type='submit' name='edit_done' value='Done'>";
                            echo "</div></form>";
                        }
                        if(isset($_GET['edit_done']) && isset($_GET['edit_title']) && $_GET['edit_title']!=''){
                            $_title = $_GET['edit_title'];
                            $_id = $_GET['_id'];
                            $sql = "UPDATE category SET category_title = ? WHERE category_id =?";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([$_title,$_id]);
                        }
                        $_GET['edit'] = '';
                        ?>

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
                                        echo "<td>" . $row['category_id'] . "</td><td>" . $row['category_title'] . "</td>";
                                        $cat_id = $row['category_id'];
                                        echo "<td><a href='category.php?del={$cat_id}'>Delete</a></td>";
                                        echo "<td><a href='category.php?edit={$cat_id}'>Edit</a></td></tr>";
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