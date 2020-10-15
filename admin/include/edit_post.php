<?php
include_once "db.php";
if (isset($_GET['p_id']) && $_GET['p_id'] != '') {
    $id = $_GET['p_id'];
    $sql = "SELECT * FROM posts WHERE post_id=$id";
    $data = $pdo->query($sql);
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        $category = $row['post_category_id'];
        $title = $row['post_title'];
        $author = $row['post_author'];
        $status = $row['post_status'];
        $content = $row['post_content'];
        $thumb = $row['post_thumbnail'];
        $tag = $row['post_tag'];
    }
}
?>

<?php
include_once "db.php";
if (isset($_POST['update_post'])) {
    $id = $_GET['p_id'];
    $sql = "SELECT * FROM posts WHERE post_id=$id";
    $data = $pdo->query($sql);
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        $category = $row['post_category_id'];
        $post_title = $row['post_title'];
        $author = $row['post_author'];
        $status = $row['post_status'];
        $content = $row['post_content'];
        $thumb = $row['post_thumbnail'];
        $tag = $row['post_tag'];
    }


    //$post_title = $_POST["post_title"];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tag = $_POST['post_tag'];
    $post_content = $_POST['post_content'];
    move_uploaded_file($post_image_temp, "../images/$post_image");
    $sql = "UPDATE posts SET post_title = $post_title, post_category_id = $post_category_id, post_author = $post_author, post_status = $post_status,
    post_thumbnail =$post_image, post_content = $post_content where post_id =$id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    unset($_POST['update_post']);
}
?>
<form method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control" value=<?php echo $title ?> required>
    </div>

    <div class="form-group">
        <label for="post_category">Post Category</label>
        <select name="post_category" id="post_category">
            <?php
            $query = "SELECT * FROM category";
            $data = $pdo->query($query);
            while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                $cat_id = $row['category_id'];
                $cat_title = $row['category_title'];

                echo "<option value='$cat_id'>$cat_title</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control" value=<?php echo $author ?> required>
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" name="post_status" class="form-control" value=<?php echo $status ?>>
    </div>


    <div class="form-group">
        <label for="post_tag">Post Tag</label>
        <input type="text" name="post_tag" class="form-control" value=<?php echo $tag ?>>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <img src="../images/<?php echo $thumb ?>" alt="">
        <input type="file" name="image" value=<?php echo $thumb ?>>
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" class="from-control" rows="10" style="width: 100%;"><?php echo $content ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="update_post" value="Update" class="btn btn-primary">
    </div>
</form>