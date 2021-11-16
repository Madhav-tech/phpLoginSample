<?php

$msg = '';
if (isset($_POST['create'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];

    if (!empty($firstname) && !empty(trim($username)) && !empty(trim($password)) && !empty($email)) {
        $usersDetails = new UserDetails();
        $user = new Users();
        //avoid auto increment to user_id by getting number of rows in table;
        $id = $usersDetails->getCountofUsers() + 1;
        //insert into user_details table
        $usersDetails->insertIntoDetail($id, $firstname, $lastname, $email, $user_image);
        //insert into users table

        $password = password_hash($password, PASSWORD_DEFAULT);

        $user->insertIntoUsers($username, $password, $id);
        move_uploaded_file($user_image_temp, "image/$user_image");

        $msg =  "User Registered Sucessfully";
    } else {
        $msg = "Enter all field with * symbol";
    }
}
?>

<div class="container p-5 mt-2" style="height: 80%;">
    <h2 class="text-light TextShadow">Enter Your Details</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <div class=" row d-flex ">
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-text required">First Name</div>
                    <input type="text" class="form-control" name="firstname">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <div class="input-group-text">Last Name</div>
                    <input type="text" class="form-control" name="lastname">
                </div>
            </div>
        </div>
        <div class="row d-flex ">
            <div class="col-lg-6">
                <div class=" input-group mb-3">
                    <div class="input-group-text required">Email</div>
                    <input type="email" class="form-control" name="email">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="col-lg-6 input-group mb-3">
                    <input type="file" class="form-control" name="image">
                </div>
            </div>
        </div>
        <div class=" row d-flex mt-3 ">
            <div class="col-lg-6">
                <div class=" input-group mb-3">
                    <div class="input-group-text required">Username</div>
                    <input type="text" class="form-control" name="username">
                </div>
            </div>
            <div class="col-lg-6">
                <div class=" input-group mb-3">
                    <div class="input-group-text required">Password</div>
                    <input type="text" class="form-control" name="password">
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center btn-grop ">
            <input class="btn btn-secondary mb-3" type="submit" name="create" id="create">
        </div>
        <div class="d-flex justify-content-center text-red my-0" id="error">
            <?= $msg ?>
        </div>
    </form>
</div>