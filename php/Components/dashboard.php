<?php
if(!isset($_SESSION)) {
    session_start();
}
?>
<div class = "dashboard d-flex flex-column overflow-scroll w-75">
    <div class = "messages">
        <div class="card">
            <div class="card-header">
                Messages
            </div>
            <div class="card-body d-flex flex-column m-0 p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Change Request "Add additional menu to group" has been approved go to change requests to see notes</li>
                    <li class="list-group-item">A second message</li>
                    <li class="list-group-item">A third message</li>
                </ul>
            </div>
        </div>
    </div>
    <div class = "tasks">
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