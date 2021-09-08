<nav class="navbar navbar-expand-md navbar-dark bg-dark bar">
    <div class="container-fluid">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav me-auto">
                <li class="nav-item bar-text">
                    <a class="nav-link active" href="home.php">HOME</a>
                </li>
                <li class="nav-item  bar-text">
                    <a class="nav-link active" href="diary.php">DIARY</a>
                </li>
                <li class="nav-item bar-text">
                    <a class="nav-link active" href="shop.php">EVENTS</a>
                </li>
            </ul>
        </div>
        <div class="mx-auto order-0">
            <a class="navbar-brand mx-auto" href="home.php"><img id= "logo"src="images/logo.png" height="55"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ms-auto">

                <?php if( !isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"] ): ?>

                    <li class="nav-item bar-text">
                        <a class="nav-link active" href="login.php">LOGIN</a>
                    </li>
                    <li class="nav-item bar-text">
                        <a class="nav-link active" href="signup.php">SIGNUP</a>
                    </li>

                <?php else: ?>

                    <li class="nav-item bar-text">
                        <div class="nav-link active">HELLO <?php echo $_SESSION["username"]; ?>!</div>
                    </li>

                    <li class="nav-item bar-text">
                        <a class="nav-link active" href="logout.php">LOGOUT</a>
                    </li>
                    
                <?php endif;?>

            </ul>
        </div>
    </div>
</nav>