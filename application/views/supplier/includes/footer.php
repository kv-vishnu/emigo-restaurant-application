<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-body text-success fw-bold"></div>
        </div>
    </div>
</div>
<!-- success modal -->


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-body">
                <input type="hidden" id="delete_id">
                <p id="delete_message">Are you sure you want to delete this item?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">No</button>
                <button class="btn btn-danger" id="confirmDeleteBtn" type="button">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<!-- Enable Confirmation Modal -->
<div class="modal fade" id="enabledisableModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-body">
                <input type="hidden" id="enabledisable_id">
                <p id="enabledisable_message">Are you sure?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-light" type="button" data-bs-dismiss="modal">No</button>
                <button class="btn btn-danger" id="confirmenabledisableBtn" type="button">Yes</button>
            </div>
        </div>
    </div>
</div>
<!-- Enable Confirmation Modal -->

<div class="application-footer ">
    <div class="application-footer__container container">
        <div class="application-footer__company-logo">
            <img src="<?php echo base_url();?>uploads/store/<?php echo $store_logo; ?>" alt="Store logo"
                class="application-footer__company-logo-img " width="210" height="69">
        </div>
        <div class="application-footer__copyright">
            <h1 class="application-content__page-heading_datetime text-center">
                <?php
        $date = new DateTime();
        echo $date->format("h:i A");
        ?>
            </h1>
            @ All rights reserved. Emigo 2025t
        </div>
        <div class="application-footer__company-logo">

            <img class="" src="<?php echo base_url();?>assets/admin/images/ChoosemyfoodLogo.png" alt="Choose My Food">
        </div>
    </div>
</div>

<button id="goToTop" style="display: none; position: fixed; bottom: 20px; right: 20px;">Top</button>

<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/admin/js/jquery-3.7.1.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js"></script>
<script type="module" src="<?php echo base_url();?>assets/admin/js/ownerscripts.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/order-dashboard.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/kitchen-dashboard.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/scripts.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/rooms.js"></script>
<!-- DataTables CSS -->
</body>

</html>