<?php
require_once('./include/_connect.php');
include_once('./include/_execute.php');
require_once('./include/_bdie.php');

$SQL = "SELECT `Request_ID`, `Request_Name`, `Request_Description`, `Request_Date` FROM `Change_Request`";

$result = executeCommandNoParams($SQL);

if($result)
{
    while($row = $result->fetch_assoc())
    {
        // This needs finishing to work fully
        if($_SESSION['stakeholder'] == 1)
        {
            echo "<button class='card text-center request_card' data-bs-toggle='request_approval_modal' onclick='stakeholder_request_modal(" . $row['Request_ID'] .")>";
        ?>
        <?php
        }
        else
        {
            echo "<button class='card text-center request_card' data-bs-toggle='request_approval_modal' onclick='team_request_modal(" . $row['Request_ID'] .")>";
        }
        ?>
                <div class="card-header">
                    <?php echo $row['Request_Name'] ?> 
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $row['Request_Description'] ?></p>
                </div>
                <div class="card-footer text-body-secondary">
                    <?php echo $row['Request_Date'] ?>
                </div>
            </button>
        <?php

    }

    ?>
        <div class="modal fade" id="request_approval_modal" aria-labelledby="Modal form for looking at change request" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center">
                        <button class="btn button" data-bs-target="#create_user_modal" data-bs-toggle="modal">Create new button</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <?php
}
else
{
    ?>
        <h1>Sorry, no  have been found yet!</h1>
    <?php
}  
?>