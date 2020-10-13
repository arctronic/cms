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

                                echo "<td>" . $row['post_id'] ."</td>";
                                echo "<td>" . $row['post_author'] . "</td>";
                                echo "<td>" . $row['post_title'] . "</td>";
                                echo "<td>" . $row['post_category_id'] . "</td>";
                                echo "<td>" . $row['post_status'] . "</td>";
                                echo "<td><img width='100px' src='../images/$thumb' alt='image'></td>";
                                echo "<td>" . $row['post_tag'] . "</td>";
                                echo "<td>" . $row['post_comment_count'] . "</td>";
                                echo "<td>" . $row['post_date'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>