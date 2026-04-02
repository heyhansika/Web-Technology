<?php
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];
$gender = $_POST['gender'] ?? "";
$university = $_POST['university'];
$courses = $_POST['courses'] ?? [];
$skills = $_POST['skills'] ?? [];
$confidence = $_POST['confidence'];
$message = $_POST['message'];
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<form>
<h2>Submission Result</h2>

<p><b>Name:</b> <?= $name ?></p>
<p><b>Email:</b> <?= $email ?></p>
<p><b>Age:</b> <?= $age ?></p>
<p><b>Gender:</b> <?= $gender ?></p>
<p><b>University:</b> <?= $university ?></p>

<p><b>Courses:</b> <?= implode(", ", $courses) ?></p>
<p><b>Skills:</b> <?= implode(", ", $skills) ?></p>

<p><b>Confidence:</b> <?= $confidence ?>/10</p>
<p><b>Message:</b> <?= $message ?></p>

</form>
</div>

</body>
</html>