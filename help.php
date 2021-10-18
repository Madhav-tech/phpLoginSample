<?php
if ($_SESSION['valid']) {
    header("Location:include/userHelp.php");
}
$msg = '';
if (isset($_POST['forgot'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);

    if (!empty(trim($username)) && !empty(trim($lastname))) {
        $query = "SELECT * FROM users WHERE username = '{$username}' AND lastname = '{$lastname}'";
        $result = mysqli_query($connection, $query);
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
<div class="text-center mb-3">
    <h3>Forgot Password</h3>
</div>
<div class="d-flex justify-content-center p-2">
    <form action="#" method="POST">
        <div class="input-group mb-3">
            <label class="input-group-text required">Last Name</label>
            <input type="text" class="form-control" name="lastname" placeholder="Enter Your Last Name">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text required">User Name</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username">
        </div>
        <input class="btn btn-outline-success text-dark" type="submit" name="forgot" id="" value="Know Your Password">
    </form>
</div>