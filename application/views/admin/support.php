<div class="application-content settings-content">
    <div class="application-content__container settings-content__container container">
        <!--<h1 class="application-content__page-heading">Settings</h1>-->




        <div class="application-navigation container-fluid">

            <div class="settings-content__data settings-content__datas ">
                <div href="" class="settings-content__item settings-content__item_support ">
                    <div class="settings-content__item-attributes container ">

                        <div class="row  mb-3 border1 pt-2">

                            <form class="row g-3" id="addholidays" method="post" enctype="multipart/form-data">
                            
                            <!-- country selection start -->
                                <div class="col-md-3">
                                    <div class="mb-2  text-start">
                                        <label class="form-label mx-2" for="default-input">Country</label>
                                        
                                        <select name="support_country" class="form-select" id="">
                                            <option value="0">Select Country</option>
                                            <?php if (!empty($countries)) { ?>
                                                <?php foreach ($countries as $country) { ?>
                                                    <option value="<?php echo $country['country_id']; ?>">
                                                        <?php echo $country['name']; ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <span class=" error errormsg mt-2 mx-2" id="support_country_error"></span>
                                    </div>
                                </div>
                                <!-- country selection end -->



                                <div class="col-md-3">
                                    <div class="mb-2  text-start">
                                        <label class="form-label mx-2" for="default-input">Support Number</label>
                                        <input type="text" value="" placeholder="Support Number" required=""
                                            class="form-control" name="support_number">
                                        <span class="error errormsg mt-2 mx-2" id="support_number_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-2  text-start ">
                                        <label class="form-label mx-2" for="default-input">Support Email</label>
                                        <input type="text" class="form-control" required="" placeholder="Support Email"
                                            name="support_email">
                                        <span class="error errormsg mt-2 mx-2" id="support_email_error"></span>
                                    </div>
                                </div>





                                <div class="col-md-2">
                                    <div class="mb-4">
                                        <label class="form-label" for="default-input">&nbsp;</label><br>
                                        <button class="btn btn-primary btn-lg w-100" type="button"
                                            id="add_holiday">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>



                    </div>



                </div>

                <div class="form-check settings-content__button-blocks">

                </div>

            </div>
        </div>



        <!-- MODALS -->
        <div class="modal fade" id="holiday" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="table_name"></span>Holidays</h1>
                        <button type="button" class="emigo-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row bg-soft-light mb-3 border1 pt-2">

                            <form class="row g-3" id="addholidays" method="post" enctype="multipart/form-data">
                                <div class="col-md-3">
                                    <div class="mb-2 ">
                                        <label class="form-label mx-2" for="default-input">Date</label>
                                        <input type="date" value="<?=date('Y-m-d');?>" required class="form-control"
                                            id="holidays_date" name="holiday_date">
                                        <span class="error errormsg mt-2 mx-2" id="holidaydate_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-2 ">
                                        <label class="form-label mx-2" for="default-input">Holiday Name</label>
                                        <input type="text" class="form-control" required placeholder="Holiday Name"
                                            id="holidays_name" name="holiday_name">
                                        <span class="error errormsg mt-2 mx-2" id="holidayname_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-2 focus">
                                        <label class="form-label" for="default-input">Description</label>
                                        <input class="form-control" value="" placeholder="Description" type="text"
                                            id="holidays_description" name="holiday_description">

                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label class="form-label" for="default-input">&nbsp;</label><br>
                                        <button class="btn6-small" type="button" id="add_holiday">Add</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="">
                            <table class="table table-bordered" id="holidayTable">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Table Listing -->
        <!-- MODALS -->
        <div class="modal fade" id="list-tables" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="table_name"></span>Tables</h1>
                        <button type="button" class="emigo-close-btn" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="">
                            <table class="table table-bordered" id="Table-list">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Table</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Rows will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table Listing -->


    </div>


</div>
<!-- openingandclosing -->
<div class="modal fade" id="edit-time" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="table_name"></span>CHANGE OPENING
                    TIME AND CLOSING TIME</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <?php if ($this->session->flashdata('success_message')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success_message'); ?>
                </div>
                <?php endif; ?>
                <div class="row bg-soft-light mb-3 border1 pt-2">
                    <form class="row g-3" id="edittimes" method="post" enctype="multipart/form-data">


                        <div class="col-md-3">
                            <div class="mb-2 ">
                                <label class="form-label mx-2" for="default-input">Opening Time</label>
                                <input type="time"
                                    value="<?= isset($openingTime) ? htmlspecialchars($openingTime) : ''; ?>"
                                    class="form-control" required placeholder="Holiday Name" name="opening_time">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2 focus">
                                <label class="form-label" for="default-input">Closing Time</label>
                                <input class="form-control"
                                    value="<?= isset($closingTime) ? htmlspecialchars($closingTime) : ''; ?>"
                                    placeholder="Description" type="time" name="closing_time">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-4">
                                <label class="form-label" for="default-input">&nbsp;</label><br>
                                <button class="btn6-small" type="button" id="edit_time">CHANGE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add user -->
<div class="modal fade" id="list-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel"> <span id="table_name"></span>List users</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="message d-none" role="alert"></div>
                <div class="container">
                    <div class="row">

                    </div>
                </div>
                <div class="row">
                    <iframe id="iframe_body" height="700px" width="100%"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add user -->

<!-- Confirmation clear stock -->
<div class="modal fade" id="confirmModalStock" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel">Clear Stock</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to clear stock?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmClearStock">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation clear stock -->

<!-- Confirmation close order -->
<div class="modal fade" id="confirmCloseOrder" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel">Close Online Order</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= ($is_online_order_status == 0) ? 'Online Order Status is <button class="btn btn-danger"> DISABLED</button>' : 'Online Order Status is <button class="btn btn-success"> ENABLED</button>' ?>
            </div>
            <div class="modal-footer">
                <?= ($is_online_order_status == 0) ? '<button type="button" class="btn btn-secondary isOnlineOrderEnable" data-bs-dismiss="modal">Enable</button>' : '<button type="button" class="btn btn-secondary isOnlineOrderDisable" data-bs-dismiss="modal">Disable</button>' ?>

            </div>
        </div>
    </div>
</div>
<!-- Confirmation clear stock -->

<!-- Confirmation kot_print  -->
<div class="modal fade" id="confirmModalKot" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="emigo-modal__heading" id="exampleModalLabel">KOT Print</h1>
                <button type="button" class="emigo-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="kotPrintMessage"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Confirmation Kot_print  -->



<!-- MODALS END -->

<script>
function updateTime() {
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const currentTime = `${hours}:${minutes}:${seconds}`;
    document.getElementById('currentTime').textContent = currentTime;
}
setInterval(updateTime, 1000);
updateTime();
</script>