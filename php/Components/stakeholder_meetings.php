<?php
if(!isset($_SESSION)) {
    session_start();
}
?>

<div class="change_request d-flex flex-column w-75">
    <?php
    if ($_SESSION['admin'] == 1) {
        ?>
        <button type="button" class="btn button" id="add_button" onclick="loadDate()" data-bs-toggle="modal" data-bs-target="#stakeholder_meeting_modal">
            Create New StakeHolder Meeting
        </button>
        <?php
    }
    ?>

    <div class="requests d-flex flex-column gap-2">
        <div class="card text-center request_card">
            <div class="card-header">
                Request Name
            </div>
            <div class="card-body">
                <p class="card-text">Request description</p>
            </div>
            <div class="card-footer text-body-secondary">
                2 days ago
            </div>
        </div>

    </div>
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
                    <form class="d-flex flex-column gap-4">
                        <div class="d-flex gap-2">
                            <input type="text" class="form-control" id="meeting_title" name="meeting_title"
                                placeholder="Meeting Title..." required>
                            <input type="date" class="form-control" id="prefilled_date" name="meeting_date" disabled>
                        </div>
                        <div class="d-flex">
                            <textarea rows="12" class="form-control" id="meeting_notes" name="meeting_notes"
                                placeholder="Meeting Notes..." required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-primary">Save Meeting</button>
                </div>
            </div>
        </div>
        <?php
}
?>
</div>