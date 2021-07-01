<!DOCTYPE html>
<html lang="en">

<head>
    <title>Page 1</title>
    <script src="https://kit.fontawesome.com/04084ebb5c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="src/css/index.css">
</head>

<body>
    <?php
        session_start();
        if (isset($_SESSION['username']) and isset($_SESSION['cin_user'])) {
            echo '<script>window.location.assign("src/pages/index.php")</script>';
        }
    ?>
    <div class="cont">
        <form action="src/pages/login.php" method="POST">
            <div class="demo">
                <div class="login">
                    <i class="login__check fas fa-user-md"></i>
                    <div class="login__form">
                        <div class="login__row">
                            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                            </svg>
                            <input type="text" name="user" class="login__input name" placeholder="Username" />
                        </div>
                        <div class="login__row">
                            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                            </svg>
                            <input type="password" name="password" class="login__input pass" placeholder="Password" />
                        </div>
                        <input type="submit" class="login__submit" value="Sign in" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>