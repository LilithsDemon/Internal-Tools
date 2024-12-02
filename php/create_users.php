<?php

if(!isset($_SESSION)) {
    session_start();
}

require_once('./include/_bdie.php');

if(isset($_SESSION['userID'], $_POST['user_name'], $_POST['user_first_name'], $_POST['user_last_name'], $_POST['stakeholder'], $_POST['admin']))
{
    require_once('./include/_connect.php');
    include_once('./send_message.php');
    include_once('./include/_execute.php');

    $SQL = "INSERT INTO `Users`(`UserID`, `Username`, `FirstName`, `LastName`, `Password`, `Stakeholder`, `Admin`) VALUES (null,?,?,?,?,?,?)";

    $password = password_hash($_POST['user_name'], PASSWORD_DEFAULT);

    $result = executeCommandNoResult($SQL, 'ssssss', [$_POST['user_name'], $_POST['user_first_name'], $_POST['user_last_name'], $password, $_POST['stakeholder'], $_POST['admin']]);

    if($result)
    {
        $SQL = "SELECT `UserID` FROM `Users` WHERE `Username` = ?";
        $result = executeCommand($SQL, 's', [$_POST['user_name']]);
        $row = $result->fetch_assoc();
        if(!sendMessageTo($row['UserID'], "Welcome to the internal tools four our project!"))
        {
            DieWithStatus("User added successfully but failed to send message to user", 500);
        }
        DieWithStatus("User added successfully", 200);
    }
    else
    {
        DieWithStatus("Failed to add user", 500);
    }
}
DieWithStatus("Missing Form information", 400);