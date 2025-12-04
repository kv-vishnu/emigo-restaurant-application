<!-- end page title -->
<div class="welcome-section container container-fluid mt-3 mb-2">
    <span>Welcome, <?= $display_name; ?>(<?= $role; ?>!)</span>
</div>
<div class="application-navigation container">
    <ul class="application-navigation__ul">

        <li class="application-navigation__li">
            <a href="<?php echo base_url('supplier/order'); ?>"
                class="application-navigation__a <?php echo ($controller == 'order') ? 'application-navigation__a--active' : ''; ?>">Order
                Monitor</a>
        </li>
        <li class="application-navigation__li">
            <a href="<?php echo base_url('supplier/reports/supplier_reports'); ?>"
                class="application-navigation__a <?php echo ($controller == 'reports') ? 'application-navigation__a--active' : ''; ?>">Reports</a>
        </li>
        <li class="application-navigation__li">
            <a href="<?php echo base_url('admin/login/logout'); ?>" class="application-navigation__a">Logout</a>
        </li>
    </ul>
</div>