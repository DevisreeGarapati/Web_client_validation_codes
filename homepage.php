<!DOCTYPE html>
<html lang="en">
<head>
    <title>Website</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <h1 class = "heading" >Welcome!!</h1>
    <div class = "buttons-grp">
    <form method="post" name = "register" action="register.php">  
        <button type="submit" class="x" onclick="register()"><b>Register</b></button>
    </form>
    <form method="post" name = "login" action="loginpage.php">
        <button type="submit" class="y" onclick="login()"><b>Login</b></button>
    </form>
    </div>
</body>
</html>