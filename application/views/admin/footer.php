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

<div class="application-footer">
    <div class="application-footer__container_support container">
        <div class="application-footer__company-logo ">
            <img src="<?php echo base_url();?>assets/admin/images/ChoosemyfoodLogo.png" alt="Choose My Food Logo"
                class="application-footer__company-logo-img" width="210" height="69">
        </div>
        <div class="application-footer__copyright">

            <h1 class="application-content__page-heading_datetime text-center">
                <!-- <?php echo $Name;?> -->
                <!--<i class="fas fa-clock"></i>  -->
                <?php
        $date = new DateTime();
        echo $date->format("h:i A");
        ?>
            </h1>
            @ All rights reserved. Emigo 2025
        </div>
        <div class="application-footer__help-desk d-none">
            <div class="application-footer__help-desk-label">
                <!-- <img src="<?php echo base_url();?>assets/admin/images/help-desk-icon.svg" alt="help desk icon"
                    class="application-footer__help-desk-label-icon" width="67" height="47"> -->
                <div class="application-footer__help-desk-label-text">Help Desk</div>
            </div>
            <div class="application-footer__help-desk-number-and-email">
                <div class="application-footer__help-desk-number">
                    <img src="<?php echo base_url();?>assets/admin/images/help-desk-phone-icon.svg" alt=""
                        class="application-footer__help-desk-number-icon" width="16" height="17">
                    <a href="tel:+971-7112713311"
                        class="application-footer__help-desk-number-link"><?php echo $support_no; ?></a>
                </div>
                <div class="application-footer__help-desk-email">
                    <img src="<?php echo base_url();?>assets/admin/images/help-desk-email-icon.svg" alt=""
                        class="application-footer__help-desk-email-icon " width="16" height="17">
                    <a href="mailto:emigo@ae.com"
                        class="application-footer__help-desk-email-link"><?php echo $support_email; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<button id="goToTop" style="display: none; position: fixed; bottom: 20px; right: 20px;">Top</button>

<!-- JAVASCRIPT -->
<script src="<?php echo base_url();?>assets/admin/js/jquery-3.7.1.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/bootstrap.min.js"></script>
<script type="module" src="<?php echo base_url();?>assets/admin/js/otherscripts.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/scripts.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/datepicker.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/rooms.js"></script>
<script type="module" src="<?php echo base_url();?>assets/admin/js/Followup.js"></script>


<script>
$(function() {
    $("#datepicker").datepicker({
        autoclose: true,
        todayHighlight: true
    }).datepicker('update', new Date());

    $("#datepicker1").datepicker({
        autoclose: true,
        todayHighlight: true
    }).datepicker('update', new Date());
})
</script>
</body>

</html>