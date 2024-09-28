<?php

function getMessages($UserID)
{
    require_once('./include/_connect.php');
    include_once('./include/_execute.php');
    require_once('./include/_bdie.php');

    $SQL = "SELECT `Message`, `Date` FROM `Messages` WHERE `UserID` = ?";
    $result = executeCommand($SQL, 'i', $UserID);

    if($result)
    {
        while($row = $result->fetch_assoc())
        {
            ?>
                <div class="card text-center request_card">
                    <div class="card-body">
                        <p class="card-text"><?php echo $row['Message'] ?></p>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <?php echo $row['Date'] ?>
                    </div>
                </div>
            <?php
        }
    }
    else
    {
        ?>
            <h1>Sorry, no messages have been found yet!</h1>
        <?php
    }
}