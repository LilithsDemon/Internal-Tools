<?php

require_once('./include/_bdie.php');

if(isset($_POST['request_title']) && isset($_POST['request_priority']) && isset($_POST['request_description']) && isset($_POST['request_budget']) && isset($_POST['request_time'])) {

    require_once('./include/_connect.php');
    include('./send_message.php');
    include('./include/_execute.php');

    $date = date('Y-m-d');

    $SQL = "INSERT INTO `Change_Request`(`Request_ID`, `Request_Name`, `Request_Date`, `Request_By`, `Priority`, `Request_Description`, `Cost_Adjustment`, `Time_Adjustment`, `Reviewed`, `Approved`, `ApprovalNotes`, `ApprovedBy`) VALUES (NULL,?,?,?,?,?,?,?,0,0,NULL,NULL)";

    $result = executeCommand($SQL, 'ssissss', [$_POST['request_title'], $date, $_SESSION['userID'], $_POST['request_priority'], $_POST['request_description'], $_POST['request_budget'], $_POST['request_time']]);

    DieWithStatus("Test", 400);

    if($result != false)
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
}
else
{
    DieWithStatus("Missing Form Information", 400);
}