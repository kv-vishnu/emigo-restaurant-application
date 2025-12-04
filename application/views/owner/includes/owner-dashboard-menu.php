<div class="welcome-section container container-fluid mt-3 mb-2">
    <span>Welcome, <?= $display_name; ?>(<?= $role; ?>!)</span>
</div>
<div class="application-navigation container">
    <ul class="application-navigation__ul">
        <li class="application-navigation__li">
            <a href="<?php echo base_url('owner/dashboard'); ?>"
                class="application-navigation__a <?php echo ($controller == 'dashboard') ? 'application-navigation__a--active' : ''; ?>">Dashboard</a>
        </li>
        <li class="application-navigation__li">
            <a href="<?php echo base_url('owner/product/index/0'); ?>"
                class="application-navigation__a <?php echo ($controller == 'product') ? 'application-navigation__a--active' : ''; ?>">Dishes
                Catalog</a>
        </li>
        <li class="application-navigation__li">
            <a href="<?php echo base_url('owner/order'); ?>"
                class="application-navigation__a <?php echo ($controller == 'order') ? 'application-navigation__a--active' : ''; ?>">Order
                Monitor</a>
        </li>

        <li class="application-navigation__li">
            <a href="<?php echo base_url('owner/reports'); ?>"
                class="application-navigation__a <?php echo ($controller == 'reports') ? 'application-navigation__a--active' : ''; ?>">Reports</a>
        </li>
        <li class="application-navigation__li">
            <a href="<?php echo base_url('owner/settings'); ?>"
                class="application-navigation__a <?php echo ($controller == 'settings') ? 'application-navigation__a--active' : ''; ?>">Settings</a>
        </li>

        <li class="application-navigation__li">
            <a href="<?php echo base_url('owner/support'); ?>"
                class="application-navigation__a <?php echo ($controller == 'support') ? 'application-navigation__a--active' : ''; ?>">Support</a>
        </li>
       
        <li class="application-navigation__li">
            <a href="<?php echo base_url('admin/login/logout'); ?>" class="application-navigation__a">Logout</a>
        </li>
    </ul>
</div>