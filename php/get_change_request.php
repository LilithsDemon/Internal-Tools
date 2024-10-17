<?php
require_once('../include/_connect.php');
include_once('../include/_execute.php');
require_once('../include/_bdie.php');

$SQL = "SELECT `Request_ID`, `Request_Name`, `Request_Description`, `Request_Date`, `Reviewed`, `Approved` FROM `Change_Request`";

$result = executeCommandNoParams($SQL);

if ($result) {
    ?>
        <div class="d-flex w-100 text-center justify-content-center flex-wrap gap-4 mt-2">
    <?php
    if($result->num_rows == 0)
    {
        ?>
        <h1>Sorry, no change requests have been sent yet!</h1>
        <?php
    }
    while ($row = $result->fetch_assoc()) {
        // This needs finishing to work fully
        if ($_SESSION['stakeholder'] == 1) {
            echo "<button class='card text-center h-25 gap-2 request_card d-flex flex-column' data-bs-toggle='change_request_review_modal' onclick='change_request(" . $row['Request_ID'] . ")'>";
        ?>
        <?php
        } else {
            echo "<button class='card text-center h-25 gap-2 request_card d-flex flex-column' data-bs-toggle='change_request_review_modal' onclick='change_request(" . $row['Request_ID'] . ")'>";
        }
        ?>
        <div class="card-header">
            <?php echo $row['Request_Name'] ?>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo $row['Request_Description'] ?></p>
        </div>
        <?php
        if ($row['Reviewed'] == 0) {
            ?>
                <div class="w-25 align-self-center btn btn-warning">Not Reviewed</div>
            <?php
        } else if ($row['Approved'] == 1) {
            ?>
                <div class="w-25 align-self-center btn btn-success">Approved</div>
            <?php
        } else {
            ?>
                <div class="w-25 align-self-center btn btn-danger">Rejected</div>
            <?php
        }
        ?>
        <div class="card-footer text-body-secondary">
            <?php echo $row['Request_Date'] ?>
        </div>
        </button>
        <?php

    }

    ?>
    </div>

    <div class="modal fade" id="change_request_review_modal" data-bs-backdrop="static"
        aria-labelledby="Modal form for creating a new change request" aria-hidden="true">

    </div>
    <?php
}
?>