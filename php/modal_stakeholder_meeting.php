<?php
    if(isset($_GET['id']))
    {
        if(!isset($_SESSION)) {
            session_start();
        }
        include_once('./include/_connect.php');
        include_once('./include/_execute.php');

        $SQL = "SELECT * FROM `Stakeholder_Meeting` WHERE `MeetingID` = ?";
        $result = executeCommand($SQL, "i", [$_GET['id']]);
        if($result)
        {
            $row = $result->fetch_assoc();
            ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Stakeholder Meeting</h5>
                </div>
                <div class="modal-body">
                    <div class = "d-flex flex-column gap-4">
                        <div class="d-flex gap-2">
                            <label class="mt-3 w-50" for="meeting_title">Meeting Title: </label>
                            <label class="mt-3 w-50" for="meeting_date">Meeting Date: </label>
                        </div>
                    </div>
                    <div class="d-flex flex-column mt-2 gap-4">
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" value=<?php echo '"' . $row['MeetingTitle'] . '"'?> disabled>
                            <input type="date" class="form-control" value=<?php echo '"' . $row['MeetingDate'] . '"'?> disabled>
                        </div>
                    </div>
                    <div class="d-flex flex-row flex-overflow-wrap gap-4">
                        <?php
                            $SQL = "SELECT `UserID`, `FirstName`, `LastName` FROM `Users` WHERE `Stakeholder` = 0";
                            $result = executeCommandNoParams($SQL);
                            if ($result) {
                                while ($users = $result->fetch_assoc()) {
                                    ?>
                                    <div class="d-flex gap-2">
                                        <?php
                                            $SQL = "SELECT `AtendeeID` FROM `Stakeholder_Atendees` WHERE `StakeholderID` = ? AND `UserID` = ?";
                                            $attendees = executeCommand($SQL, "ii", [$_GET['id'], $users['UserID']]);
                                            if($attendees->num_rows > 0)
                                            {
                                                echo "<input class='form-check-input' name='type' data-id='" . $users['UserID'] . "' type='checkbox' value='' checked disabled>";
                                            }
                                            else
                                            {
                                                echo "<input class='form-check-input' name='type' data-id='" . $users['UserID'] . "' type='checkbox' value='' disabled>";
                                            }
                                            echo '<label class="form-check-label">' . $users['FirstName'] . ' ' . $users['LastName'] . '</label>';
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <div class="d-flex">
                        <textarea rows="12" class="form-control" disabled><?php echo $row['MeetingNotes'] ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" id="close_sh_meeting_view" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
                <?php
                // Add the rest of the form need to get attendees and then notes
        }
    }
?>