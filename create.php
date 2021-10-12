<?php

$msg = '';
if (isset($_POST['create'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (!empty($firstname) && !empty(trim($username)) && !empty(trim($password)) && !empty($email)) {
        
        //avoid auto increment to user_id by getting number of rows in table;
        $sql = "select * from user_details";
        $result = mysqli_query($connection, $sql);
        $no_of_row = mysqli_num_rows($result);

        $id = $no_of_row + 1;

        //insert into user_details table
        $query = "INSERT INTO user_details (user_id, first_name, last_name, email) VALUES ('{$id}','{$firstname}', '{$lastname}', '{$email}')";
        $result = mysqli_query($connection, $query);

        //insert into users table
        $query = "INSERT INTO users ( username, password, user_details_id) VALUES ('{$username}', '{$password}', '{$id}')";
        $result = mysqli_query($connection, $query);

        $msg =  "User Registered Sucessfully";
    } else {
        $msg = "Enter all field with * symbol";
    }
}
?>

<div class="container p-5 mt-2" style="height: 80%;">
    <h2 class="text-light TextShadow">Enter Your Details</h2>
    <form action="" method="post">
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
        <div class="input-group mb-3">
            <div class="input-group-text required">Email</div>
            <input type="email" class="form-control" name="email">
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