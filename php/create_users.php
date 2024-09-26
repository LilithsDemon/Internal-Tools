<?php

if(isset($_POST['user_name']) && isset($_POST['user_first_name']) && isset($_POST['user_last_name']) && isset($_POST['stakeholder']) && isset($_POST['admin']))
{
    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    require_once('./include/_bdie.php');

    $SQL = "INSERT INTO `Users`(`UserID`, `Username`, `FirstName`, `LastName`, `Password`, `Stakeholder`, `Admin`) VALUES (null,?,?,?,?,?)";

    $password = password_hash($_POST['user_name'], PASSWORD_DEFAULT);

    $result = executeCommand($SQL, 'sssii', array($_POST['user_name'], $_POST['user_first_name'], $_POST['user_last_name'], $_POST['password'], $_POST['stakeholder'], $_POST['admin']));

    if($result)
    {
        DieWithStatus("User added successfully", 200);
    }
    else
    {
        DieWithStatus("Failed to add user", 500);
    }
}
else
{
    DieWithStatus("Missing Form information", 400);
}