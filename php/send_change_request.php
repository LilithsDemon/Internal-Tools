<?php

if(isset($_POST['request_title']) && isset($_POST['request_priority']) && isset($_POST['request_description']) && isset($_POST['request_budget']) && isset($_POST['request_time'])) {
    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    require_once('./include/_bdie.php');
    include_once('send_message.php');

    $request_title = $_POST['request_title'];
    $request_priority = $_POST['request_priority'];
    $request_description = $_POST['request_description'];
    $request_budget = $_POST['request_budget'];
    $request_time = $_POST['request_time'];

    $SQL = "INSERT INTO `Change_Request`(`Request_ID`, `Request_Name`, `Request_Date`, `Request_By`, `Priority`, `Request_Description`, `Cost_Adjustment`, `Time_Adjustment`, `Approved`, `ApprovedBy`) VALUES (null,?,?,?,?,?,?,?,0,null)";

    $result = executeCommand($conn, $SQL, 'ssssss', $_POST['request_title'], date('Y-m-d'), $_SESSION['userID'], $_POST['request_priority'], $_POST['request_description'], $_POST['request_budget'], $_POST['request_time']);

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
        DieWithStatus("Failed to add meeting", 500);
    }
}
else
{
    DieWithStatus("Missing Form Information", 400);
}