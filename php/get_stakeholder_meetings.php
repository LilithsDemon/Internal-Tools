<?php
require_once('../include/_connect.php');
include_once('../include/_execute.php');
require_once('../include/_bdie.php');

$SQL = "SELECT * FROM `Stakeholder_Meeting` ORDER BY `Stakeholder_Meeting`.`MeetingDate` DESC;";

$result = executeCommandNoParams($SQL);

?>

<div class="d-flex flex-column overflow-scroll w-75">

    <?php

    if ($result) {
    ?>
        <div class="d-flex flex-column w-100 text-center justify-content-center gap-4 mt-2">
            <?php
            if ($result->num_rows == 0) {
            ?>
                <h1>Sorry, no meetings have been sat yet!</h1>
            <?php
            }
            while ($row = $result->fetch_assoc()) {
                // This needs finishing to work fully
                $data_id = $row['MeetingID'];
                echo "<div id='sh_meeting_view_btn' data-id='$data_id' class='card text-center' data-bs-toggle='modal' data-bs-target='#sh_meeting_view_modal'>";
            ?>
                <div class="card-header">
                    <?php echo $row['MeetingTitle'] ?>
                </div>
                <div class="card-body">
                    <p class="card-text"><?php echo str_replace(["\\n\\n", "\\n"], "<br>", $row['MeetingNotes']); ?></p>
                </div>
                <div class="card-footer text-body-secondary">
                    <?php echo $row['MeetingDate'] ?>
                </div>
        </div>
    <?php

            }

    ?>
</div>
</div>
<div class="modal fade" data-bs-backdrop="static" id="sh_meeting_view_modal" aria-labelledby="Modal form for creating a new change request" aria-hidden="true">
    <div id="sh_meeting_view_modal_inner" class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">

    </div>
</div>
<?php
    }
?>