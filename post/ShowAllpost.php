<div class="p-3">
    <?php

    $query = "";
    if (isset($_GET['user_id'])) {
        $user_id = $_SESSION['user_details_id'];
        $query = "select * from posts WHERE post_user_id = {$user_id}  ORDER BY post_date DESC";
        $display="block";
    } else {
        $query = "select * from posts ORDER BY post_date DESC";
        $display="none";
    }
    $posts_data = mysqli_query($connection, $query);
    $count = 0;
    //loop to print the post details
    while ($row = mysqli_fetch_assoc($posts_data)) {
        $post_id = $row["post_id"];
        $post_author = $row["post_author"];
        $post_date = $row["post_date"];
        $post_content = $row["post_content"];
        $post_image = $row["post_image"];
        $post_like_count = $row["post_like_count"];
        $post_comment_count = $row["post_comment_count"];
        $count++;

    ?>
        <div id="post2" class="p-3 mb-3">
            <div id="post2Content" class="p-2">
                <div class="ms-4 me-4" style="width: 90%;">
                    <div style="float: left;">
                        <a id="name" href="userDetails.php">
                            <strong><?= $post_author . " -" ?></strong>
                            <span id="date"><?php echo  $post_date ?></span>
                        </a>
                    </div>
                    <div style="float: right;display:<?=$display?>;">
                        <a class="me-2" id="name" href="userDetails.php?delete_id=<?= $post_id ?>">delete</a> 
                        <a id="name" href="userDetails.php?edit_id=<?= $post_id ?>">edit</a>
                    </div>
                </div>

                <div class="ps-3 pe-3 ms-3 me-3 mb-1">
                    <img id="postImg" class="img-fluid p-3" src="image/<?php echo $post_image;  ?>" alt="">
                </div>
                <div class="ms-4">
                    <button id="likebtn" class="btn btn-outline-primary button" onclick="postLike(this.value);" value="<?= $post_id ?>"><i class="bi bi-hand-thumbs-up" id="<?= 'like' . $post_id ?>"><?= $post_like_count ?></i></button>
                </div>
                <div class="ms-4">
                    <p><?php echo (strlen($post_content) > 50) ? (substr($post_content, 0, 50) . "<strong> . . . .</strong>") : $post_content ?></p>
                </div>

            </div>
        </div>
    <?php
    } //while loop ended
    if ($count === 0) {
        echo "<h3>No Post Found</h3>";
    }
    ?>
</div>
<script>
    function postLike(post_id) {

        const httpRequest = new XMLHttpRequest();
        httpRequest.onload = function() {
            document.getElementById("like" + post_id).innerHTML = this.responseText;
        }
        httpRequest.open("GET", "post/Likes.php?post_id=" + post_id);
        httpRequest.send();

    }
</script>