<?php

function sendMessageToEveryone($message)
{
    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    require_once('./include/_bdie.php');

    $SQL = "SELECT `UserID` FROM `Users`";

    $result = executeCommand($SQL);

    if($result)
    {
        while($row = $result->fetch_assoc())
        {
            sendMessageTo($row['UserID'], $message);
        }
        return true;
    }
    return false;
}

function sendMessageToStakeholders($message)
{
    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    require_once('./include/_bdie.php');

    $SQL = "SELECT `UserID` FROM `Users` WHERE `Stakeholder` = 1";

    $result = executeCommand($SQL);

    if($result)
    {
        while($row = $result->fetch_assoc())
        {
            sendMessageTo($row['UserID'], $message);
        }
        return true;
    }
    else
    {
        return false;
    }
}

function sendMessageToTeamMembers($message)
{
    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    require_once('./include/_bdie.php');

    $SQL = "SELECT `UserID` FROM `Users` WHERE `Stakeholder` = 0";

    $result = executeCommand($SQL);

    if($result)
    {
        while($row = $result->fetch_assoc())
        {
            sendMessageTo($row['UserID'], $message);
        }
        return true;
    }
    return false;
}

function sendMessageTo($user_id, $message)
{
    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    require_once('./include/_bdie.php');

    $SQL = "INSERT INTO `Messages`(`MessageID`, `UserID`, `Message`, `Date`) VALUES (null,?,?,?)";

    $result = executeCommand($SQL, 'iss', array($user_id, $message, date("Y-m-d")));

    if($result)
    {
        return true;
    }
    return false;
}