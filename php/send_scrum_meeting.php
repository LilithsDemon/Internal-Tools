<?php

if(!isset($_SESSION))
{
    session_start();
}

require_once('./include/_bdie.php');

if(isset($_SESSION['userID'], $_POST['users'], $_POST['meeting_title'], $_POST['meeting_notes']))
{
    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    include_once('send_message.php');

    $SQL = "INSERT INTO `Scrum_Meeting`(`MeetingID`, `MeetingTitle`, `MeetingDate`, `MeetingNotes`) VALUES (null,?,?,?)";

    $result = executeCommandID($SQL, 'sss', [$_POST['meeting_title'], date('Y-m-d'), $_POST['meeting_notes']]);

    $meetingID = (string)$result;

    if($result)
    {
        $fail = false;
        $users = json_decode($_POST['users']);

        for($i = 0; $i < count($users); $i++)
        {
            $SQL = "INSERT INTO `Scrum_Attendees`(`AtendeeID`, `ScrumID`, `UserID`) VALUES (NULL, ?,?)";
            $result = executeCommandNoResult($SQL, 'ii', [$meetingID, $users[$i]]);
            if(!$result)
            {
                $fail = true;
                break;
            }
        }

        if($fail) DieWithStatus("Failed to add users to meeting", 500);

        if(!sendMessageToTeamMembers("A new Scrum Meeting has been completed. Please check the Scrum Meetings page for more information."))
        {
            DieWithStatus("Completed, however failed to send message to team members", 500);
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