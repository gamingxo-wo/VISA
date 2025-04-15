<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $username = htmlspecialchars(trim($_POST['username']));
    $age = htmlspecialchars(trim($_POST['age']));
    $lastname = htmlspecialchars(trim($_POST['lastname']));
    $phone = htmlspecialchars(trim($_POST['phone']));

    // Create secure filenames
    $filename = "users/" . preg_replace("/[^a-zA-Z0-9]/", "", $username) . ".txt";
    $scriptname = "scripts/" . preg_replace("/[^a-zA-Z0-9]/", "", $username) . "_script.sh";

    // Save user info (not shown to user)
    $userData = "Username: $username\nAge: $age\nLast Name: $lastname\nPhone: $phone\n";
    file_put_contents($filename, $userData);

    // Generate script (private use)
    $scriptContent = "#!/bin/bash\n";
    $scriptContent .= "echo \"Processing user $username\"\n";
    $scriptContent .= "# Data: age=$age, lastname=$lastname, phone=$phone\n";
    file_put_contents($scriptname, $scriptContent);
    chmod($scriptname, 0755); // Make script executable

    // Redirect user to a thank you page
    header("Location: thankyou.html");
    exit();
}
?>
