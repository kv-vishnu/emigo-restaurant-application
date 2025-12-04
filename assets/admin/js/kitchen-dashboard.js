$(document).ready(function () {


    var base_url = $('#base_url').val();
    var user_role_id = $('#role_id').val();

    //MARK:APPROVED
    $(document).on('click', '.kitchen_monitor_orders_details', function () {
        //alert(1);
        const orderId = $(this).attr('data-id');
        const tableName = $(this).attr('data-name');
        $('#table_name').text(tableName);
        $.ajax({
            url: base_url + 'kitchen/Order/approved_order_details/' + orderId,
            type: 'GET',
            success: function (response) {
                $('#orders_content').html(response);
            },
            error: function () {
                $('#orders_content').html('<p>Error loading data.</p>');
            }
        });
    });
    //end

   // MARK: Accept order
    $(document).on("click", ".accept_order", function() {
        var orderId = $(this).data("order-id");

            showConfirmation("Are you sure you want to accept this order?", function(confirmed) {
            if (!confirmed) return;

            $.ajax({
                url: base_url + "kitchen/order/change_order_status",
                type: "POST",
                data: {
                    orderId: orderId,
                    status: 2
                },
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
                        showConfirmation("✅ Order accepted successfully!");
                        $("#order_details_popup").modal("hide");
                        location.reload();
                    }, 300);
                },
                error: function(xhr, status, error) {
                    showConfirmation("❌ Failed to accept order. Please try again.");
                }
            });
        });
    });


    //MARK:Ready order
    $(document).on("click", ".ready_order", function() {
        var orderId = $(this).data("order-id");
        showConfirmation("Are you sure you want to ready this order?", function(confirmed) {
        if (!confirmed) return;
            $.ajax({
                url: base_url + "kitchen/order/change_order_status",
                type: "POST",
                data: {
                    orderId: orderId,
                    status : 3
                },
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
                        showConfirmation("✅ Order ready successfully!");
                        $("#order_details_popup").modal("hide");
                        location.reload();
                    }, 300);
                },
            });
        });
    });

    //MARK:OFD order
    $(document).on("click", ".out_for_delivery_order", function() {
        var orderId = $(this).data("order-id");
        showConfirmation("Are you sure you want to out for delivery this order?", function(confirmed) {
        if (!confirmed) return;
            $.ajax({
                url: base_url + "kitchen/order/change_order_status_with_ofd",
                type: "POST",
                data: {
                    orderId: orderId,
                    status : 4
                },
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
                        $("#order_details_popup").modal("hide");
                        location.reload();
                    }, 300);
                },
            });
        });
    });

    //MARK:KOT order
    $(document).on("click", ".kot_order", function() {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: base_url + "kitchen/order/kot_order",
            type: "POST",
            data: {
                orderId: orderId
            },
            dataType: "json",
            success: function(response) {

            },
        });
    });

    //MARK:Ready Order Details
    $(document).on('click', '.kitchen_monitor_ready_order_details', function () {
        const orderId = $(this).attr('data-id');
        const tableName = $(this).attr('data-name');//alert(orderId);alert(tableName);
        $('#table_name').text(tableName);
        $.ajax({
            url: base_url + 'kitchen/Order/ready_order_details/' + orderId,
            type: 'GET',
            success: function (response) {
                $('#orders_content').html(response);
            },
            error: function () {
                $('#orders_content').html('<p>Error loading data.</p>');
            }
        });
    });
    //end

    //MARK:Delivered Order Details
    $(document).on('click', '.kitchen_monitor_delivered_orders_details', function () {
        // alert(1);
        const orderId = $(this).attr('data-id');
        const tableName = $(this).attr('data-name');
        $('#table_name').text(tableName);
        $.ajax({
            url: base_url + 'kitchen/Order/delivered_order_details/' + orderId,
            type: 'GET',
            success: function (response) {
                $('#orders_content').html(response);
            },
            error: function () {
                $('#orders_content').html('<p>Error loading data.</p>');
            }
        });
    });
    //end
    //MARK: PRINT Order
    $(document).on("click", ".print_order", function() {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: base_url + "kitchen/order/print_order",
            type: "POST",
            data: {
                orderId: orderId
            },
            dataType: "html",
            success: function(response) {
                if (response) {
                    $("#print_order_modal .modal-body").html(response);
                    $("#print_order_modal").modal("show");
                } else {
                    alert("Failed to load order details.");
                }
            },
            error: function() {
                alert("Error loading order details.");
            }
        });
    });

    $(document).on("click", ".print_order_bill", function() {
        var printContents = document.getElementById("printableArea").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // optional
    });

    //MARK:Show Confirmation
    function showConfirmation(message, callback) {
            $("#confirmMessage").text(message);

            // Remove any old event handlers
            $("#confirmOk").off("click");
            $("#confirmCancel").off("click");
            $("#confirmModal").off("hidden.bs.modal");

            $("#confirmModal").modal('hide');

            // Check if callback is provided → Confirmation mode
            if (typeof callback === "function") {
                // Show both buttons
                $("#confirmOk").show();
                $("#confirmCancel").show();

                $("#confirmModal").modal('show');

                // OK clicked
                $("#confirmOk").on("click", function() {
                    $("#confirmModal").modal('hide');
                    callback(true);
                });

                // Cancel clicked or modal closed
                $("#confirmCancel, #confirmModal .btn-close").on("click", function() {
                    $("#confirmModal").modal('hide');
                    callback(false);
                });

                // Handle outside click or ESC close
                $("#confirmModal").on('hidden.bs.modal', function() {
                    callback(false);
                });
            }
            else
            {
                $("#confirmCancel").hide();
                $("#confirmOk").text("OK").show();

                $("#confirmModal").modal('show');

                $("#confirmOk, #confirmModal .btn-close").on("click", function() {
                    $("#confirmModal").modal('hide');
                });

                // Auto-close after 2 seconds (optional)
                setTimeout(function() {
                    $("#confirmModal").modal('hide');
                }, 2000);
            }
        }







































    //Get pending order count on order dashboard
    if(user_role_id == 6)
    {
       setInterval(function () {
        $.ajax({
            url: base_url + "owner/order_kitchen/get_Kitchen_Monitor_Orders_With_Count_Status",
            type: 'POST',
            dataType: 'json',
            success: function (response) {

                if(response.approved_order_count > 0)
                {
                    KitchenpendingOrderAlert();
                }
                //Approved orders
                if (Array.isArray(response['approved-orders'])) {
                    if(response['approved-orders'].length > 0){
                        $('#tabs__nav_approved_table_count').removeClass('d-none');
                        $('#tabs__nav_approved_table_count').text(response['approved-orders'].length);
                    }else{
                        $('#tabs__nav_approved_table_count').addClass('d-none');
                    }
                    let approvedHtml = '';
                    response['approved-orders'].forEach(function (order) {

                        let orderStatus = '';
                        let orderType = '';
                        let bgColor = '';
                        let btnClass = '';


                        if (order.order_status === '1') {
                            orderStatus = 'Approved';
                            btnClass = 'btn-approved w-100 mt-2';
                        }
                        else if (order.order_status === '2') {
                            orderStatus = 'Cooking';
                            btnClass = 'btn-cooking w-100 mt-2';
                        }else if (order.order_status === '3') {
                            orderStatus = 'Ready';
                            btnClass = 'btn-ready w-100 mt-2';
                        } else if (order.order_status === '4') {
                            orderStatus = 'Out For Delivery';
                            btnClass = 'btn-approved w-100 mt-2';
                        } else {
                            orderStatus = 'Pending';
                        }

                        if (order.order_type === 'D') {
                            orderType = order.table_name;
                            bgColor = '#ede1db';
                        } else if (order.order_type === 'PK') {
                            orderType = 'Pickup';
                            bgColor = '#b4c9dd';
                        } else if (order.order_type === 'DL') {
                            orderType = 'Delivery';
                            bgColor = '#f1b3a1';
                        }
                         else if (order.order_type === 'rom') {
                            orderType = 'Room';
                            bgColor = '#eb191994';
                        }

                        else {
                            orderType = 'Unknown';
                        }

                        approvedHtml += `
                            <div class="order-table-list__item">
                            <a data-bs-toggle="modal" data-id="${order.orderno}" data-name="${order.orderno}" data-bs-target="#order_details_popup" class="w-100 kitchen_monitor_orders_details" type="button" title="Table Orders">
                            <div id="order-table-list__item-heading_${order.orderno}"
                                        class="order-table-list__item-heading order-table-list__item-heading"
                                        style="background-color: ${bgColor};">
                                        ${orderType} - ${order.order_token}
                                        <img src="${base_url}assets/admin/images/table-icon.svg"
                                            alt="table icon" class="order-table-list__item-heading-icon">
                                    </div>
                            </a>

                                <button type="button" class="btn ${btnClass}">${order.approved_by_name}</button>
                                <button type="button" class="btn ${btnClass}">${orderStatus}</button>
                            </div>
                        `;
                    });
                    $('#approved-orders').html(approvedHtml);
                }
                else
                {
                    $('#tabs__nav_approved_table_count').addClass('d-none');
                }
                // Approved orders


                //Ready orders
                if (Array.isArray(response['ready-orders']))
                {
                    if (response.ready_order > 0)
                    {
                        $('#tabs__nav_approved_ready_count').removeClass('d-none');
                        $('#tabs__nav_approved_ready_count').text(response.ready_order);

                    }
                    else
                    {
                        $('#tabs__nav_approved_ready_count').addClass('d-none');
                    }
                    let readyHtml = '';
                    response['ready-orders'].forEach(function (order)
                    {

                        let orderStatus = '';
                        let orderType = '';
                        let bgColor = '';
                        let btnClass = '';


                        if (order.order_status === '1') {
                            orderStatus = 'Approved';
                            btnClass = 'btn-approved w-100 mt-2';
                        }
                        else if (order.order_status === '2') {
                            orderStatus = 'Cooking';
                            btnClass = 'btn-cooking w-100 mt-2';
                        }else if (order.order_status === '3') {
                            orderStatus = 'Ready';
                            btnClass = 'btn-ready w-100 mt-2';
                        } else if (order.order_status === '4') {
                            orderStatus = 'Out For Delivery';
                            btnClass = 'btn-approved w-100 mt-2';
                        }
                        else if (order.order_status === '5') {
                            orderStatus = 'Delivered';
                            btnClass = 'btn-approved w-100 mt-2';
                        } else {
                            orderStatus = 'Pending';
                        }

                        if (order.order_type === 'D') {
                            orderType = order.table_name;
                            bgColor = '#ede1db';
                        } else if (order.order_type === 'PK') {
                            orderType = 'Pickup';
                            bgColor = '#b4c9dd';
                        } else if (order.order_type === 'DL') {
                            orderType = 'Delivery';
                            bgColor = '#f1b3a1';
                        }

                          else if (order.order_type === 'rom') {
                            orderType = 'Room';
                            bgColor = '#eb191994';
                        }

                        else {
                            orderType = 'Unknown';
                        }

                        readyHtml += `
                            <div class="order-table-list__item">
                            <a data-bs-toggle="modal" data-id="${order.orderno}" data-name="${order.orderno}" data-bs-target="#order_details_popup" class="w-100 kitchen_monitor_ready_order_details" type="button" title="Table Orders">
                            <div id="order-table-list__item-heading_${order.orderno}"
                                        class="order-table-list__item-heading order-table-list__item-heading"
                                        style="background-color: ${bgColor};">
                                        ${orderType} - ${order.order_token}
                                        <img src="${base_url}assets/admin/images/table-icon.svg"
                                            alt="table icon" class="order-table-list__item-heading-icon">
                                    </div>
                            </a>
                                <button type="button" class="btn ${btnClass}">${order.approved_by_name}</button>
                                <button type="button" class="btn ${btnClass}">${orderStatus}</button>
                            </div>
                        `;
                    });
                    $('#ready-orders').html(readyHtml);
                }
                //Ready orders

                //Delivered orders
                if (Array.isArray(response['out-for-delivery-orders']))
                {
                    let deliveredHtml = '';
                    response['out-for-delivery-orders'].forEach(function (order)
                    {

                        let orderStatus = '';
                        let orderType = '';
                        let bgColor = '';
                        let btnClass = '';


                        if (order.order_status === '1') {
                            orderStatus = 'Approved';
                            btnClass = 'btn-approved w-100 mt-2';
                        }
                        else if (order.order_status === '2') {
                            orderStatus = 'Cooking';
                            btnClass = 'btn-cooking w-100 mt-2';
                        }else if (order.order_status === '3') {
                            orderStatus = 'Ready';
                            btnClass = 'btn-ready w-100 mt-2';
                        } else if (order.order_status === '4') {
                            orderStatus = 'Out For Delivery';
                            btnClass = 'btn-approved w-100 mt-2';
                        }else if (order.order_status === '5') {
                            orderStatus = 'Delivered';
                            btnClass = 'btn-approved w-100 mt-2';
                        } else {
                            orderStatus = 'Pending';
                        }

                        if (order.order_type === 'D') {
                            orderType = order.table_name;
                            bgColor = '#ede1db';
                        } else if (order.order_type === 'PK') {
                            orderType = 'Pickup';
                            bgColor = '#b4c9dd';
                        } else if (order.order_type === 'DL') {
                            orderType = 'Delivery';
                            bgColor = '#f1b3a1';
                        }

                          else if (order.order_type === 'rom') {
                            orderType = 'Room';
                            bgColor = '#eb191994';
                        }

                        else {
                            orderType = 'Unknown';
                        }

                        deliveredHtml += `
                            <div class="order-table-list__item">
                            <a data-bs-toggle="modal" data-id="${order.orderno}" data-name="${order.orderno}" data-bs-target="#order_details_popup" class="w-100 kitchen_monitor_delivered_orders_details" type="button" title="Table Orders">
                            <div id="order-table-list__item-heading_${order.orderno}"
                                        class="order-table-list__item-heading order-table-list__item-heading"
                                        style="background-color: ${bgColor};">
                                        ${orderType} - ${order.order_token}
                                        <img src="${base_url}assets/admin/images/table-icon.svg"
                                            alt="table icon" class="order-table-list__item-heading-icon">
                                    </div>
                            </a>
                                <button type="button" class="btn ${btnClass}">${order.approved_by_name}</button>
                                <button type="button" class="btn ${btnClass}">${orderStatus}(${order.out_for_delivery_time})</button>
                            </div>
                        `;
                    });
                    $('#out-for-delivery-orders').html(deliveredHtml);
                }
                //Delivered orders


                // if (response.dining > 0) {
                //     // $('#tabs__nav_approved_table_count').removeClass('d-none');
                //     // $('#tabs__nav_approved_table_count').text(response.dining);
                //     pendingOrderAlert();
                //     response.table_ids.forEach(function (table) {
                //         $("#order-table-list__item-heading_" + table.table_id).addClass("order-table-list__item-heading_approved-order");
                //     });
                // } else {
                //     $('#tabs__nav_approved_table_count').text('');
                // }

                if (response.pickup > 0)
                {
                    $('#tabs__nav_approved_pickup_count').removeClass('d-none');
                    $('#tabs__nav_approved_pickup_count').text(response.pickup);
                }
                else
                {
                    $('#tabs__nav_approved_pickup_count').text();
                }

                if (response.delivery > 0)
                {
                    $('#tabs__nav_approved_delivery_count').removeClass('d-none');
                    $('#tabs__nav_approved_delivery_count').text(response.delivery);
                }
                else
                {
                    $('#tabs__nav_approved_delivery_count').text('');
                }
                // if (response.ready_order > 0) {
                //     $('#tabs__nav_approved_ready_count').removeClass('d-none');
                //     $('#tabs__nav_approved_ready_count').text(response.ready_order);
                // } else {
                //     $('#tabs__nav_approved_ready_count').text();
                // }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching order counts:', error);
            }
        });
        }, 5000);
    }

    //3.Order Alert using set interval
    function KitchenpendingOrderAlert()
    {
        const audio = document.getElementById('kitchen_alert-audio');
        audio.play();
    }




});