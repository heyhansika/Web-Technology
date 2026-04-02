<!DOCTYPE html>
<html>
<head>
    <title>Student Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
<form action="process.php" method="POST">
    <h2>Student Registration</h2>

    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="number" name="age" placeholder="Age">

    <!-- Radio -->
    <label>Gender</label>
    <div class="inline">
        <label><input type="radio" name="gender" value="Male"> Male</label>
        <label><input type="radio" name="gender" value="Female"> Female</label>
        <label><input type="radio" name="gender" value="Other"> Other</label>
    </div>

    <!-- Dropdown -->
    <label>University</label>
    <select name="university">
        <option value="">Select</option>
        <option>IIT Delhi</option>
        <option>IIT Bombay</option>
        <option>NIT Trichy</option>
        <option>Jain University</option>
        <option>Delhi University</option>
        <option>Anna University</option>
    </select>

    <!-- Multi Select -->
    <label>Courses Interested</label>
    <select name="courses[]" multiple>
        <option>AI</option>
        <option>Web Dev</option>
        <option>Data Science</option>
        <option>Cyber Security</option>
    </select>

    <!-- Checkbox -->
    <label>Skills</label>
    <div class="inline">
        <label><input type="checkbox" name="skills[]" value="Python"> Python</label>
        <label><input type="checkbox" name="skills[]" value="Java"> Java</label>
        <label><input type="checkbox" name="skills[]" value="C++"> C++</label>
    </div>

    <!-- Extra inputs -->
    <input type="date" name="dob">
    <input type="range" name="confidence" min="1" max="10">

    <textarea name="message" placeholder="About yourself"></textarea>

    <button type="submit">Submit</button>
</form>
</div>

</body>
</html>