<?php

if(isset($_POST['request_title']) && isset($_POST['request_priority']) && isset($_POST['request_description']) && isset($_POST['request_budget']) && isset($_POST['request_time'])) {

    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    require_once('./include/_bdie.php');

    $SQL = "SELECT `Request_ID`, `Request_Name`, `Request_Description`, `Request_Date` FROM `Change_Request`";

    $result = executeCommandNoParams($conn, $SQL);

    if($result)
    {
        while($row = $result->fetch_assoc())
        {
            // This needs finishing to work fully
            ?>
                <div class="card text-center request_card">
                    <div class="card-header">
                        <?php echo $row['Request_Name'] ?> 
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php echo $row['Request_Description'] ?></p>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <?php echo $row['Request_Date'] ?>
                    </div>
                </div>
            <?php
        }
    }
    else
    {
        ?>
            <h1>Sorry, no  have been found yet!</h1>
        <?php
    }  
}
else
{
    ?>
        <h1>Sorry, there was an error</h1>
    <?php
}