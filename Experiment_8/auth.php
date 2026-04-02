<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<form method="POST">
<h2>Register</h2>
<input type="text" name="username" placeholder="Username">
<input type="email" name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">
<button type="submit" name="register">Register</button>
</form>

<form method="POST">
<h2>Login</h2>
<input type="text" name="username" placeholder="Username">
<input type="password" name="password" placeholder="Password">
<button type="submit" name="login">Login</button>
</form>

<?php
if (isset($_POST['register'])) {
    echo "<form><h2>Registered Successfully</h2><p>Welcome ".$_POST['username']."</p></form>";
}
if (isset($_POST['login'])) {
    echo "<form><h2>Login Successful</h2><p>Hello ".$_POST['username']."</p></form>";
}
?>

</div>

</body>
</html>