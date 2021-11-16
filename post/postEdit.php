<?php
$db = new DbConfig();
$connection = $db->getConnection();
if (isset($_GET['delete_id'])) {

    $delete_post_id = $_GET['delete_id'];
    $post = new Post();
    $post->deletePost($delete_post_id);
    header("Location:userDetails.php?user_id=");
}
if (isset($_GET['edit_id'])) {

    $update_post_id = $_GET['edit_id'];
    $post = new Post();
    $posts_data = $post->getPostsFromId($update_post_id);
    $row = mysqli_fetch_assoc($posts_data);
    $post_image = $row["post_image"];
    $post_content = $row['post_content'];
}
?>

<div class=" mt-5" style="width: 100%;height: auto;">
    <div id="card-content" class="p-3 me-auto">
        <form action="userDetails.php?user_id=" method="POST" enctype="multipart/form-data">
            <input type="hidden" class="form-control" name="update_post_id" value="<?= $update_post_id ?>">
            <div class="row">
                <div class="input-group mb-3">
                    <textarea class="form-control" name="story" required id="example"><?= $post_content ?></textarea>
                </div>
                
                <div class="input-group mb-3">
                    <input type="file" class="form-control mb-3" name="image">
                </div>
                <div class="mb-3">
                    <img class="img-fluid rounded" src="image/<?= $post_image ?>" alt="<?= $post_image ?>" width="300">
                </div>
            </div>
            <input class="btn btn-primary mb-3" type="submit" value="update" name="update_post" id="submit-btn">
        </form>
        <div class="text-danger mb-3"> <?= $msg ?></div>
    </div>
</div>