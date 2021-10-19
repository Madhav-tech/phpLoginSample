<?php include "include/header.php"; ?>
<?php

if ($_SESSION['valid']) {
    $user_id = $_SESSION['user_details_id'];

    $userDatils = new UserDetails();
    $row = $userDatils->getDetailsFromId($user_id);

    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $email = $row['email'];
    
} else {
    header("Location:index.php?source=false");
}
?>

<div class="mx-3 ">
    <div class="d-flex justify-content-center ">
        <H1>User Details</H1>
    </div>
    <table class=" table table-bordered bg-light text-center border-primary ">

        <tr>
            <th>First Name</th>
            <td><?= $firstName; ?></td>
            <td><a class="btn btn-outline-danger" href="update.php">Update</a> </td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td><?= $lastName ?></td>
            <td><a class="btn btn-outline-danger" href="update.php">Update</a> </td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= $email ?></td>
            <td><a class="btn btn-outline-danger" href="update.php">Update</a> </td>
        </tr>

    </table>
</div>
<?php include "include/footer.php"; ?>