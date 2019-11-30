<?php
    $url = explode("/", $_SERVER['REQUEST_URI']);
    $req = end($url);
    $sidebar_parts_array = [
        "students" => [
            "icon" => "people",
            "title" => "生徒管理"
        ],
        "attend" => [
            "icon" => "group",
            "title" => "入退室管理"
        ],
        "accepting" => [
            "icon" => "book",
            "title" => "受付モード"
        ]
    ];
?>
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="<?php echo base_url('assets/cms/images/user.png') ?>" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div id="account_name" class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></div>
            <div id="account_email" class="email"></div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li><a href="//animarl.com/login/logout"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <?php foreach ($sidebar_parts_array as $sidebar_url => $sidebar_parts): ?>
                <?php echo $req === $sidebar_url? '<li class="active">': '<li>'; ?>
                <?php if ($sidebar_url === "accepting"):?>
                    <a href="javascript:void(window.open('http://localhost/tech_isys/attend/accepting', 'new', 'top=100, left=100, width=500,height=500z,menubar=no, toolbar=no, scrollbars=yes'));">
                <?php else: ?>
                    <a href="<?php echo base_url($sidebar_url); ?>">
                <?php endif; ?>
                    <i class="material-icons"><?php echo $sidebar_parts["icon"] ?></i>
                    <span><?php echo $sidebar_parts["title"] ?></span>
                </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->