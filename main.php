<?php

session_start();

require_once("./php/include/_connect.php");

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "Blank";
}

if (!isset($_SESSION['auth'])) {
    $_SESSION['auth'] = false;
    header("Location: index.php");
}

if ($_SESSION['auth'] == false) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html data-bs-theme="dark" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LD CPM InternalTools</title>
    <link rel="icon" type="image/x-icon" href="/assets/logo.ico">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="js/navbar.js"></script>
    <link rel="stylesheet" href="main.css">
</head>

<body id="body-pd">
    <?php
    include("./php/Components/navbar.php");
    ?>
    <!--Container Main end-->
    <main id="main_container d-flex">
        <?php
        include("./php/Components/dashboard.php");
        ?>
    </main>

    <?php
    if ($_SESSION['admin'] == 1) {
        ?>
        <div class="modal fade" id="settings_modal" aria-labelledby="Modal form for changing settings" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Settings</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center">
                        <button class="btn button" data-bs-target="#create_user_modal" data-bs-toggle="modal">Create new
                            user</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="create_user_modal" aria-labelledby="Modal form for changing settings"
            aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create User</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center">
                        <form class="d-flex flex-column gap-4">
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control" id="user_name" name="user_title"
                                    placeholder="Username..." required>
                            </div>
                            <div class="d-flex gap-2">
                                <input type="text" class="form-control" id="user_first_name" name="user_first_name"
                                    placeholder="First Name..." required>
                                <input type="text" class="form-control" id="user_last_name" name="user_last_name"
                                    placeholder="Last Name..." required>
                            </div>
                            <div class="d-flex flex-column gap-2">
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="stakeholder" name="stakeholder">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Stakeholder?
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input" type="checkbox" value="" id="admin" name="admin">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Admin?
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                        <button type="button" class="btn btn-primary">Create User</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>

</body>
<script src="js/main.js"></script>

</html>