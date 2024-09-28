<?php

if(isset($_POST['meeting_title']) && isset($_POST['meeting_notes']))
{
    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    require_once('./include/_bdie.php');
    include_once('send_message.php');

    $SQL = "INSERT INTO `Stakeholder_Meeting`(`MeetingID`, `MeetingTitle`, `MeetingDate`, `MeetingNotes`, `Atendees`) VALUES (null,?,?,?,null)";

    $result = executeCommand($SQL, 'sss', array($_POST['meeting_title'], date('Y-m-d'), $_POST['meeting_notes']));

    //Update with attendees soon

    if($result)
    {
        if(!sendMessageToEveryone("A new stakeholder meeting has been added. Please feel free to review it."))
        {
            DieWithStatus("Completed but failed to send message", 500);
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
    DieWithStatus("Missing Form information", 400);
}