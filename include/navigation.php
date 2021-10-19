<?php
$home = "";
$loginText = "./logout.php";
$text = "Logout";
if (!isset($_SESSION['valid']) || !$_SESSION['valid']) {
    $home = "../login";
    $loginText = "../login";
    $text = "Login";
}
?>
<nav class="navbar  navbar-light navbar-expand-sm">
    <div class="container-fluid">

        <a href="<?= $home ?>" class=" navbar-brand"><i class="bi bi-person-circle"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#loginId">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="loginId">
            <ul class="navbar-nav me-auto">
                <?php if (!isset($_SESSION['valid']) || !$_SESSION['valid']) {
                    echo "<li class='nav-item'><a href='index.php?source=create' class='nav-link'>Create account</a></li>";
                }
                ?>
                <li class="nav-item"><a href="index.php?source=help" class="nav-link">Help</a></li>
                <li class="nav-item"><a href="" class="nav-link">About</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class='nav-item'><a href='<?= $loginText ?>' class='nav-link'><?= $text ?> </a></li>
            </ul>
        </div>
    </div>
</nav>