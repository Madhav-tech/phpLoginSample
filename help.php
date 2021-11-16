<?php
if (isset($_SESSION['valid']) && $_SESSION['valid']) {
    header("Location:include/userHelp.php");
}
$msg = '';
if (isset($_POST['forgot'])) {
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);

    if (!empty(trim($firstname)) && !empty(trim($lastname))) {
        $query = "SELECT * FROM users join user_details on user_details_id = user_id WHERE first_name = '{$firstname}' AND last_name = '{$lastname}'";;
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die(mysqli_error($connection));
        }
        $no_of_row = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);

        if ($no_of_row > 0) {
            echo "<p class='bg-light text-center mt-3'>Your username is:- {$row['username']}<p>";
        } else {

            $msg = "Invalid Details";
        }
    } else {
        $msg = "Enter all field with * symbol";
    }
}
?>
<div class="text-center mb-3">
    <h3>Know Your Username</h3>
</div>
<div class="d-flex justify-content-center p-2">
    <form action="#" method="POST">
        <div class="input-group mb-3">
            <label class="input-group-text required">First Name</label>
            <input type="text" class="form-control" name="firstname" placeholder="Enter Firstname">
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text required">Last Name</label>
            <input type="text" class="form-control" name="lastname" placeholder="Enter Your Last Name">
        </div>
        <input class="btn btn-outline-success text-dark" type="submit" name="forgot" id="" >
        <div class="d-flex justify-content-center TextShadow my-0">
            <?= $msg ?>
        </div>
    </form>
</div>