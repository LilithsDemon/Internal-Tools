<?php
require_once('../include/_connect.php');
include_once('../include/_execute.php');
require_once('../include/_bdie.php');

$SQL = "SELECT `Request_ID`, `Request_Name`, `Request_Description`, `Request_Date`, `Reviewed`, `Approved` FROM `Change_Request`";

$result = executeCommandNoParams($SQL);

?>

<div class="d-flex flex-column overflow-scroll w-75">

<?php

if ($result) {
    ?>
        <div class="d-flex flex-column w-100 text-center justify-content-center gap-4 mt-2">
    <?php
    if($result->num_rows == 0)
    {
        ?>
        <h1>Sorry, no change requests have been sent yet!</h1>
        <?php
    }
    while ($row = $result->fetch_assoc()) {
        // This needs finishing to work fully
        $data_id = $row['Request_ID'];
        echo "<div id='change_request_review_btn' data-id='$data_id' class='card text-center h-25 gap-2' data-bs-toggle='modal' data-bs-target='#change_request_review_modal'>";
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
                <div class="ms-2 me-2 align-self-center btn btn-warning">Not Reviewed</div>
            <?php
        } else if ($row['Approved'] == 1) {
            ?>
                <div class="ms-2 me-2 align-self-center btn btn-success">Approved</div>
            <?php
        } else {
            ?>
                <div class="ms-2 me-2 align-self-center btn btn-danger">Rejected</div>
            <?php
        }
        ?>
        <div class="card-footer text-body-secondary">
            <?php echo $row['Request_Date'] ?>
        </div>
    </div>
        <?php

    }

    ?>
    </div>

</div>
<div class="modal fade" data-bs-backdrop="static" id="change_request_review_modal" aria-labelledby="Modal form for creating a new change request" aria-hidden="true">
        <div id="change_request_review_modal_inner" class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

        </div>
    </div>
    <?php
}
?>