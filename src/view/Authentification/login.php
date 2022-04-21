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
        <form action="<?php echo $url; ?>Authentification/logon" method="post">
            <legend style="text-align:center;">
                <h1>Login</h1>
            </legend>
            <label for="">Phone Number</label>
            <input type="text" name="phone" maxlength="9" minlength="9" placeholder="Enter your phone number" value="<?php if(isset($_SESSION['errorLoginNum'])){echo $_SESSION['errorLoginNum'];} ?>">
            <label for="">Password</label>
            <input type="password" name="password" placeholder="Enter your password" value="<?php if(isset($_SESSION['errorLoginPas'])){echo $_SESSION['errorLoginPas'];} ?>">
            <label for=""><a href="">Forget password ?</a></label>
            <input type="submit" value="Login">
            <a href="<?php echo $url; ?>Authentification/Sign_In">Create account</a>
            <?php if(isset($_SESSION['errorLogin'])){echo $_SESSION['errorLogin'];} ?>
        </form>
    </div>
</body>

</html>