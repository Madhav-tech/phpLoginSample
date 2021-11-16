<?php include "include/header.php"; ?>
<?php
$msg = "";
if ($_SESSION['valid']) {
    $user_id = $_SESSION['user_details_id'];
    $userDatils = new UserDetails();
    $row = $userDatils->getDetailsFromId($user_id);
    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $email = $row['email'];
    $userImage = $row['user_image'];
    $username = $_SESSION['username'];
} else {
    header("Location:index.php?source=false");
}
if (isset($_POST['addpost'])) {

    $post_content = $_POST['story'];
    $post_date =  date("Y-m-d");
    $post_author = $_SESSION['username'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_user_id = $_SESSION['user_details_id'];
    $post = new Post();
    $result = $post->insertIntoPost($post_author, $post_date, $post_content, $post_image,$post_user_id);
    if ($result) {
        move_uploaded_file($post_image_temp, "image/$post_image");
        $msg = "post uploaded";
    } else {
        die(mysqli_error($connection));
    }
}
?>
<div class="container">
    <div class="row" id="postdiv">
        <div class="col-md-3 p-3">
            <div class=" text-center mt-3 p-2 rounded" id="userDetails">
                <a href=" userDetails.php?user_id=">
                    <img class="img-fluid circled" src="image/<?= $userImage ?>" alt="Profile Picture" height="auto" width="80%" id="profilePicture">
                </a>
                <p id="posttext" class="mb-0"> <?= strtoupper($firstName . " " . $lastName) ?></p>
                <p><span><?= $email ?></span></p>
            </div>
        </div>

        <div class="col-md-6  p-3">
            <div class="p-3">
                <div class="p-3" id="addpost">
                    <span><?= $msg ?> </span>

                    <div class="mb-3">
                        <h3>Submit Your Post</h3>
                    </div>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <textarea class="form-control" placeholder="Enter story" name="story"></textarea>
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="image">
                        </div>
                        
                        <div class="d-flex justify-content-end me-3">
                            <input class="btn btn-sm btn-primary" type="submit" value="Post" name="addpost">
                        </div>

                    </form>
                </div>
            </div>
            <?php include "post/ShowAllpost.php" ?>
        </div>

        <div class="col-md-3">

        </div>


    </div>
</div>

<?php include "include/footer.php";
//Rabbit MQ, Kafaka, Jenkins, gitlab overviews 
?>