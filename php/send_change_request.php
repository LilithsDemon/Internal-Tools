<?php

if(!isset($_SESSION)) {
    session_start();
}

require_once('./include/_bdie.php');

if(isset($_SESSION['userID'], $_POST['request_title'], $_POST['request_priority'], $_POST['request_description'], $_POST['request_budget'], $_POST['request_time'])) {
    if($_POST['request_title'] == "" || $_POST['request_priority'] == "" || $_POST['request_description'] == "" || $_POST['request_budget'] == "" || $_POST['request_time'] == "")
    {
        DieWithStatus("Please fill out all fields", 400);
    }

    require_once('./include/_connect.php');
    include_once('./send_message.php');
    include_once('./include/_execute.php');

    $date = date('Y-m-d');
    $userID = $_SESSION['userID'];

    $SQL = "INSERT INTO `Change_Request`(`Request_ID`, `Request_Name`, `Request_Date`, `Request_By`, `Priority`, `Request_Description`, `Cost_Adjustment`, `Time_Adjustment`, `Reviewed`, `Approved`, `ApprovalNotes`, `ApprovedBy`) VALUES (NULL,?,?,?,?,?,?,?,0,0,NULL,NULL)";
    
    $result = executeCommandNoResult($SQL, "sssssss", [$_POST['request_title'], date('Y-m-d'), $_SESSION['userID'], $_POST['request_priority'], $_POST['request_description'], $_POST['request_budget'], $_POST['request_time']]);

    if($result)
    {
        if(!sendMessageToTeamMembers("A new change request has been added. Please review it."))
        {
            DieWithStatus("Completed but failed to send message to team members, please get in contact with them if possible", 500);
        }
        DieWithStatus("Meeting added successfully", 200);
    }
    else
    {
        DieWithStatus("Failed to add change request", 500);
    }
    DieWithStatus("An Unknown Error has occured", 400);
}
DieWithStatus("Missing Form Information", 400);