<table class="table table-hover table-bordered">
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
            $thumb = $row['post_thumbnail'];
            $id = $row['post_id'];
            echo "<td>" . $row['post_id'] . "</td>";
            echo "<td>" . $row['post_author'] . "</td>";
            echo "<td>" . $row['post_title'] . "</td>";
            echo "<td>" . $row['post_category_id'] . "</td>";
            echo "<td>" . $row['post_status'] . "</td>";
            echo "<td><img width='100px' src='../images/$thumb' alt='image'></td>";
            echo "<td>" . $row['post_tag'] . "</td>";
            echo "<td>" . $row['post_comment_count'] . "</td>";
            echo "<td>" . $row['post_date'] . "</td>";
            echo "<td>" . "<a href='posts.php?source=edit_post&p_id={$id}'>Edit </a>" . "</td>";
            echo "<td>" . "<a href='posts.php?delete={$id}'>Delete </a>" . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

<?php
if (isset($_GET['delete']) && $_GET['delete'] != '') {
    $post_id = $_GET['delete'];
    $sql = "DELETE FROM posts WHERE post_id = $post_id";
    $pdo->query($sql);
    $_GET['delete'] = '';
    header("Location: ../admin/posts.php?source=");
    return;
}
?>