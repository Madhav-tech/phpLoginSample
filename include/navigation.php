<nav class="navbar  navbar-light navbar-expand-sm">
    <div class="container-fluid">
        <a href="../login" class=" navbar-brand"><i class="bi bi-person-circle"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#loginId">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="loginId">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a href="index.php?source=create" class="nav-link">Create account</a></li>
                <li class="nav-item"><a href="index.php?source=help" class="nav-link">Help</a></li>
                <li class="nav-item"><a href="" class="nav-link">About</a></li>
            </ul>
            <ul class="navbar-nav">
                <?php
                if ($_SESSION['valid']) {
                    echo "<li class='nav-item'><a href='./logout.php' class='nav-link'>Logout</a></li>";
                } else {
                    echo '<li class="nav-item"><a href="../login" class="nav-link">Login</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>