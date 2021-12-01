<?php include "include/header.php";
?>
<?php
$msg = '';
$user_id = $_SESSION['user_details_id'];
$userDatils = new UserDetails();
$row = $userDatils->getDetailsFromId($user_id);

$firstName = $row['first_name'];
$lastName = $row['last_name'];
$email = $row['email'];
$username = $_SESSION['username'];
$user_image = $row['user_image'];

if (isset($_POST['update'])) {

    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!empty($firstname)  && !empty($email)) {
        $usersDetails = new UserDetails();
        $user = new Users();
        //if image change goto if otherwise else
        if (!empty($_FILES['image']['name'])) {
            $user_image = $_FILES['image']['name'];
            $user_image_path = $_FILES['image']['tmp_name'];
            move_uploaded_file($user_image_path, "image/$user_image");
        } else {
            //if dont want to update image search existing image name
            $query = "Select user_image from user_details where user_id = $user_id ";
            $res = mysqli_query($connection, $query);
            if (!$res) {
                die(mysqli_error($connection));
            }
            $row = mysqli_fetch_assoc($res);
            $user_image = $row['user_image'];
        }
        //update user_details table
        $usersDetails->updateDetail($user_id, $firstname, $lastname, $email,$user_image);
        //insert into users table

        header("Location:userDetails.php?updated=true&user_id=");
    } else {
        $msg = "Enter all field with * symbol";
    }
}
?>

<div class="container p-5 mt-2" style="height: 80%;">
    <h2 class="text-light TextShadow">Update Your Details</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class=" row d-flex ">
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-text required">First Name</div>
                    <input type="text" class="form-control" name="firstname" value="<?= $firstName ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-text">Last Name</div>
                    <input type="text" class="form-control" name="lastname" value="<?= $lastName ?>">
                </div>
            </div>
        </div>

        <div class=" row d-flex mt-3 ">
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-text required">Email</div>
                    <input type="email" class="form-control" name="email" value="<?= $email ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class=" input-group mb-3">
                    <div class="input-group-text required">Username</div>
                    <input type="text" class="form-control" name="username" readonly value="<?= $username ?>">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" class="form-control mb-3" name="image" accept="image/*">
                </div>

            </div>
            <div class="col-lg-6">
                <div class="text-center mb-3">

                    <img class="img-fluid rounded" src="image/<?= $user_image ?>" alt="<?= $user_image ?>" width="150">
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-center btn-grop ">
            <input class="btn btn-warning mb-3" type="submit" name="update" id="create" value="update">
        </div>
        <div class="d-flex justify-content-center text-red my-0" id="error">
            <?= $msg ?>
        </div>
    </form>
</div>
<?php include "include/footer.php"; ?>