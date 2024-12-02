<?php
if(!isset($_SESSION)) {
    session_start();
}

include_once('../get_stakeholder_meetings.php');

?>

<div class="change_request">
    <?php
    if ($_SESSION['admin'] == 1 && $_SESSION['stakeholder'] == 0) {
        ?>
        <button type="button" class="btn button" id="add_button" data-bs-toggle="modal" data-bs-target="#stakeholder_meeting_modal">
            Create New StakeHolder Meeting
        </button>
    <?php
    }
    ?>
</div>

<?php
if ($_SESSION['admin'] == 1) {
    ?>
    <div class="modal fade" id="stakeholder_meeting_modal" data-bs-backdrop="static"
        aria-labelledby="Modal form for creating a new stakeholder meeting" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">StakeHolder Meeting</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="sh_form" class="d-flex flex-column gap-4">
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" id="meeting_title" name="meeting_title"
                                placeholder="Meeting Title..." required>
                            <input type="date" class="form-control" id="prefilled_date" name="meeting_date" disabled>
                        </div>
                        <div class="d-flex flex-row flex-overflow-wrap gap-4 members">
                            <?php
                                $SQL = "SELECT `UserID`, `FirstName`, `LastName` FROM `Users` WHERE `Stakeholder` = 0";
                                $result = executeCommandNoParams($SQL);
                                if ($result) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <div class="d-flex gap-2">
                                            <?php
                                                  echo "<input class='form-check-input' name='type' data-id='" . $row['UserID'] . "' type='checkbox' value=''>";
                                                  echo '<label class="form-check-label">' . $row['FirstName'] . ' ' . $row['LastName'] . '</label>';
                                            ?>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                        </div>
                        <div class="d-flex">
                            <textarea rows="12" class="form-control" id="meeting_notes" name="meeting_notes"
                                placeholder="Meeting Notes..." required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    <button type="button" id="save_sh_btn" class="btn btn-primary" data-bs-dismiss="modal">Save Meeting</button>
                </div>
            </div>
        </div>
        <?php
}
?>
</div>