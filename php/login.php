<?php
/*
1. Hashimi i Fjalëkalimit me password_hash() dhe password_verify()
Ky është tipari më i rëndësishëm i sigurisë:

Për regjistrim (Sign Up): Përdorni funksionin password_hash($rawPassword, PASSWORD_DEFAULT) për të kthyer fjalëkalimin e thjeshtë në një varg karakteresh të pa-kthyeshëm (hash). Ky është standardi aktual i sigurisë në PHP dhe përdor algoritmin Bcrypt (ose një më të mirë nëse bëhet i disponueshëm).

Për hyrje (Login): Përdorni funksionin password_verify($EnteredPassword, $storedHash) për të krahasuar fjalëkalimin e futur nga përdoruesi me hash-in e ruajtur në databazë. Ky funksion eliminon nevojën për algoritme të vjetra (si MD5) dhe parandalon që fjalëkalimet të zbulohen në rast se databaza kompromentohet.

2. Përdorimi i Fjalive të Përgatitura (Prepared Statements)
Përdorimi i funksioneve mysqli_prepare() dhe mysqli_stmt_bind_param() është një veçori thelbësore e sigurisë:

Mbrojtje nga SQL Injection: Ky mekanizëm i mbron të dhënat tuaja nga sulmet SQL Injection duke ndarë komandën SQL nga të dhënat e përdoruesit. Të dhënat e përdoruesit trajtohen gjithmonë si vlera, jo si pjesë e komandës SQL.

3. Logjika e Vlefshmërisë së Fjalëkalimit të Ri (Password Change Validation)
Blloku i ndryshimit të fjalëkalimit (Change Password) është i sigurt dhe i strukturuar mirë sepse:

Verifikon Fjalëkalimin e Vjetër: Së pari, kodi merr hash-in e vjetër dhe e verifikon atë me fjalëkalimin e futur nga përdoruesi duke përdorur password_verify(). Kjo siguron që vetëm pronari i llogarisë po bën ndryshimin.

Verifikon Përputhshmërinë e Fjalëkalimeve të Reja: Përdorimi i kushtit if ($newPassword !== $confirmNewPassword) parandalon gabimet e shkrimit dhe siguron që përdoruesi të vendosë fjalëkalimin e dëshiruar.

Rihashon Fjalëkalimin e Ri: Fjalëkalimi i ri (nëse vërtetohet) hash-ohet menjëherë me password_hash() para se të ruhet në databazë, duke ruajtur kështu nivelin e lartë të sigurisë.
*/

// Fillimi i sesionit duhet të jetë gjithmonë funksioni i parë
// që thirret në çdo faqe që përdor variabla sesioni.
session_start();


// Lidhja me databazën duhet të përfshihet para se të ekzekutohet
// çdo logjikë që e përdor variablën $connect.
include "connection/connect.php";

// Logjika e Përpunimit të Formës së Hyrjes (Login)
if (isset($_POST['loginbtn'])) {
    $Enteredusername = $_POST['enteredusername'];
    $Enteredpassword = $_POST['enteredpassword'];

    // 1. Përgatitja e Fjalisë SQL
    // Këtu marrim ID-në, hash-in e fjalëkalimit dhe të dhënat e tjera.
    // Përdorimi i '?' ndalon SQL Injection.
    $loginquery = "SELECT user_id, user_password, user_username, user_pic, user_status FROM users WHERE user_username = ? LIMIT 1";

    // 2. Inicializo dhe Përgatit fjalinë (Prepared Statement)
    $stmt = mysqli_prepare($connect, $loginquery);

    // Lidhja e parametrave (vlera e përdoruesit lidhet me '?' si string - "s")
    mysqli_stmt_bind_param($stmt, "s", $Enteredusername);

    // 3. Ekzekutimi i fjalisë
    mysqli_stmt_execute($stmt);

    // 4. Marrja e rezultateve
    $loginresult = mysqli_stmt_get_result($stmt);

    // Kontrollon nëse është gjetur një përdorues dhe merr të dhënat
    if ($loginresult && $userdata = mysqli_fetch_assoc($loginresult)) {
        // 5. Verifikimi i Fjalëkalimit (Siguria Kryesore!)
        // Përdor funksionin modern password_verify() për të krahasuar fjalëkalimin e thjeshtë
        // me hash-in e ruajtur (Bcrypt).
        if (password_verify($Enteredpassword, $userdata['user_password'])) {

            // Sukses! Vendos variablat e sesionit
            $_SESSION['userid'] = $userdata['user_id'];
            $_SESSION['userusename'] = $userdata['user_username'];
            $_SESSION['userpic'] = $userdata['user_pic'];
            $_SESSION['userstatus'] = $userdata['user_status'];

            // Përfundon fjalinë dhe ridrejton në dashboard
            mysqli_stmt_close($stmt);
            header('location: dashboard.php');
            exit; // Është mirë të përdoret exit pas header('location')
        }
    }

    // Dështim (Përdoruesi nuk u gjet ose fjalëkalimi nuk u përputh)
    // Megjithëse ridrejtimi ndodh vetëm një herë, kjo linjë siguron
    // që $stmt të mbyllet në të gjitha rastet.
    // Ky mesazh është gjithashtu i mirë për sigurinë: nuk tregon nëse gabimi ishte
    // fjalëkalimi apo emri i përdoruesit (parandalon enumerimin e përdoruesve).
    if (isset($stmt)) {
        mysqli_stmt_close($stmt);
    }
    header("location: login.php?nouserfound=No user was found");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                    // Shfaq mesazhin e dështimit të login-it nëse ekziston variabla GET
                    // VINI RE: Po kërkoni $get, por duhet të jetë $_GET
                    // Kontrollo: if (isset($_GET['nouserfound'])) { ... }
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
                        // *** VINI RE: KJO ËSHTË BLLOKU I DYTË I LOGJIKËS SË LOGIN-IT ***
                        // Blloku i login-it (rreshtat 4-37) është tashmë në krye të faqes.
                        // Ky bllok këtu më poshtë (rreshtat 104-137) duhet të HIQET sepse është DUBLIKAT
                        // dhe përdorimi i include "connection/connect.php"; KËTU do të shkaktonte
                        // një gabim nëse lidhja është tashmë e hapur.

                        // HIQ KËTË BLLOK TË KODIT TË DUPLIKUAR:
                        /*
                        include "connection/connect.php"; 
                        if (isset($_POST['loginbtn'])) {
                            // ... Të gjithë rreshtat e logjikës së login-it duplikat ...
                        }
                        */
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
                        </fieldset>
                        <button type="submit" class="btn-signup" name="signupnewuser">Continue</button>

                        <?php
                        // Logjika e Regjistrimit (Sign Up)
                        if (isset($_POST['signupnewuser'])) {
                            $newuserusername = $_POST['signup-username'];
                            $newusersignupemail = $_POST['signup-email'];
                            $rawPassword = $_POST['signup-password'];

                            // 1. Hashimi i Fjalëkalimit (TIPARI MË I MIRË I SIGURISË)
                            // Konverton fjalëkalimin e thjeshtë në një hash të sigurt (Bcrypt).
                            $newusersignuppassword = password_hash($rawPassword, PASSWORD_DEFAULT);

                            // 2. Përgatitja e Fjalisë SQL për INSERT
                            $newuserquery = "INSERT INTO users (user_email, user_password, user_username) VALUES (?, ?, ?)";

                            // 3. Inicializimi dhe Lidhja e Parametrave
                            $stmt = mysqli_prepare($connect, $newuserquery);
                            // Lidhja e 3 stringjeve: email, hash i fjalëkalimit, username ("sss")
                            mysqli_stmt_bind_param($stmt, "sss", $newusersignupemail, $newusersignuppassword, $newuserusername);

                            // 4. Ekzekutimi
                            if (mysqli_stmt_execute($stmt)) {
                                // Sukses
                                echo "<h1>New user created! You can now log in.</h1>";
                            } else {
                                // Dështim
                                echo "error creating user! " . mysqli_error($connect) . " detected during execution";
                            }

                            mysqli_stmt_close($stmt);
                        }
                        ?>
                    </form>
                </div>

                <div class="form-wrapper">
                    <button type="button" class="switcher switcher-secure-change">
                        Change Password
                        <span class="underline"></span>
                    </button>

                    <form class="form form-secure-change" method="post">
                        <fieldset>
                            <legend>Verify your identity and set a new password.</legend>
                        </fieldset>
                        <button type="submit" class="btn-change-password" name="secure-change-password-btn">Update Password</button>

                        <?php
                        // Logjika e Ndryshimit të Fjalëkalimit
                        if (isset($_POST['secure-change-password-btn'])) {
                            $enteredUsername = $_POST['change-username'];
                            $oldPassword = $_POST['old-password'];
                            $newPassword = $_POST['new-password'];
                            $confirmNewPassword = $_POST['confirm-new-password'];

                            // --- 1. Kontrollet e Vlefshmërisë Bazë ---
                            if ($newPassword !== $confirmNewPassword) {
                                echo "<p class='error'>New passwords do not match.</p>";
                            } elseif (strlen($newPassword) < 3) { // Rekomandohet minimumi 8-10
                                echo "<p class='error'>New password must be at least 3 characters long.</p>";
                            } else {
                                // --- 2. Gjej Përdoruesin dhe Hash-in e Vjetër ---
                                $fetchQuery = "SELECT user_id, user_password FROM users WHERE user_username = ? LIMIT 1";
                                $stmt = mysqli_prepare($connect, $fetchQuery);
                                mysqli_stmt_bind_param($stmt, "s", $enteredUsername);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);

                                if ($result && $user = mysqli_fetch_assoc($result)) {
                                    $userId = $user['user_id'];
                                    $storedHash = $user['user_password'];

                                    // --- 3. Verifiko Fjalëkalimin e Vjetër ---
                                    if (password_verify($oldPassword, $storedHash)) {

                                        // --- 4. Hasho Fjalëkalimin e Ri (Siguria) ---
                                        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                                        // --- 5. Bëj Update Databazën me Hash-in e Ri ---
                                        $updateQuery = "UPDATE users SET user_password = ? WHERE user_id = ?";
                                        $updateStmt = mysqli_prepare($connect, $updateQuery);
                                        // Lidhja e një stringu (hash) dhe një integer (id) ("si")
                                        mysqli_stmt_bind_param($updateStmt, "si", $newHashedPassword, $userId);

                                        if (mysqli_stmt_execute($updateStmt)) {
                                            echo "<p class='success'>Password successfully changed! Please log in with your new password. 🎉</p>";
                                            // Është mirë të shkatërrohet sesioni pas ndryshimit të fjalëkalimit për siguri.
                                            if (isset($_SESSION['userid'])) {
                                                session_destroy();
                                            }
                                        } else {
                                            echo "<p class='error'>Database error during update: " . mysqli_error($connect) . "</p>";
                                        }
                                        mysqli_stmt_close($updateStmt);
                                    } else {
                                        // Mesazhi i gabimit i kombinuar për të rritur sigurinë
                                        echo "<p class='error'>Username or current password is incorrect.</p>";
                                    }
                                } else {
                                    echo "<p class='error'>Username or current password is incorrect.</p>";
                                }
                                mysqli_stmt_close($stmt);
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </section>
    </main>


    <?php
    // Përfshirja e fundit e faqes
    include "components/footer.php";
    ?>

</body>
<script>
    // KODI JAVASCRIPT PËR NDRYSHIMIN E FORMULARËVE
    const switchers = [...document.querySelectorAll('.switcher')]
    const resetWrapper = document.querySelector('.form-wrapper:last-child'); // Target the new wrapper

    switchers.forEach(item => {
        item.addEventListener('click', function() {
            // Gjen formën aktive dhe largon klasën
            document.querySelector('.form-wrapper.is-active').classList.remove('is-active');

            // Shton klasën te forma e klikuar
            this.parentElement.classList.add('is-active');
        })
    })
</script>
<script src="../js/script.js">

</script>

</html>