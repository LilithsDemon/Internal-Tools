<?php

if(isset($_POST['user_id']) && isset($_POST['message']))
{
    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    require_once('./include/_bdie.php');

    $SQL = "INSERT INTO `Messages`(`MessageID`, `UserID`, `Message`, `Date`) VALUES (null,?,?,?)";

    $result = executeCommand($SQL, 'iss', array($_POST['user_id'], $_POST['message'], date("Y-m-d")));

    if($result)
    {
        DieWithStatus("Message sent successfully", 200);
    }
    else
    {
        DieWithStatus("Failed to send message", 500);
    }
}
else
{
    DieWithStatus("Missing Form information", 400);
}