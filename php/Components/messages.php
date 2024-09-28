<?php
    session_start();
    require_once('../get_messages.php');
?>

<div class="change_request d-flex flex-column w-75">
    <div class="requests d-flex flex-column gap-2">
        <?php
            getMessages($_SESSION['UserID']);
        ?>
    </div>
</div>
</div>