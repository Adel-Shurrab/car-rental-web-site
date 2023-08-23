<?php
function validateUserName($user_Name)
{
    if (preg_match('/^[a-z]/i', $user_Name) == FALSE) {
        return true;
    }
}

function validatePhone($phone)
{
    if ((strlen($phone) < 10) || (strlen($phone) > 14)) {
        return true;
    }
}

function validateMajor($major)
{
    if (preg_match("/^[a-zA-Z\s]+$/", $major) == false) {
        return true;
    }
}

function validateDOB($dob)
{
    $date2 = date("d-m-Y"); //today's date

    $date1 = new DateTime($dob);
    $date2 = new DateTime($date2);

    $interval = $date1->diff($date2);

    $myage = $interval->y;

    if ($myage < 16) {
        return true;
    }
}

function validatePass($password)
{
    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 9) {
        return true;
    }
}

