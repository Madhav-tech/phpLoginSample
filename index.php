<?php include "include/header.php";
 
if (isset($_SESSION['valid']) && $_SESSION['valid']) {
    header("Location:post.php");
}
?>
<div class="container-fluid row d-flex bg-light m-0" style="height: 92%;">
    <?php
    $source = "";
    if (isset($_GET['source'])) {
        $source = $_GET['source'];
        if ($source == 'false') {
            echo "<h3 class = 'text-center' id='error'>Access Denied</h3><span class = 'text-center' id='error'>Please Login First</span>";
        }
    }

    ?>
    <div class=" col-lg-8 bg-info rounded my-3">
        <div class="d-flex bg-primary justify-content-center rounded mt-2 ">
            <h1 class="TextShadow">A Sample Login Page</h1>
        </div>
        <?php
        switch ($source) {
            case 'create':
                include "create.php";
                break;
            case 'help':
                include "help.php";
                break;

            default:
        ?>
                <div class="text-center mt-2">
                    <img class="img-fluid rounded" src="image/ritu.jpg" alt="Ritu" height="100" width="450">
                </div>
        <?php
                break;
        }
        ?>
    </div>
    <div class="col-lg-4 bg-dark p- text-ligjht rounded my-3">
        <?php include "login.php"; ?>
    </div>
</div>
<?php include "include/footer.php"; ?>