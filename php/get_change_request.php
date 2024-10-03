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
    /* New idea for how the modal will work
    When pressing on a button it will call a function that will pass the ID of the request to the modal
    The modal will then use the ID to get the correct data and put it into the modal using load like doing with main
    */
}
else
{
    ?>
        <h1>Sorry, no  have been found yet!</h1>
    <?php
}  
?>