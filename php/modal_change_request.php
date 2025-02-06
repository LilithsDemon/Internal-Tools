<?php
if (isset($_GET['id'])) {
    if (!isset($_SESSION)) {
        session_start();
    }
    include_once('./include/_connect.php');
    include_once('./include/_execute.php');
    include_once('./include/_bdie.php');

    function getUsernameByID($id)
    {
        $SQL = "SELECT `Username` FROM `Users` WHERE `UserID` = ?";
        $result = executeCommand($SQL, "i", [$id]);
        if ($result) {
            $row = $result->fetch_assoc();
            return $row['Username'];
        }
    }

    $SQL = "SELECT * FROM `Change_Request` WHERE `Request_ID` = ?";
    $result = executeCommand($SQL, "i", [$_GET['id']]);
    if ($result) {
        $row = $result->fetch_assoc();
        if ($_SESSION['stakeholder'] == 1 && $row['Reviewed'] == 0) {
?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change_request_review_modal">Change Request Review</h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex gap-2">
                            <label class="mt-3 w-50" for="request_name">Request Name: </label>
                            <label class="mt-3 w-50" for="request_date">Request Date: </label>
                        </div>
                    </div>
                    <div class="d-flex flex-column mt-2 gap-4">
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" value=<?php echo '"' . $row['Request_Name'] . '"' ?> disabled>
                            <input type="date" class="form-control" value=<?php echo '"' . $row['Request_Date'] . '"' ?> disabled>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="request_assigner">Request Made By:</label>
                        <input type='text' class='form-control' value=<?php echo '"' . getUsernameByID($row['Request_By']) . '"' ?> disabled>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="request_assigner">Request Status/Approved By</label>
                        <input type='text' class='form-control' value="Sorry, this change request has not been reviewed yet: if you think it should have been looked at by now, please contact the team :)" disabled>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="request_priority">Request Priority:</label>
                        <select class="form-select" disabled>
                            <?php
                            switch ($row['Priority']) {
                                case 1:
                                    echo "<option value='' selected disabled>Low Priority</option>";
                                    break;
                                case 2:
                                    echo "<option value='' selected disabled>Medium Priority</option>";
                                    break;
                                case 3:
                                    echo "<option value='' selected disabled>High Priority</option>";
                                    break;
                                case 4:
                                    echo "<option value='' selected disabled>Essential</option>";
                                    break;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="request_description">Request Description:</label>
                        <textarea rows="4" class="form-control" disabled><?php echo str_replace(["\\n\\n", "\\n"], "<br>", $row['Request_Description']) ?></textarea>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="cost_adjustment">Cost Adjustment: </label>
                        <input type="text" class="form-control" value=<?php echo '"' . $row['Cost_Adjustment'] . '"' ?> disabled>
                        <label class="mt-3" for="time_adjustment">Time Adjustment:</label>
                        <input type="text" class="form-control" value=<?php echo '"' . $row['Time_Adjustment'] . '"' ?> disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_change_request_view" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        <?php
        }

        if ($_SESSION['stakeholder'] == 0 && $row['Reviewed'] == 0) {
        ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change_request_review_modal">Change Request Review</h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex gap-2">
                            <label class="mt-3 w-50" for="request_name">Request Name: </label>
                            <label class="mt-3 w-50" for="request_date">Request Date: </label>
                        </div>
                    </div>
                    <div class="d-flex flex-column mt-2 gap-4">
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" value=<?php echo '"' . $row['Request_Name'] . '"' ?> disabled>
                            <input type="date" class="form-control" value=<?php echo '"' . $row['Request_Date'] . '"' ?> disabled>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="request_assigner">Request Made By:</label>
                        <input type='text' class='form-control' value=<?php echo '"' . getUsernameByID($row['Request_By']) . '"' ?> disabled>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="request_priority">Priority Level: </label>
                        <select class="form-select" disabled>
                            <?php
                            switch ($row['Priority']) {
                                case 1:
                                    echo "<option value='' selected disabled>Low Priority</option>";
                                    break;
                                case 2:
                                    echo "<option value='' selected disabled>Medium Priority</option>";
                                    break;
                                case 3:
                                    echo "<option value='' selected disabled>High Priority</option>";
                                    break;
                                case 4:
                                    echo "<option value='' selected disabled>Essential</option>";
                                    break;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="request_description">Request Description:</label>
                        <textarea rows="4" class="form-control" disabled><?php echo str_replace(["\\n\\n", "\\n"], "<br>", $row['Request_Description']) ?></textarea>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="cost_adjustment">Cost Adjustment: </label>
                        <input type="text" class="form-control" value=<?php echo '"' . $row['Cost_Adjustment'] . '"' ?> disabled>
                        <label class="mt-3" for="time_adjustment">Time Adjustment:</label>
                        <input type="text" class="form-control" value=<?php echo '"' . $row['Time_Adjustment'] . '"' ?> disabled>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="review_notes">Review Notes:</label>
                        <textarea rows="4" class="form-control" id="review_notes" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_change_request_view" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="reject_request_btn" data-bs-dismiss="modal" class="btn btn-danger">Reject Request</button>
                    <button type="button" id="approve_request_btn" data-bs-dismiss="modal" class="btn button">Approve Request</button>
                </div>
            </div>
        <?php
        }
        if ($row['Reviewed'] == 1) {
        ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="change_request_review_modal">Change Request Review</h5>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column gap-4">
                        <div class="d-flex gap-2">
                            <label class="mt-3 w-50" for="request_name">Request Name: </label>
                            <label class="mt-3 w-50" for="request_date">Request Date: </label>
                        </div>
                    </div>
                    <div class="d-flex flex-column mt-2 gap-4">
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" value=<?php echo '"' . $row['Request_Name'] . '"' ?> disabled>
                            <input type="date" class="form-control" value=<?php echo '"' . $row['Request_Date'] . '"' ?> disabled>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="request_priority">Request Priority: </label>
                        <select class="form-select" disabled>
                            <?php
                            switch ($row['Priority']) {
                                case 1:
                                    echo "<option value='' selected disabled>Low Priority</option>";
                                    break;
                                case 2:
                                    echo "<option value='' selected disabled>Medium Priority</option>";
                                    break;
                                case 3:
                                    echo "<option value='' selected disabled>High Priority</option>";
                                    break;
                                case 4:
                                    echo "<option value='' selected disabled>Essential</option>";
                                    break;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="request_description">Request Description:</label>
                        <textarea rows="4" class="form-control" disabled><?php echo str_replace(["\\n\\n", "\\n"], "<br>", $row['Request_Description']) ?></textarea>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="cost_adjustment">Cost Adjustment: </label>
                        <input type="text" class="form-control" value=<?php echo '"' . $row['Cost_Adjustment'] . '"' ?> disabled>
                        <label class="mt-3" for="time_adjustment">Time Adjustment:</label>
                        <input type="text" class="form-control" value=<?php echo '"' . $row['Time_Adjustment'] . '"' ?> disabled>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3" for="request_description">Review Notes:</label>
                        <textarea rows="4" class="form-control" disabled><?php echo $row['ApprovalNotes'] ?></textarea>
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <label class="mt-3">Approval/Denial by</label>
                        <input type='text' class='form-control' value=<?php echo '"' . getUsernameByID($row['ApprovedBy']) . '"' ?> disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_change_request_view" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
<?php
        }
    }
}
?>