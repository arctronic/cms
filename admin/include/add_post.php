<?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=cms', 'shihab', 'shihab');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<?php

if (isset($_POST['create_post']) && $_POST['post_title'] != '') {
    $post_title = $_POST['post_title'];
    $_POST['post_title'] = '';
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_POST['post_author'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tag = $_POST['post_tag'];
    $post_content = $_POST['post_content'];
    $post_date = date("Y/m/d");
    $post_comment_count = rand(1, 10);

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $sql = "INSERT into posts(post_category_id,post_title,post_author,post_date,post_thumbnail,post_content,post_tag,post_comment_count,post_status)
                VALUES(:post_category_id,:post_title,:post_author,:post_date,:post_image, :post_content,:post_tag,:post_comment_count,:post_status)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':post_category_id' => $post_category_id,
        ':post_title' => $post_title,
        ':post_author' => $post_author,
        ':post_date' => $post_date,
        ':post_image' => $post_image,
        ':post_content' => $post_content,
        ':post_tag' => $post_tag,
        ':post_comment_count' => $post_comment_count,
        ':post_status' => $post_status
    ));
}
?>

<form  method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" name="post_title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category Id</label>
        <input type="text" name="post_category_id" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" name="post_author" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" name="post_status" class="form-control">
    </div>


    <div class="form-group">
        <label for="post_tag">Post Tag</label>
        <input type="text" name="post_tag" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea name="post_content" class="from-control" rows="10" style="width: 100%;" required></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="create_post" value="Publish" class="btn btn-primary">
    </div>
</form>