<!-- BEGIN SIDEBAR -->
<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<?php
if ($_SESSION['account_type'] == 'se' || $_SESSION['account_type'] == 'ad' || $_SESSION['account_type'] == 'sa') {
    ?>
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"></div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

            <li class="nav-item start " style="margin-top: 0px;">
                <a href="/index.php" class="nav-link">
                    <i class="icon-home"></i>
                    <span class="title">Home</span>
                </a>

            </li>
            <li class="heading">
                <h3 class="uppercase">Navigation</h3>
            </li>
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-calendar"></i>
                    <span class="title">Date Pages</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="/pages/single.php?date_page=<?php echo date("d-m-Y") ?>" class="nav-link nav-toggle">
                            <i class="icon-calendar"></i>
                            <span class="title">Today's Date Page</span>
                        </a>
                    </li>
                    <?php
                    if ($_SESSION['account_type'] == 'se' || $_SESSION['account_type'] == 'ad' ) {
                        ?>
                        <li class="nav-item  ">
                            <a href="/pages/go_date_page.php" class="nav-link nav-toggle">
                                <i class="icon-docs"></i>
                                <span class="title">Select Date Page</span>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
            <?php
            if ($_SESSION['account_type'] == 'se' || $_SESSION['account_type'] == 'ad') {
                ?>
                <li class="nav-item  ">
                    <a href="/pages/add_student_db.php" class="nav-link nav-toggle">
                        <i class="icon-plus"></i>
                        <span class="title">Add/Edit Students</span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="/pages/periods.php" class="nav-link nav-toggle">
                        <i class="icon-note"></i>
                        <span class="title">Configure Periods</span>
                    </a>
                </li>
            <?php
            }
            ?>
            <li class="nav-item  ">
                <a href="/pages/view_student_hours.php" class="nav-link nav-toggle">
                    <i class="icon-hourglass"></i>
                    <span class="title">View Student Schedule</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/pages/find_null_logs.php" class="nav-link nav-toggle">
                    <i class="icon-clock"></i>
                    <span class="title">Empty End Times</span>
                </a>
            </li>
            <?php
            $active_period = get_active_period();
            if ($active_period['end_date'] > date("Y-m-d")) {
                $end_date = date("Y-m-d");

            } else {
                $end_date = $active_period['end_date'];
            }
            ?>
            <li class="nav-item  ">
                <a href="/pages/cumulative.php?cumulative_from=<?php echo $active_period['start_date']; ?>&cumulative_to=<?php echo $end_date ?>&period_id=<?php echo $active_period['id'] ?>"
                   class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">Cumulative Work Hours</span>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="/work_logs.php" class="nav-link nav-toggle">
                    <i class="icon-folder"></i>
                    <span class="title">View Student Work Logs</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-clock"></i>
                    <span class="title">History</span>
                    <span class="selected"></span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu">
                <?php
                if ($_SESSION['account_type'] == 'se' || $_SESSION['account_type'] == 'ad') {
                    ?>
                    <li class="nav-item  ">
                        <a href="/pages/history_indicator.php?history_from=<?php echo $active_period['start_date']; ?>&history_to=<?php echo $end_date ?>"
                           class="nav-link">
                            <i class="icon-note"></i>
                            <span class="title">Plus/Minus</span>
                        </a>
                    </li>
                <?php
                }
                ?>
                    <li class="nav-item  ">
                        <a href="/pages/history.php?history_from=<?php echo $active_period['start_date']; ?>&history_to=<?php echo $end_date ?>"
                           class="nav-link">
                            <i class="icon-folder"></i>
                            <span class="title">Work Logs</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
    <?php
}
    ?>