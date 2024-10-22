<?php

if(!isset($_SESSION)) {
    session_start();
}

require_once('./include/_bdie.php');

if(isset($_SESSION['userID'], $_POST['new_password'], $_POST['password_confirm']))
{

    if($_POST['new_password'] != $_POST['password_confirm'])
    {
        DieWithStatus("Passwords do not match", 400);
    }

    require_once('./include/_connect.php');
    include_once('./include/_execute.php');

    $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $SQL = "Update `Users` SET `Password` = ? WHERE `UserID` = ?";

    $password = password_hash($_POST['user_name'], PASSWORD_DEFAULT);

    $result = executeCommandNoResult($SQL, 'si', [$password, $_SESSION['userID']]);

    if($result)
    {
        DieWithStatus("Password changed successfully", 200);
    }
    else
    {
        DieWithStatus("Failed to change password", 500);
    }
}
DieWithStatus("Missing Form information", 400);