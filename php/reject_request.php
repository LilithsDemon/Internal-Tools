<?php

if(isset($_POST['id']) && isset($_POST['notes']))
{
    include_once('./include/_connect.php');
    include_once('./include/_execute.php');
    include_once('./include/_bdie.php');

    $SQL = "SELECT * FROM `Change_Request` WHERE `Request_ID` = ?";
    $result = executeCommand($SQL, 'i', $_POST['id']);
    if($result->num_rows == 1)
    {
        $SQL = "UPDATE `Change_Request` SET `Reviewed` = 1, `Approved` = 0, `ApprovalNotes` = ?, `ApprovedBy` = ? WHERE `Request_ID` = ?";
        $result = executeCommand($SQL, 'sii', [$_POST['notes'], $_SESSION['id'], $_POST['id']]);
        DieWithStatus("Request Denied Successfully", 200);
    }
    else
    {
        DieWithStatus("Request not found!", 400);
    }
}
DieWithStatus("Invalid Request", 400);