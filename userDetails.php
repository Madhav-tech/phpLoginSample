<?php include "include/header.php"; ?>
<?php
$msg = "";
if ($_SESSION['valid']) {
    if (isset($_GET['updated']) && $_GET['updated'] == true) {
        $msg =  "User Updated Sucessfully";
    }
    $user_id = $_SESSION['user_details_id'];

    $userDatils = new UserDetails();
    $row = $userDatils->getDetailsFromId($user_id);

    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $email = $row['email'];
    $userImage = $row['user_image'];
    $username = $_SESSION['username'];
    if (isset($_POST['update_post'])) {
        $post_id = $_POST['update_post_id'];
        $post_content = $_POST['story'];
        $post_date =  date("Y-m-d");

        //if image change goto if otherwise else
        if (!empty($_FILES['image']['name'])) {
            $post_image = $_FILES['image']['name'];
            $post_image_path = $_FILES['image']['tmp_name'];
            move_uploaded_file($post_image_path, "image/$post_image");
        } else {

            //if dont want to update image search existing image name
            $query = "Select post_image from posts where post_id = $post_id ";
            $res = mysqli_query($connection, $query);
            if (!$res) {
                die(mysqli_error($connection));
            }
            $row = mysqli_fetch_assoc($res);
            $post_image = $row['post_image'];
        }
        $post = new Post();
        $result = $post->updatePost($post_id, $post_date, $post_content, $post_image);
        if ($result) {
            $msg = "post updated";
        } else {
            die(mysqli_error($connection));
        }
    }
} else {
    header("Location:index.php?source=false");
}
?>
<div class="container">
    <div class="row mx-3">
        <div class="col-lg-4">
            <div class="d-flex justify-content-center ">
                <H1>User Details</H1>
            </div>
            <div class=" text-center p-2 rounded">
                <a href="userDetails.php?user_id=">
                    <img class="img-fluid circled" src="image/<?= $userImage ?>" alt="Profile Picture" height="auto" width="80%" id="profilePicture">
                </a>
                <p id="posttext" class="mb-0"> <?= strtoupper($firstName . " " . $lastName) ?></p>
                <p><span><?= $email ?></span></p>
            </div>
            <!-- <div class="d-flex justify-content-center text-red my-0" id="error">
                <?= $msg ?>
            </div> -->
            <table class=" table table-bordered bg-light text-center border-primary ">
                <tr>
                    <th>First Name</th>
                    <td><?= $firstName; ?></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><?= $lastName ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $email ?></td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td><?= $username ?></td>
                </tr>
            </table>
            <div class=" d-flex container justify-content-center mt-3">
                <a class="btn btn-outline-danger " href="update.php">Update</a>
            </div>
        </div>

        <div class="col-md-6  p-3">
            <div class="d-flex justify-content-center text-red my-0" id="error">
                <?= $msg ?>
            </div>
            <?php

            if (isset($_GET['delete_id'])) {
                include "post/postEdit.php";
            } elseif (isset($_GET['edit_id'])) {
                include "post/postEdit.php";
            } else {
                include "post/ShowAllpost.php";
            }

            ?>
        </div>
    </div>
</div>
<?php include "include/footer.php"; ?>