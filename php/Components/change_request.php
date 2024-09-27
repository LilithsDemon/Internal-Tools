<?php
if(!isset($_SESSION)) {
    session_start();
}
?>

<div class="change_request d-flex flex-column w-75">
    <button type="button" class="btn button" id="add_button" onclick="loadDate()" data-bs-toggle="modal" data-bs-target="#change_request_modal">
        Create New Change Request
    </button>

    <div class="requests d-flex flex-column gap-2">
        <div class="card text-center request_card">
            <div class="card-header">
                Change Request Name
            </div>
            <div class="card-body">
                <p class="card-text">Change Request description</p>
            </div>
            <div class="card-footer text-body-secondary">
                2 days ago
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="change_request_modal" data-bs-backdrop="static" aria-labelledby="Modal form for creating a new change request" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Change Request Form</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="d-flex flex-column gap-4">
            <div class="d-flex gap-2">
                <input type="text" class="form-control" id="request_title" name="request_title" placeholder="Request Title..." required>
                <input type="date" class="form-control" id="prefilled_date" name="request_date" disabled>
            </div>
            <div class="d-flex flex-column gap-1">
                <label for="request_assigner">Request Made By:</label>
                <?php echo "<input type='text' class='form-control' id='request_assigner' name='request_assigner' value='" . $_SESSION['firstName'] . " " . $_SESSION['lastName'] . "' disabled>"; ?>
            </div>
            <div class="d-flex flex-column gap-1">
                <label for="request_priority"></label>
                <select class="form-select" id="request_priority" name="request_priority" required>
                    <option value="" selected disabled>Select Priority Level</option>
                    <option value="1">Low Priority</option>
                    <option value="2">Medium Priority</option>
                    <option value="3">High Priority</option>
                    <option value="4">Essential</option>
                </select>
            </div>
            <div class="d-flex">
                <textarea rows="4" class="form-control" id="request_description" name="request_description" placeholder="Request Description..." required></textarea>
            </div>
            <div class="d-flex flex-column gap-2">
                <input type="text" class="form-control" id="request_budget" placeholder="Cost Adjustment" required>
                <input type="text" class="form-control" id="request_time" placeholder="Time adjustment" required>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
        <button type="button" class="btn btn-primary">Send Request</button>
      </div>
    </div>
  </div>
</div>