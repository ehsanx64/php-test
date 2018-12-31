<?php
/*
 * Basic I\O using PHP-CLI
 *
 * How to run:
 *
 * Make sure you're in 'cli' directory then:
 *
 * php say-hello
 */

// Include the library
require __DIR__ . DIRECTORY_SEPARATOR . "cli-lib.php";

// Ask user for his/her name
echo "Please enter your name: ";

// Get the user input and store it
$user_input = in();

// Output the user input string back to user
out("Hello dear $user_input");
