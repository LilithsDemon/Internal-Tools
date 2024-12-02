<?php

function sendMessageToEveryone($message)
{
    $SQL = "SELECT `UserID` FROM `Users`";

    $result = executeCommandNoParams($SQL);

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
    $SQL = "SELECT `UserID` FROM `Users` WHERE `Stakeholder` = 1";

    $result = executeCommandNoParams($SQL);

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
    $SQL = "SELECT `UserID` FROM `Users` WHERE `Stakeholder` = 0";

    $result = executeCommandNoParams($SQL);

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
    $SQL = "INSERT INTO `Messages`(`MessageID`, `UserID`, `Message`, `Date`) VALUES (null,?,?,?)";

    $result = executeCommandNoResult($SQL, 'iss', array($user_id, $message, date("Y-m-d")));

    if($result)
    {
        return true;
    }
    return false;
}