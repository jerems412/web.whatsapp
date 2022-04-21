<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- title -->
    <title>Whatsapp web</title>
    <!-- links -->
    <link rel="icon" href="<?php echo $url; ?>public/icon.ico" type="image/icon ico">
    <link rel="stylesheet" href="<?php echo $url; ?>public/Authentification/css/style.css">
</head>

<body>
    <div class="container">
        <form action="<?php echo $url; ?>Authentification/sign_up" method="post" style="margin-top:1%;">
            <legend style="text-align:center;">
                <h1>Sign In</h1>
            </legend>
            <label for="">Phone Number</label>
            <input type="text" name="phone" maxlength="9" minlength="9" placeholder="Enter your phone number" value="<?php if(isset($_SESSION['errorSignphone'])){echo $_SESSION['errorSignphone'];} ?>" required>
            <label for="">Profil name</label>
            <input type="text" name="profil" maxlength="10" minlength="4" placeholder="Enter your profil name" value="<?php if(isset($_SESSION['errorSignprofil'])){echo $_SESSION['errorSignprofil'];} ?>" required>
            <label for="">Actu</label>
            <input type="text" name="actu" placeholder="Enter your actu" value="<?php if(isset($_SESSION['errorSignactu'])){echo $_SESSION['errorSignactu'];} ?>">
            <label for="">Profil picture</label>
            <input type="file" name="picture" accept=".jpg,.jpeg,.png" value="<?php if(isset($_SESSION['errorSignpicture'])){echo $_SESSION['errorSignpicture'];} ?>" required>
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Enter your password" value="<?php if(isset($_SESSION['errorSignpassword'])){echo $_SESSION['errorSignpassword'];} ?>" required>
            <label for=""><a href="">Forget password ?</a></label>
            <input type="submit" value="Sign in">
            <a href="<?php echo $url; ?>Authentification/login">Log in</a>
            <?php if(isset($_SESSION['errorSign'])){echo $_SESSION['errorSign'];} ?>
        </form>
    </div>
</body>

</html>