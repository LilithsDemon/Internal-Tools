<?php
    if(isset($_GET['id']))
    {
        include_once('./include/_connect.php');
        include_once('./include/_execute.php');
        include_once('./include/_bdie.php');

        function getUsernameByID($id)
        {
            $SQL = "SELECT `Username` FROM `Users` WHERE `UserID` = ?";
            $result = executeCommand($SQL, "i", [$id]);
            if($result)
            {
                $row = $result->fetch_assoc();
                return $row['Username'];
            }
        }

        $SQL = "SELECT * FROM `Change_Request` WHERE `Request_ID` = ?";
        $result = executeCommand($SQL, "i", [$_GET['id']]);
        if($result)
        {
            $row = $result->fetch_assoc();
            if($_SESSION['stakeholder'] == 1 && $row['Reviewed'] == 0)
            {
                ?>
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="change_request_review_modal">Change Request Review</h5>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex flex-column gap-4">
                                <div class="d-flex gap-2">
                                    <input type="text" class="form-control" value=<?php echo '"' . $row['Request_Name'] . '"'?> disabled>
                                    <input type="date" class="form-control" value=<?php echo '"' . $row['Request_Date'] . '"'?> disabled>
                                </div>
                            </div>
                            <div class="d-flex flex-column gap-4">
                                <label for="request_assigner">Request Made By:</label>
                                <input type='text' class='form-control' value=<?php echo '"' . getUsernameByID($row['Request_By']) . '"'?> disabled>
                            </div>
                            <div class="d-flex flex-column gap-4">
                                <label for="request_assigner">Request Approved By</label>
                                <input type='text' class='form-control' value="Sorry, this change request has not been approved yet: if you think it should have been approved by now, please contact the team :)" disabled>
                            </div>
                            <div class="d-flex flex-column gap-1">
                                <label for="request_priority"></label>
                                <select class="form-select" disabled>
                                    <?php 
                                        switch($row['Request_Priority'])
                                        {
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
                            <div class="d-flex">
                                <textarea rows="4" class="form-control" value=<?php echo '"' . $row['Request_Description'] . '"'?> disabled></textarea>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <input type="text" class="form-control" value=<?php echo '"' . $row['Cost_Adjustment'] . '"'?> required>
                                <input type="text" class="form-control" value=<?php echo '"' . $row['Time_Adjustment'] . '"'?> required>
                            </div>
                        </div>    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
                <?php
            }

            if($_SESSION['stakeholder'] == 0 && $row['Reviewed'] == 0)
            {
                ?>
                    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="change_request_review_modal">Change Request Review</h5>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-column gap-4">
                                    <div class="d-flex gap-2">
                                        <input type="text" class="form-control" value=<?php echo '"' . $row['Request_Name'] . '"'?> disabled>
                                        <input type="date" class="form-control" value=<?php echo '"' . $row['Request_Date'] . '"'?> disabled>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-4">
                                    <label for="request_assigner">Request Made By:</label>
                                    <input type='text' class='form-control' value=<?php echo '"' . getUsernameByID($row['Request_By']) . '"'?> disabled>
                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <label for="request_priority"></label>
                                    <select class="form-select" disabled>
                                        <?php 
                                            switch($row['Request_Priority'])
                                            {
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
                                <div class="d-flex">
                                    <textarea rows="4" class="form-control" value=<?php echo '"' . $row['Request_Description'] . '"'?> disabled></textarea>
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <input type="text" class="form-control" value=<?php echo '"' . $row['Cost_Adjustment'] . '"'?> disabled>
                                    <input type="text" class="form-control" value=<?php echo '"' . $row['Time_Adjustment'] . '"'?> disabled>
                                </div>
                                <div class="d-flex">
                                    <textarea rows="4" class="form-control" id="review_notes" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="approve_request_btn" class="btn button">Approve Request</button>
                                <button type="button" id="reject_request_btn" class="btn btn-danger">Reject Request</button>
                            </div>
                        </div>
                    </div>
                <?php
            }
            if($row['Reviewed'] == 1)
            {
                ?>
                   <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="change_request_review_modal">Change Request Review</h5>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex flex-column gap-4">
                                    <div class="d-flex gap-2">
                                        <input type="text" class="form-control" value=<?php echo '"' . $row['Request_Name'] . '"'?> disabled>
                                        <input type="date" class="form-control" value=<?php echo '"' . $row['Request_Date'] . '"'?> disabled>
                                    </div>
                                </div>
                                <div class="d-flex flex-column gap-4">
                                    <label for="request_assigner">Request Made By:</label>
                                    <input type='text' class='form-control' value=<?php echo '"' . getUsernameByID($row['Request_By']) . '"'?> disabled>
                                </div>
                                <div class="d-flex flex-column gap-1">
                                    <label for="request_priority"></label>
                                    <select class="form-select" disabled>
                                        <?php 
                                            switch($row['Request_Priority'])
                                            {
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
                                <div class="d-flex">
                                    <textarea rows="4" class="form-control" value=<?php echo '"' . $row['Request_Description'] . '"'?> disabled></textarea>
                                </div>
                                <div class="d-flex flex-column gap-2">
                                    <input type="text" class="form-control" value=<?php echo '"' . $row['Cost_Adjustment'] . '"'?> disabled>
                                    <input type="text" class="form-control" value=<?php echo '"' . $row['Time_Adjustment'] . '"'?> disabled>
                                </div>
                                <div class="d-flex" id="review_notes">
                                    <textarea rows="4" class="form-control" value=<?php echo '"' . $row['ApprovalNotes'] ?>disabled></textarea>
                                </div>
                                <div class="d-flex flex-column gap-4">
                                    <label>Approval/Denial by</label>
                                    <input type='text' class='form-control' value=<?php echo '"' . getUsernameByID($row['ApprovedBy']) . '"'?> disabled>
                                </div>
                                <div class="d-flex flex-column gap-4">
                                    <label>Approval Status</label>
                                    <?php
                                    if($row['Approved'] == 1)
                                    {
                                        ?>
                                        <input type='text' class='form-control' value="Approved" disabled>
                                    <?php 
                                    }
                                    else
                                    {
                                        ?>
                                        <input type='text' class='form-control' value="Denied" disabled>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                <?php
            }
        }
        else
        {
            ?>
                <h1>Sorry, no change requests have been sent yet!</h1>
            <?php
        }
    }
?>