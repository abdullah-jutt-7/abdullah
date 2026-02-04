// <?php
// 	$to = "abdullajatt650@gmail.com"; // Recipient Email Address
	
// 	$errors = array();
	
// 	if ($_SERVER['REQUEST_METHOD'] != "POST")
// 	{
// 		$errors[] = "No data was sent!";
// 	}
	
// 	if (empty($_POST['captcha-solution']))
// 	{
// 		$errors[] = "No captcha solution was provided!";
// 	}
	
// 	if (empty($_POST['captcha-response']))
// 	{
// 		$errors[] = "No captcha response was provided!";
// 	}
	
// 	if (!$errors && $_POST['captcha-solution'] != $_POST['captcha-response'])
// 	{
// 		$errors[] = "Captcha response is incorrect!";
// 	}
	
// 	if (!$errors)
// 	{
// 		$email = "You have a new form submission...\n\n";
// 		foreach ($_POST as $name => $value)
// 		{
// 			if ($name != "captcha-solution" && $name != "captcha-response")
// 			{
// 				$email .= "$name: $value\n";
// 			}
// 		}
// 		if (mail($to, "Form Submission", $email))
// 		{
// 			echo "Form submitted successfully!";
// 		}
// 		else
// 		{
// 			$errors[] = "Form failed to send!";
// 		}
// 	}
	 
// 	if ($errors)
// 	{
// 		echo "Sorry, something went wrong:";
// 		echo "<ul>";
// 		foreach ($errors as $error)
// 		{
// 			echo "<li>$error</li>";
// 		}
// 		echo "</ul>";
// 	}
// ?>




<?php

$to = "abdullajatt650@gmail.com"; // Recipient email
$errors = [];

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $errors[] = "No data was sent!";
}

// Validate captcha inputs
$captchaSolution = $_POST['captcha-solution'] ?? '';
$captchaResponse = $_POST['captcha-response'] ?? '';

if ($captchaSolution === '') {
    $errors[] = "No captcha solution was provided!";
}

if ($captchaResponse === '') {
    $errors[] = "No captcha response was provided!";
}

if (empty($errors) && $captchaSolution !== $captchaResponse) {
    $errors[] = "Captcha response is incorrect!";
}

// Send email if no errors
if (empty($errors)) {

    $message = "You have a new form submission...\n\n";

    foreach ($_POST as $key => $value) {
        if (!in_array($key, ['captcha-solution', 'captcha-response'])) {
            $safeKey   = htmlspecialchars($key, ENT_QUOTES, 'UTF-8');
            $safeValue = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            $message  .= "{$safeKey}: {$safeValue}\n";
        }
    }

    if (mail($to, "Form Submission", $message)) {
        echo "Form submitted successfully!";
        exit;
    } else {
        $errors[] = "Form failed to send!";
    }
}

// Display errors
if (!empty($errors)) {
    echo "Sorry, something went wrong:";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>" . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . "</li>";
    }
    echo "</ul>";
}
