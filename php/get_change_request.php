<?php
require_once('./include/_connect.php');
include_once('./include/_execute.php');
require_once('./include/_bdie.php');

$SQL = "SELECT `Request_ID`, `Request_Name`, `Request_Description`, `Request_Date`, `Reviewed`, `Approved` FROM `Change_Request`";

$result = executeCommandNoParams($SQL);

if($result)
{
    while($row = $result->fetch_assoc())
    {
        // This needs finishing to work fully
        if($_SESSION['stakeholder'] == 1)
        {
            echo "<button class='card text-center request_card d-flex flex-column' data-bs-toggle='change_request_review_modal' onclick='change_request(" . $row['Request_ID'] .")>";
        ?>
        <?php
        }
        else
        {
            echo "<button class='card text-center request_card d-flex flex-column' data-bs-toggle='change_request_review_modal' onclick='change_request(" . $row['Request_ID'] .")>";
        }
        ?>
                <div class="card-header">
                    <?php echo $row['Request_Name'] ?> 
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo $row['Request_Description'] ?></p>
                </div>
                <?php
                if($row['Reviewed'] == 0)
                {
                    ?>
                        <button class="btn btn-warning">Not Reviewed</button>
                    <?php
                }
                else if($row['Approved'] == 1)
                {
                    ?>
                        <button class="btn btn-success">Approved</button>
                    <?php
                }
                else
                {
                    ?>
                        <button class="btn btn-danger">Rejected</button>
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

    <div class="modal fade" id="change_request_review_modal" data-bs-backdrop="static" aria-labelledby="Modal form for creating a new change request" aria-hidden="true">

    </div>
    <?php
}
else
{
    ?>
        <h1>Sorry, no change requests have been sent yet!</h1>
    <?php
}  
?>