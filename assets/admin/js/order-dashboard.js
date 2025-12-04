$(document).ready(function () {
var base_url = $('#base_url').val();
var user_role_id = $('#role_id').val();

if(user_role_id == 1 || user_role_id == 2 || user_role_id == 5)
{
    setInterval(fetchPendingOrdersCount, 5000);
}

//MARK: 1.View pending table orders
$('.pending_table_orders').click(function ()
{
        const tableId = $(this).attr('data-id');
        const tableName = $(this).attr('data-name');
        $('#table_name').text(tableName);
        $.ajax({
            url: base_url + 'owner/Table/pending_table_orders/' + tableId,
            type: 'GET',
            success: function (response) {
                $('#pending_table_orders_content').html(response);
            },
            error: function () {
                $('#pending_table_orders_content').html('<p>Error loading data.</p>');
            }
        });
});
//MARK: 1.View Pickup orders
$('.pending_pickup_orders').click(function ()
{
    const tableId = 4;
     $.ajax({
            url: base_url + 'owner/Pickup/pending_pickup_orders/' + tableId,
            type: 'GET',
            success: function (response) {
                $('#pending_table_orders_content').html(response);
            },
            error: function () {
                $('#pending_table_orders_content').html('<p>Error loading data.</p>');
            }
        });
});
//MARK: 1.Completed Pickup orders
$('.completed_pickup_orders').click(function ()
{
    const tableId = 4;
     $.ajax({
            url: base_url + 'owner/Pickup/completed_pickup_orders/' + tableId,
            type: 'GET',
            success: function (response) {
                $('#pending_table_orders_content').html(response);
            },
            error: function () {
                $('#pending_table_orders_content').html('<p>Error loading data.</p>');
            }
        });
});


//MARK: 1.View Delivery orders
$('.pending_delivery_orders').click(function ()
{
    const tableId = 4;
     $.ajax({
            url: base_url + 'owner/Delivery/pending_delivery_orders/' + tableId,
            type: 'GET',
            success: function (response) {
                $('#pending_table_orders_content').html(response);
            },
            error: function () {
                $('#pending_table_orders_content').html('<p>Error loading data.</p>');
            }
        });
});
//MARK:Pending Room Orders
$(document).on('click', '.pending_room_orders', function ()
{
        const tableId = $(this).attr('data-id');
        const tableName = $(this).attr('data-name');
        $('#table_name').text(tableName);
        $.ajax({
            url: base_url + 'owner/Rooms/pending_room_orders/' + tableId,
            type: 'GET',
            success: function (response) {
                $('#pending_table_orders_content').html(response);
            },
            error: function () {
                $('#pending_table_orders_content').html('<p>Error loading data.</p>');
            }
        });
});

//MARK:Ready Order Details
$(document).on('click', '.ready_order_details', function ()
{
        const orderId = $(this).attr('data-id');
        const tableName = $(this).attr('data-name');
        $('#table_name').text(tableName);
        $.ajax({
            url: base_url + 'owner/Order/ready_order_details/' + orderId,
            type: 'GET',
            success: function (response) {
                $('#pending_table_orders_content').html(response);
            },
            error: function () {
                $('#pending_table_orders_content').html('<p>Error loading data.</p>');
            }
        });
});
    //MARK: Delivered Order
    $(document).on("click", ".delivered_order", function() {

        var orderId = $(this).data("order-id");
        showConfirmation("Are you sure you want to Deliver order?", function(confirmed) {
        if (!confirmed) return;
            $.ajax({
                url: base_url + "owner/order/update_order_status_and_delivery_time",
                type: "POST",
                data: {
                    orderId: orderId,
                    status : 5
                },
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
                        showConfirmation("✅ Order ready successfully!");
                        $("#pending_table_orders_popup").modal("hide");
                        location.reload();
                    }, 300);
                },
            });
        });
    });
    //MARK:Delivered Order Details
    //MARK: PAY Order
    $(document).on("click", ".pay_order", function() {
        var orderId = $(this).data("order-id");
        showConfirmation("Are you sure you want to Pay order?", function(confirmed) {
        if (!confirmed) return;
            $.ajax({
                url: base_url + "owner/order/pay_order",
                type: "POST",
                data: {
                    orderId: orderId,
                    status : 5
                },
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
                        showConfirmation("✅ Order paid successfully!");
                        $("#pending_table_orders_popup").modal("hide");
                        location.reload();
                    }, 300);
                },
            });
        });
    });

    //MARK: PRINT Order
    $(document).on("click", ".print_table_order, .print_order", function () {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: base_url + "owner/order/print_order",
            type: "POST",
            data: {
                orderId: orderId
            },
            dataType: "html",
            success: function(response) {
                if (response)
                {
                    $("#print_order_modal .modal-body").html(response);
                    $("#print_order_modal").modal("show");
                }
                else
                {
                    alert("Failed to load order details.");
                }
            }
        });
    });

     //MARK: Return Order
    $(document).off("click", ".return_order").on("click", ".return_order", function() {

        $('#returnOrderModal').on('shown.bs.modal', function() {
            $('#return_quantity').val('');
            $('#return_quantity').focus();
        });

        $("#returnOrderModal").modal("show");
        $(".owner_model_heading_name").text($(this).data("item"));
        $(".owner_model_heading_qty").text($(this).data("qty"));
        $("#return_order_item_id").val($(this).data("order-item-id"));
        $("#return_order_item_qty").val($(this).data("qty"));
        $("#return_order_item_product_id").val($(this).data("item-id"));
        $("#return_order_id").val($(this).data("order-id"));
        $("#return_item_variant_id").val($(this).data("variant-id"));
    });

    $(document).on("change", "#return_reason", function() {
        if ($(this).val() == 'other') {
            $("#reason_container").removeClass("d-none");
        } else {
            $("#reason_container").addClass("d-none");
        }
    });

    //. Return order form click function
    $('#return-order-form').on('submit', function(e) {
        e.preventDefault();
        $('.errormsg').text('');
        var order_quantity = $('#return_order_item_qty').val(); //alert(order_quantity);
        var total_quantity = (parseInt($('#return_quantity').val()) || 0) + (parseInt($(
            '#replace_quantity').val()) || 0); //alert(total_quantity);
        let isValid = true;
        if ($('#return_reason').val() === '') {
            $('#reason_error').text('Please select any reason.');
            isValid = false;
        }
        if ($('#return_quantity').val() === '' && $('#replace_quantity').val() === '') {
            $('#quantity_error').text('Please select return or replace quantity.');
            isValid = false;
        }
        if (total_quantity > order_quantity) {
            $('#quantity_error').text('Please select valid quantity.');
            isValid = false;
        }
        if (isValid) {
            $.ajax({
                url: base_url + "owner/order/returnOrderItem",
                type: 'POST',
                data: $('#return-order-form').serialize(),
                success: function(response) {
                    $("#returnOrderModal").modal("hide");
                    setTimeout(function() {
                        showConfirmation("✅ Order Return successfully!");
                    }, 300);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    alert('An error occurred while submitting the form.');
                }
            });
        }
    });

    $(document).on("click", ".print_order_bill", function() {
        var printContents = document.getElementById("printableArea").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload(); // optional
    });


    //MARK:Delivered Order Details
    $(document).on('click', '.delivered_order_details', function ()
    {
            const orderId = $(this).attr('data-id');
            const tableName = $(this).attr('data-name');
            $('#table_name').text(tableName);
            $.ajax({
                url: base_url + 'owner/Order/delivered_order_details/' + orderId,
                type: 'GET',
                success: function (response) {
                    $('#pending_table_orders_content').html(response);
                },
                error: function () {
                    $('#pending_table_orders_content').html('<p>Error loading data.</p>');
                }
            });
    });

    //MARK:Print Order
    $(document).on("click", ".pay_order_print", function() {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: base_url +"owner/order/PrintOrderItems",
            method: 'POST',
            data: {
                order_no: orderId
            },
            success: function(response) {
                $("#modalContent").html(response);
                $("#printModal").modal('show');
            }
        });
    });

    //MARK:Completed orders
     $(document).on("click", ".tableOrdercompleted", function() {
        const table_id = $(this).attr('data-id');
        const tableName = $(this).attr('data-name');
        const date = new Date().toISOString().split('T')[0];
        $('#table_name').text(tableName);
        table_completed_orders(date,table_id);
     });

     $('#order-date1').on('change', function() {
        alert(1);
        let table_id = $(this).attr('table_id');
        let date = $(this).val();
        alert(table_id);alert(date);
     });

     function table_completed_orders(date,table_id) {
        $.ajax({
            url: base_url +"owner/Table/completed_table_orders",
            method: 'POST',
            data: {
                table_id: table_id,
                date : date
            },
            success: function (response) {
                $('#pending_table_orders_content').html(response);
            },
            error: function () {
                $('#pending_table_orders_content').html('<p>Error loading data.</p>');
            }
        });
     }

    //MARK:All Rooms
    $(document).on("click", ".all_rooms", function() {
           window.location.href = base_url + "owner/order/display_all_rooms";
    });

    $(document).on("click", "#back_to_order_monitor", function() {
           window.location.href = base_url + "owner/order";
    });

     //New Order
    $(document).on("click", ".new-order-btn", function()
    {
        let table_id = $(this).data('table-id');
        let order_type = $(this).data('order-type');

        let form = $('<form>', {
            action: base_url + "owner/order/new_order",
            method: 'POST'
        });

        form.append($('<input>', {
            type: 'hidden',
            name: 'table_id',
            value: table_id
        }));

        form.append($('<input>', {
            type: 'hidden',
            name: 'order_type',
            value: order_type
        }));

        $('body').append(form);
        form.submit();
    });

    //MARK:New Order Item
    $(document).on("click", ".new_order_item", function()
    {
        let order_number = $(this).data('order-id');

        let form = $('<form>', {
            action: base_url + "owner/order/new_order_item",
            method: 'POST'
        });

        form.append($('<input>', {
            type: 'hidden',
            name: 'order_number',
            value: order_number
        }));

        $('body').append(form);
        form.submit();
    });



    // MARK: New Order Product Loading
    loadProductsOnLoadNewOrderSelectProduct();

    function loadProductsOnLoadNewOrderSelectProduct()
    {
        $.ajax({
            url: base_url + "owner/Table/loadProductsOnLoadNewOrderSelectProduct",
            method: 'POST',
            success: function (response) {
                const items = JSON.parse(response);
                const select = document.getElementById("product");
                items.forEach(item => {
                    //alert(item.variants.variant_value);
                    const option = document.createElement("option");
                    option.value = item.name;
                    option.textContent = item.name;
                    option.dataset.productId = item.product_id;

                    // Read from variants object
                    if (item.variants.Quarter)
                        option.dataset.priceQuarter = item.variants.Quarter;

                    if (item.variants.Half)
                        option.dataset.priceHalf = item.variants.Half;

                    if (item.variants.Full)
                        option.dataset.priceFull = item.variants.Full;

                    if (item.variants.price)
                        option.dataset.price = item.variants.price;

                    select.appendChild(option);
                });
            },
            error: function () {
                console.error("Failed to load products.");
            }
        });
    }


    const productSelect = document.getElementById("product");
    const variantSelect = document.getElementById("variant");
    const rateInput = document.getElementById("rate");

    function updateRate()
    {
        const product = productSelect.options[productSelect.selectedIndex];
        const variant = variantSelect.value;

        let price = product.getAttribute("data-price"); // normal product

        // Check if variant exists
        if (variant) {
            let variantPrice = product.getAttribute("data-price-" + variant.toLowerCase());
            if (variantPrice) price = variantPrice;
        }

        rateInput.value = price || "";
    }


    productSelect.addEventListener("change", function()
    {
        if (productSelect.selectedOptions[0].hasAttribute("data-price")) {
            variantSelect.disabled = true;
            variantSelect.value = "";
        } else {
            variantSelect.disabled = false;
        }
        updateRate();
    });
    variantSelect.addEventListener("change", updateRate);


    function newOrderAddClickStockChecking(order_number, order_type ,table_id ,qty, product_id, rate , callback)
    {
        const variant = variantSelect.value;
        getVariantValue(variant,product_id).then(function(response)
        {

            let variant_value = response.variant_value;
            let variant_id = response.variant_id ?? 0;
            let variant_total_sum = 0;
            if(variant)
            {
                variant_total_sum = qty * variant_value;
                rate = response.rate;
            }
            else
            {
                variant_total_sum = qty * 1;
                rate = rate;
            }

            $.ajax({
                url: base_url +"owner/order/check_stock_availability_when_new_order_add",
                method: 'POST',
                data: {
                    product_id: product_id,
                    order_number: order_number,
                    order_type:order_type,
                    table_id:table_id,
                    order_item_rate: rate,
                    variant_id,variant_id,
                    variant_value:variant_value,
                    item_quantity:qty,
                    quantity: variant_total_sum
                },
                dataType: 'json',
                success: function(response) {
                    callback(response);
                }
            });

        });
    }


    function getVariantValue(variant,product_id)
    {
        return $.ajax({
            url: base_url + "owner/order/getVariantValue",
            method: 'POST',
            data: { variant: variant,product_id:product_id },
            dataType: 'json'
        });
    }


    document.getElementById("addBtn").addEventListener("click", function()
    {

        quantity = document.getElementById("order_qty").value;
        let order_type = document.getElementById("order_type").value;
        let table_id = document.getElementById("table_id").value;
        let select = document.getElementById("product");
        let product_id = select.options[select.selectedIndex].getAttribute("data-product-id");
        let product = select.value;
        let rate = document.getElementById("rate").value; //alert(rate);
        let order_number = document.getElementById("order_number").value;//alert(order_number);
        if (!product_id || !rate || !quantity)
        {
                    setTimeout(function()
                    {
                        showConfirmation("Please select product,rate,quantity!");
                    }, 300);
                    return;
        }

        newOrderAddClickStockChecking(order_number,order_type,table_id,quantity, product_id ,rate , function(stockResult)
        {

            if (stockResult.status === "success")
            {
                    $("#product").val("");
                    $("#variant").val("");
                    $("#rate").val("");
                    $("#order_qty").val("");
                    let total = rate * quantity;
                    let row = `
                        <tr>
                            <td>${product}</td>
                            <td>${rate}</td>
                            <td>${quantity}</td>
                            <td>${total}</td>
                            <td><button class="btn btn-danger btn-sm deleteRow">X</button></td>
                        </tr>
                        <div id="saveButtonContainer"></div>
                    `;


                    document.querySelector("#orderTable tbody").insertAdjacentHTML("beforeend", row);
                    updateGrandTotal();
            }
            else
            {
                    setTimeout(function() {
                        showConfirmation("Stock not available");
                    }, 300);
            }
        });
    });

    document.getElementById("save_new_order").addEventListener("click", function()
    {
        let order_number = document.getElementById("order_number").value;
        $.ajax({
                url: base_url +"owner/order/save_new_order",
                method: 'POST',
                data: {
                    order_number: order_number
                },
                dataType: 'json',
                success: function(response) {
                    showConfirmation("Order Successfull!...");
                    setTimeout(function() {
                        window.location.href = base_url + "owner/order";
                    }, 2000);
                }
            });
    });

    // Delete row
    document.addEventListener("click", function(e)
    {
        if (e.target.classList.contains("deleteRow")) {
            e.target.closest("tr").remove();
            updateGrandTotal();
        }
    });

    // Recalculate grand total
    function updateGrandTotal()
    {
        let total = 0;
        document.querySelectorAll("#orderTable tbody tr").forEach(row => {
            total += parseFloat(row.children[3].innerText);
        });
        document.getElementById("grandTotal").innerText = total;
    }





function showConfirmation(message, callback) {
    $("#confirmMessage").text(message);

    // Show modal (Bootstrap 4 or 5)
    $("#confirmModal").modal('show');

    // Remove old listeners to prevent duplicates
    $("#confirmOk").off("click");
    $("#confirmCancel").off("click");

    // Confirm clicked
    $("#confirmOk").on("click", function() {
        $("#confirmModal").modal('hide');
        if (typeof callback === "function") {
            callback(true);
        }
    });

    // Cancel clicked or closed via [X]
    $("#confirmCancel, #confirmModal .btn-close").on("click", function() {
        $("#confirmModal").modal('hide');
        if (typeof callback === "function") {
            callback(false);
        }
    });

    // Handle clicking outside the modal (optional)
    $("#confirmModal").on('hidden.bs.modal', function () {
        if (typeof callback === "function") {
            callback(false);
        }
        // Unbind this to prevent re-firing
        $(this).off('hidden.bs.modal');
    });
}

function fetchPendingOrdersCount()
{
    //alert(111);
        $.ajax({
            url: base_url + "owner/order/get_Pending_Orders_Count",
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                //Ready orders
                if (Array.isArray(response['ready-orders-db']))
                {
                    if(response['ready-orders-db'].length > 0)
                    {
                        $('#tabs__nav_approved_ready_count_db').css('display', 'block');
                        $('#tabs__nav_approved_ready_count_db').text(response['ready-orders-db'].length);
                        // pendingOrderAlert();
                    }
                    else
                    {
                        $('#tabs__nav_approved_ready_count_db').css('display', 'none');
                    }
                    let readyHtml = '';
                    response['ready-orders-db'].forEach(function (order) {

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
                            orderStatus = 'Out For Delivery' + '(' + order.out_for_delivery_time + ')';
                            btnClass = 'btn-approved w-100 mt-2';
                        }
                        else if (order.order_status === '5') {
                            orderStatus = 'Delivered' + '(' + order.delivered_time + ')';
                            btnClass = 'btn-approved w-100 mt-2';
                        }  else {
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
                            <a data-bs-toggle="modal" data-id="${order.orderno}" data-name="${order.orderno}" data-bs-target="#pending_table_orders_popup" class="w-100 ready_order_details" type="button" title="Table Orders">
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
                    $('#ready-orders-db').html(readyHtml);
                }
                //Ready orders

                //ROOM ORDERS
                if (Array.isArray(response['room_ids']))
                {
                    let roomOrdersHtml = '';
                    response['room_ids'].forEach(function (order)
                    {
                        roomOrdersHtml += `
                            <div class="order-table-list__item">
                            <a data-bs-toggle="modal" data-id="${order.table_id}" data-name="${order.table_name}" data-bs-target="#pending_table_orders_popup" class="w-100 pending_room_orders" type="button" title="Table Orders">
                            <div id="order-table-list__item-heading_190" class="order-table-list__item-heading order-table-list__item-heading-booked order-table-list__item-heading_pending-order bounce">
                                        ${order.table_name} <img src="${base_url}assets/admin/images/table-icon.svg" alt="table icon" class="order-table-list__item-heading-icon">
                                    </div>
                            <div class="order-table-list__item-content">
                                    <div class="order-table-list__unpaid-cooking">
                                        <div class="order-table-list__unpaid w-100">
                                            <div class="order-table-list__unpaid-label">Unpaid</div>
                                            <div class="order-table-list__unpaid-count"
                                                id="order-room-list__unpaid-count">${order.pending_count}</div>
                                        </div>
                                        <div class="order-table-list__cooking w-100">
                                            <div class="order-table-list__cooking-label">Cooking</div>
                                            <div class="order-table-list__cooking-count">${order.cooking_count}</div>
                                        </div>
                                    </div>
                                </div>

                            </a>
                            </div>
                        `;
                    });
                    $('#restaurant-room-orders').html(roomOrdersHtml);
                }
                //END ROOM ORDERS

                if(response.pending_order_count > 0)
                {
                    pendingOrderAlert();
                }
                if(response.ready_order_count > 0)
                {
                    pendingOrderAlert();
                }

                if (response.dining > 0)
                {
                    $('#tabs__nav_pending_table_count').removeClass('d-none');
                    $('#tabs__nav_pending_table_count').text(response.dining);
                    response.table_ids.forEach(function (table) {
                        $("#order-table-list__item-heading_" + table.table_id).addClass("order-table-list__item-heading_pending-order bounce");
                        $("#order-table-list__unpaid-count_" + table.table_id).text(table.pending_orders);
                    });

                    response.reorder_table_ids.forEach(function (table) {
                        $("#order-table-list__item-heading_" + table.table_id).addClass("bounce");
                    });

                }
                else
                {
                    $('#tabs__nav_pending_table_count').text();
                }

                if (response.pickup > 0)
                {
                    $('#tabs__nav_pending_pickup_count').removeClass('d-none');
                    $('#tabs__nav_pending_pickup_count').text(response.pickup);
                    $("#order-pickup__unpaid-count").text(response.pickup);
                } else
                {
                    $('#tabs__nav_pending_pickup_count').text();
                }

                if (response.delivery > 0)
                {
                    $('#tabs__nav_pending_delivery_count').removeClass('d-none');
                    $('#tabs__nav_pending_delivery_count').text(response.delivery);
                    $("#order-delivery__unpaid-count").text(response.delivery);
                }
                else
                {
                    $('#tabs__nav_pending_delivery_count').text();
                }

                if (response.rom > 0)
                {
                    $('#tabs__nav_pending_rom_count').removeClass('d-none');
                    $('#tabs__nav_pending_rom_count').text(response.rom);
                    response.table_ids.forEach(function (table) {
                        let $heading = $("#order-table-list__item-heading_" + table.table_id);
if ($heading.length > 0) {
    $heading.addClass("order-table-list__item-heading_pending-order bounce");
}
                        // $("#order-table-list__item-heading_" + table.table_id).addClass("order-table-list__item-heading_pending-order bounce");
                        $("#order-table-list__unpaid-count_" + table.table_id).text(table.pending_orders);
                    });

                    response.reorder_table_ids.forEach(function (table) {
                        $("#order-table-list__item-heading_" + table.table_id).addClass("bounce");
                    });

                } else {
                    $('#tabs__nav_pending_rom_count').text();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error fetching order counts:', error);
            }
        });
    }

    //3.Order Alert using set interval
    function pendingOrderAlert()
    {
        const audio = document.getElementById('alert-audio');
        audio.play();
    }




});