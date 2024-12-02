<?php
if(!isset($_SESSION)) {
    session_start();
}
require_once('./php/include/_connect.php');
include_once('./php/include/_execute.php');
require_once('./php/include/_bdie.php');
?>
<div class = "dashboard d-flex flex-column overflow-scroll w-75">
    <div class = "messages">
        <div class="card">
            <div class="card-header">
                Messages
            </div>
            <div class="card-body d-flex flex-column m-0 p-0">
                <ul class="list-group list-group-flush">
                    <?php 
                    $SQL = "SELECT `Message`, `Date` FROM `Messages` WHERE `UserID` = ? LIMIT 3";
                    $result = executeCommand($SQL, "i", [$_SESSION['userID']]);
                    if($result)
                    {
                        while($row = $result->fetch_assoc())
                        {
                            echo "<li class='list-group-item'>" . $row['Message'] . "</li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class = "tasks d-flex">
        <?php if($_SESSION['admin'] == 1) { ?>
            <div class="card scrum_meetings">
                <div class="card-header">
                    Scrum Meetings    
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="card-text">Record Scrum Meetings to find out what parts of the projects each developer is doing and estimated time scales for project</p>
                    <a href="#" onclick="loadPage('scrum_meetings')" class="btn mt-auto button">Go to Scrum Meetings</a>
                </div>
            </div>
        <?php } ?>
        <div class="card stakeholder_meetings">
            <div class="card-header">
                Stakeholder Meetings
            </div>
            <div class="card-body d-flex flex-column">
                <p class="card-text">Record Stakeholder Meetings to ensure all talking points are recorded</p>
                <a href="#" onclick="loadPage('stakeholder_meetings')" class="btn mt-auto button">Go to Stakeholder Meetings</a>
            </div>
        </div>
        <div class="card change_requests">
            <div class="card-header">
                Change Requests
            </div>
            <div class="card-body d-flex flex-column">
                <p class="card-text">Make or check change requests from stakeholders</p>
                <a href="#" onclick="loadPage('change_request')" class="btn mt-auto button">Go to Change Requests</a>
            </div>
        </div>
    </div>
</div>