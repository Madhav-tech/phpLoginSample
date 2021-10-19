<?php

$msg = '';
if (isset($_POST['login'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    if (!empty(trim($username)) && !empty(trim($password))) {

        $user = new Users();

        $result = $user->getUser($username, $password);
        $no_of_row = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($no_of_row > 0) {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = $username;
            $_SESSION['user_details_id'] = $row['user_details_id'];
            header("Location:userDetails.php");
        } else {
            $msg = "Invalid Credential";
            $_SESSION['valid'] = false;
        }
    } else {
        $msg = "Enter all field with * symbol";
    }
}

?>

<div class="container bg-light rounded py-2 mt-3">
    <h2 class="mt-3">Login</h2>
    <span class="d-flex flex-row-reverse bd-highlight">*required</span>
    <form action="" method="post">
        <div class="input-group mb-3">
            <div class="input-group-text required">Username&nbsp;</div>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="input-group mb-3 ">
            <div class="input-group-text required">Password&nbsp;</div>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="d-flex justify-content-center btn-group ">
            <input class="btn btn-info mb-3" type="submit" name="login" id="login">
        </div>
    </form>
    <div class="d-flex justify-content-center text-red my-0" id="error">
        <?= $msg ?>
    </div>
    <div class="my-3 d-flex justify-content-between">
        <a class="btn btn-warning" href="index.php?source=create" name="create" id="create">Create Account</a>
        <a class="btn btn-warning" href="index.php?source=help" name="help" id="help">Help</a>
    </div>

</div>