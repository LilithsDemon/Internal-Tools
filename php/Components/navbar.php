<header class="header" id="header">
    <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
</header>
<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div>
            <a href="#" class="nav_logo">
                <img src="./assets/logo.png" class="nav_img" alt="LilithsDemon Logo" height=32 width=32>
                <span class="nav_logo-name">LilithsDevs</span>
            </a>
            <div class="nav_list">
                <a id="dashboard_page" href="#" class="nav_link">
                    <i class='bx bx-grid-alt nav_icon'> </i>
                    <span class="nav_name">Dashboard</span>
                </a>
                <?php
                if ($_SESSION['stakeholder'] == 0 || $_SESSION['admin'] == 1) {
                ?>
                    <a id="scrum_meetings" href="#" class="nav_link">
                        <i class='bx bx-chalkboard nav_icon'> </i>
                        <span class="nav_name">Scrum Meetings</span>
                    </a>
                <?php } ?>
                <a id="stakeholder_meetings" href="#" class="nav_link">
                    <i class='bx bx-group nav_icon'> </i>
                    <span class="nav_name">Stakeholder Meetings</span>
                </a>
                <a id="change_request" href="#" class="nav_link">
                    <i class='bx bx-notepad nav_icon'> </i>
                    <span class="nav_name">Change Requests</span>
                </a>
                <?php
                if ($_SESSION['stakeholder'] == 0 || $_SESSION['admin'] == 1) {
                ?>
                    <a id="raid" href="#" class="nav_link">
                        <i class='bx bx-notepad nav_icon'> </i>
                        <span class="nav_name">RAID Analysis</span>
                    </a>
                <?php } ?>
                <a id="messages" href="#" class="nav_link">
                    <i class='bx bx-message-square-detail nav_icon'></i>
                    <span class="nav_name">Messages</span>
                </a>
                <a href="#" class="nav_link" data-bs-toggle="modal" data-bs-target="#settings_modal">
                    <i class='bx bx-cog nav_icon'></i>
                    <span class="nav_name">Settings</span>
                </a>
            </div>
        </div>
        <a href="./php/logout.php" class="nav_link">
            <i class='bx bx-log-out nav_icon'></i>
            <span class="nav_name">Sign Out</span> </a>
    </nav>
</div>