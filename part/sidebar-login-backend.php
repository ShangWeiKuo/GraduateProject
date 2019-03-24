<aside id="left-sidebar-nav">
    <ul id="slide-out" class="side-nav fixed leftside-navigation ps-container ps-active-y" style="transform: translateX(0px);">
        

        <li class="no-padding">
            <ul class="collapsible" data-collapsible="accordion">
                <li class="user-details">
                    <div class="row">
                        <div class="col col s4 m4 l4">
                            <img src="./source/img/allpass.png" alt="" class="circle responsive-img valign profile-image cyan">
                        </div>
                        <div class="col col s8 m8 l8">
                            <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn"  data-activates="profile-dropdown-nav">
                                <?php  
                                    echo $_SESSION['account'] ;
                                ?>
                                <i class="mdi-navigation-arrow-drop-down right"></i>
                            </a>
                            <ul id="profile-dropdown-nav" class="dropdown-content" style="white-space: nowrap; position: absolute; top: 59px; left: 101.234px; display: none; opacity: 1;"></ul>
                        </div>
                    </div>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan" href="index.php">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">前台首頁</span>
                    </a>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan" href="backend-index.php">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">後台首頁</span>
                    </a>
                </li>
                <!--<li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan" href="backend-qanalysis.php">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">評論分析</span>
                    </a>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan" href="backend-mutual.php">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">相關影響分析</span>
                    </a>
                </li>-->
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan" href="backend-rank.php">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">留言分析 (<b>會員</b>)</span>
                    </a>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan" href="backend-mutual-dir.php">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">留言分析 (<b>課程向度</b>)</span>
                    </a>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan" href="backend-mutual.php">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">我的最愛分析</span>
                    </a>
                </li>
                <li class="bold">
                    <a href="./backend-member-page.php" class="waves-effect waves-cyan">
                        <i class="material-icons">face</i>
                        <span class="nav-text">管理員頁面</span>
                    </a>
                </li>
                <li class="bold">
                    <a href="./backend-member-timetable.php" class="waves-effect waves-cyan">
                        <i class="material-icons">favorite</i>
                        <span class="nav-text">我的最愛</span>
                    </a>
                </li>
                <li class="bold">
                    <a href="./function/do-logout.php" class="waves-effect waves-cyan">
                        <i class="material-icons">redo</i>
                        <span class="nav-text">登出</span>
                    </a>
                </li>
            </ul>
        </li>  

        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;">
            <div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div>
        </div>
        <div class="ps-scrollbar-y-rail" style="top: 0px; height: 889px; right: 3px;">
            <div class="ps-scrollbar-y" style="top: 0px; height: 615px;"></div>
        </div>
    </ul>
    <a href="https://pixinvent.com/materialize-material-design-admin-template/html/fixed-menu/index.html#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only">
        <i class="material-icons">menu</i>
    </a>
</aside>