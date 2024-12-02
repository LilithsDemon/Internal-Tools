<?php

if(!isset($_SESSION)) {
    session_start();
}

require_once('./include/_bdie.php');

if(isset($_POST['id'], $_SESSION['userID'], $_POST['notes']))
{
    require_once('./include/_connect.php');
    include_once('./send_message.php');
    include_once('./include/_execute.php');

    $SQL = "SELECT * FROM `Change_Request` WHERE `Request_ID` = ?";
    $result = executeCommand($SQL, 'i', [$_POST['id']]);
    if($result->num_rows == 1)
    {
        $data_for_change_request = $result->fetch_assoc();
        $SQL = "UPDATE `Change_Request` SET `Reviewed` = 1, `Approved` = 1, `ApprovalNotes` = ?, `ApprovedBy` = ? WHERE `Request_ID` = ?";
        $result = executeCommand($SQL, 'sii', [$_POST['notes'], $_SESSION['userID'], $_POST['id']]);
        if(!sendMessageTo($data_for_change_request['Request_By'], "Your change request has been denied. Please check the request for more information"))
        {
            DieWithStatus("Request Denied successfully but failed to send message to user", 500);
        }
        DieWithStatus("Request Denied Successfully", 200);
    }
    else
    {
        DieWithStatus("Request not found!", 400);
    }
}
DieWithStatus("Invalid Request", 400);