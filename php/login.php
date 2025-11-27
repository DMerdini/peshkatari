<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Log in</title>
</head>

<body>
    <?php include "components/navbar.php";
    ?>
    <main>
        <section class="forms-section">
            <h1 class="section-title">Animated Forms</h1>
            <div class="forms">
                <div class="form-wrapper is-active">
                    <?php
                    if (isset($get['nouserfound'])) {
                        echo "<p>no user was found</p>";
                    }
                    ?>
                    <button type="button" class="switcher switcher-login">
                        Login
                        <span class="underline"></span>
                    </button>
                    <form class="form form-login" method="post">

                        <fieldset>
                            <legend>Please, enter your username and password for login.</legend>
                            <div class="input-block">
                                <label for="login-username">Username</label>
                                <input id="login-username" name="enteredusername" type="text" required>
                            </div>
                            <div class="input-block">
                                <label for="login-password">Password</label>
                                <input id="login-password" name="enteredpassword" type="password">
                            </div>
                        </fieldset>
                        <button type="submit" name="loginbtn" class="btn-login">Login</button>
                        <?php
                        include "connection/connect.php";
                        if (isset($_POST['loginbtn'])) {
                            $Enteredusername = $_POST['enteredusername'];
                            $Enteredpassword = md5($_POST['enteredpassword']);
                            $loginquery = "SELECT * FROM `users` WHERE `user_username`='$Enteredusername' AND `user_password`='$Enteredpassword'";
                            $loginresult = mysqli_query($connect, $loginquery);
                            if ($loginresult && mysqli_num_rows($loginresult) > 0) {
                                $userdata = mysqli_fetch_assoc($loginresult);
                                session_start();
                                $_SESSION['userid'] = $userdata['user_id'];
                                $_SESSION['userusename'] = $userdata['user_username'];
                                $_SESSION['userpic'] = $userdata['user_pic'];
                                $_SESSION['userstatus'] = $userdata['user_status'];
                                header('location:dashboard.php');
                                exit;
                            } else {
                                header("location:login.php?nouserfound='No user was found'");
                                exit;
                            }
                        }
                        ?>
                    </form>
                </div>
                <div class="form-wrapper">
                    <button type="button" class="switcher switcher-signup">
                        Sign Up
                        <span class="underline"></span>
                    </button>
                    <form class="form form-signup" method="post">
                        <fieldset>
                            <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                            <div class="input-block">
                                <label for="signup-email">E-mail</label>
                                <input id="signup-email" type="email" name="signup-email" required>
                            </div>
                            <div class="input-block">
                                <label for="signup-username">Username</label>
                                <input id="signup-username" type="text" name="signup-username" required>
                            </div>
                            <div class="input-block">
                                <label for="signup-password">Password</label>
                                <input id="signup-password" type="password" name="signup-password" required>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn-signup" name="signupnewuser">Continue</button>
                        <?php
                        if (isset($_POST['signupnewuser'])) {
                            $newuserusername = $_POST['signup-username'];
                            $newusersignupemail = $_POST['signup-email'];
                            $newusersignuppassword = md5($_POST['signup-password']);
                            $newuserquery = "INSERT INTO `users`(`user_email`, `user_password`,  `user_username`) VALUES ('$newusersignupemail','$newusersignuppassword','$newuserusername')";
                            if (mysqli_query($connect, $newuserquery)) {
                                echo "<h1>New user created</h1>";
                            } else {
                                echo "error creating user!\n" + mysqli_error($connect) + " detected during execution";
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </section>
    </main>


    <?php
    include "components/footer.php";
    ?>

</body>
<script>
    const switchers = [...document.querySelectorAll('.switcher')]

    switchers.forEach(item => {
        item.addEventListener('click', function() {
            switchers.forEach(item => item.parentElement.classList.remove('is-active'))
            this.parentElement.classList.add('is-active')
        })
    })
</script>
<script src="../js/script.js">

</script>

</html>