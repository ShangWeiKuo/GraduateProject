<aside id="left-sidebar-nav">
    <ul id="slide-out" class="side-nav fixed leftside-navigation ps-container ps-active-y" >
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

        <li class="no-padding">
            <ul class="collapsible" data-collapsible="accordion">
                <li class="bold">
                    <a href="./function/do-logout.php" class="waves-effect waves-cyan">
                        <i class="material-icons">redo</i>
                        <span class="nav-text">登出</span>
                    </a>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">核心通識</span>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="./class-list.php?ct=0">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>科學素養</span>
                                </a>
                            </li>
                            <li>
                                <a href="./class-list.php?ct=1">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>倫理素養</span>
                                </a>
                            </li>
                            <li>
                                <a href="./class-list.php?ct=2">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>思維方法</span>
                                </a>
                            </li>
                            <li>
                                <a href="./class-list.php?ct=3">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>美學素養</span>
                                </a>
                            </li>
                            <li>
                                <a href="./class-list.php?ct=4">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>公民素養</span>
                                </a>
                            </li>
                            <li>
                                <a href="./class-list.php?ct=5">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>文化素養</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">博雅通識</span>
                    </a>
                    <div class="collapsible-body" style="display: none;">
                        <ul>
                            <li>
                                <a href="./class-list.php?ct=6">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>人文科學</span>
                                </a>
                            </li>
                            <li>
                                <a href="./class-list.php?ct=7">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>自然科學</span>
                                </a>
                            </li>
                            <li>
                                <a href="./class-list.php?ct=8">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>社會科學</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold">
                    <a class="collapsible-header waves-effect waves-cyan">
                        <i class="material-icons">dashboard</i>
                        <span class="nav-text">共同必修</span>
                    </a>
                    <div class="collapsible-body" style="display: none;">
                        <ul>
                            <li>
                                <a href="./class-list.php?ct=9">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>中文</span>
                                </a>
                            </li>
                            <li>
                                <a href="./class-list.php?ct=10">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>英文</span>
                                </a>
                            </li>
                            <li>
                                <a href="./class-list.php?ct=11">
                                    <i class="material-icons">keyboard_arrow_right</i>
                                    <span>進階英文</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="bold">
                    <a href="./member-page.php" class="waves-effect waves-cyan">
                        <i class="material-icons">face</i>
                        <span class="nav-text">會員頁面</span>
                    </a>
                </li>
                <li class="bold">
                    <a href="./member-timetable.php" class="waves-effect waves-cyan">
                        <i class="material-icons">favorite</i>
                        <span class="nav-text">我的最愛</span>
                    </a>
                </li>
                <li class="bold">
                    <a href="javascript:alert('商品缺貨中！請稍候再試')" class="waves-effect waves-cyan">
                        <i class="material-icons">card_giftcard</i>
                        <span class="nav-text">積點兌換</span>
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