        var base_url = $('#base_url').val();
        //alert(base_url);

        document.addEventListener("change", function (e) {
            if (e.target.classList.contains("supplier-select")) {
                const selectedSupplier = e.target.value;
                const parent = e.target.closest(".order-row"); // parent container
                const approveBtn = parent.querySelector(".btn-approve"); // single element

                if (approveBtn) {
                    if (selectedSupplier) {
                        approveBtn.removeAttribute("disabled");
                    } else {
                        approveBtn.setAttribute("disabled", "true");
                    }
                }
            }
        });

        //MARK: Approve order
        $(document).on("click", ".btn-approve", function()
        {
            var $row = $(this).closest('.order-row');
            var orderId = $(this).data("order-id");
            var is_kot_enable = $(this).data("kot-enable");
            var selectedSupplierId = $row.find('.supplier-select').val();

            if (!selectedSupplierId || selectedSupplierId === "") {
                showConfirmation("⚠️ Please select a supplier before approving the order.");
                return;
            }

            showConfirmation("Are you sure you want to Approve order?", function(confirmed) {
            if (!confirmed) return;

            $.ajax({
                url: base_url + "owner/Table/approve_table_order", //old function update_order
                type: "POST",
                data: {
                    orderId: orderId,
                    selectedsupplier: selectedSupplierId
                },
                dataType: "json",
                success: function(response)
                {
                    console.log(response);
                    if(response.status == 'success')
                    {
                        setTimeout(function() {
                            showConfirmation("✅ Order Approved Successfully!");
                            $("#pending_table_orders_popup").modal('hide');
                        }, 300);
                    }
                    if (response.status === 'stock_error')
                    {
                        let table = `<table class="table table-bordered">
                            <tbody>`;

                        response.stockless_items.forEach((item, index) => {
                            table += `<tr>
                                <td>${index + 1}</td>
                                <td>${item.product_name} Ordered : ${item.ordered_qty} Available :${item.available_stock} </td>
                            </tr>`;
                        });

                        table += `</tbody></table>`;
                        document.getElementById('confirmMessage').innerHTML = table;
                        document.getElementById('confirmOk').style.display = 'none';
                        document.getElementById('confirmCancel').innerText = 'Close';
                        let confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
                        confirmModal.show();
                    }
                },
                error: function() {
                    showConfirmation("❌ An error occurred while approving the order.", function() {});
                }
        });
        });
    });
    // Approve end

    //MARK:Delete Order
    $(".delete_order").on("click", function() {
        var orderId = $(this).data("order-id");
        showConfirmation("Are you sure you want to Delete order?", function(confirmed) {
        if (!confirmed) return;
            $.ajax({
                url: base_url + "owner/Order/delete_order", //old function update_order
                type: "POST",
                data: {
                    orderId: orderId
                },
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
                        showConfirmation("✅ Order Deleted Successfully!");
                        $("#pending_table_orders_popup").modal('hide');
                    }, 300);
                }
            });
        });
    });
    
    //MARK:Delete Order Item
    $(document).on("click", ".delete_order_item", function() {
        var order_number = $(this).data("order-id");
        var order_item_id = $(this).data("order-item-id");
        showConfirmation("Are you sure you want to Delete order item?", function(confirmed) {
        if (!confirmed) return;
            $.ajax({
                url: base_url + "owner/Order/delete_order_item", //old function update_order
                type: "POST",
                data: {
                    order_number: order_number,
                    order_item_id:order_item_id
                },
                dataType: "json",
                success: function(response) {
                    setTimeout(function() {
                        showConfirmation("✅ Order Item Deleted Successfully!");
                        $("#pending_table_orders_popup").modal('hide');
                    }, 300);
                }
            });
        });
    });

    //MARK: PRINT Order
    $(document).on("click", ".print_table_order, .print_order", function () {
        var orderId = $(this).data("order-id");
        $.ajax({
            url: base_url + "Owner/order/print_order",
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
            }
        });
    });

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




        function openPopup() {
            document.getElementById('popupOverlay').classList.add('active');
        }

        function closePopup() {
            document.getElementById('popupOverlay').classList.remove('active');
        }

        // Close popup when clicking outside
        document.getElementById('popupOverlay').addEventListener('click', function(e) {
            if (e.target === this) {
                closePopup();
            }
        });

        function toggleAccordion(header) {
            const item = header.parentElement;
            const allItems = document.querySelectorAll('.accordion-item');

            // Close other accordions
            allItems.forEach(i => {
                if (i !== item) {
                    i.classList.remove('active');
                }
            });

            // Toggle current accordion
            item.classList.toggle('active');
        }


        //MARK:Increment QTY
        function incrementQty(btn)
        {
            //alert('inc');
            const qtyValue = btn.previousElementSibling;
            const orderItem = btn.closest('.order-item');
            const accordionItem = btn.closest('.accordion-item');
            const orderTotal = accordionItem.querySelector('.order-total');
            const productIdElement = orderItem.querySelector('.product-id');
            const order_item_id_element = orderItem.querySelector('.order-item-id');//Update using order_item_id
            const order_item_rate_element = orderItem.querySelector('.order-item-rate');
            const order_item_tax_amount_element = orderItem.querySelector('.order-item-tax-amount');
            const order_number_element = orderItem.querySelector('.order-number');
            const item_variant_value_element = orderItem.querySelector('.item-variant-value');
            const totalElement = orderItem.querySelector('.item-total');
            const rateElement = orderItem.querySelector('.item-rate');
            const rate = parseFloat(rateElement.getAttribute('data-rate'));

            let currentQty = parseInt(qtyValue.textContent);
            currentQty++;
            const productId = productIdElement.textContent.trim(); //alert(productId);
            const order_item_id = order_item_id_element.textContent.trim();
            const order_item_rate = order_item_rate_element.textContent.trim();
            const order_item_tax_amount = order_item_tax_amount_element.textContent.trim();
            const order_number = order_number_element.textContent.trim();
            const item_variant_value = item_variant_value_element.textContent.trim();

            const variant_total = getProductVariantTotal(order_number,productId);
            const variant_total_sum = parseInt(variant_total) + parseInt(item_variant_value);
            //alert(variant_total_sum);

            $.ajax({
                url: base_url +"owner/order/check_stock_availability_when_increment",
                method: 'POST',
                data: {
                    product_id: productId,
                    quantity:currentQty,
                    order_item_id:order_item_id,
                    order_number:order_number,
                    order_item_rate:order_item_rate,
                    order_item_tax_amount:order_item_tax_amount,
                    variant_total:variant_total_sum //variant total ennu parayunnathu sum of quantity selected variant products.Athinte koode current click variant value koottiytahanu
                },
                dataType:'json',
                success: function(response) {
                    if(response.status == 'success')
                    {
                        //alert('success');
                        qtyValue.textContent = currentQty;
                        const newTotal = (currentQty * rate).toFixed(2);
                        totalElement.textContent = newTotal;
                        orderTotal.textContent = response.order_total;
                        //updateOrderTotal(btn , response.order_total);
                        newVariantValue = item_variant_value * currentQty;
                        updateVariantInputInRow(btn, order_number , productId, newVariantValue);
                    }
                    else
                    {
                        setTimeout(function()
                        {
                            showConfirmation(response.message);
                        }, 300);
                    }
                }
            });
        }

        function decrementQty(btn)
        {
            const qtyValue = btn.nextElementSibling;
            const orderItem = btn.closest('.order-item');
            const accordionItem = btn.closest('.accordion-item');
            const orderTotal = accordionItem.querySelector('.order-total');
            const productIdElement = orderItem.querySelector('.product-id');
            const order_item_id_element = orderItem.querySelector('.order-item-id');//Update using order_item_id
            const order_item_rate_element = orderItem.querySelector('.order-item-rate');
            const order_item_tax_amount_element = orderItem.querySelector('.order-item-tax-amount');
            const order_number_element = orderItem.querySelector('.order-number');
            const item_variant_value_element = orderItem.querySelector('.item-variant-value');
            const totalElement = orderItem.querySelector('.item-total');
            const rateElement = orderItem.querySelector('.item-rate');
            const rate = parseFloat(rateElement.getAttribute('data-rate'));

            let currentQty = parseInt(qtyValue.textContent);
            currentQty--;
            const productId = productIdElement.textContent.trim(); //alert(productId);
            const order_item_id = order_item_id_element.textContent.trim();
            const order_item_rate = order_item_rate_element.textContent.trim();
            const order_item_tax_amount = order_item_tax_amount_element.textContent.trim();
            const order_number = order_number_element.textContent.trim();
            const item_variant_value = item_variant_value_element.textContent.trim();

            const variant_total = getProductVariantTotal(order_number,productId);
            const variant_total_sum = parseInt(variant_total) + parseInt(item_variant_value);
            //alert(currentQty);

            $.ajax({
                url: base_url +"owner/order/check_stock_availability_when_decrement",
                method: 'POST',
                data: {
                    product_id: productId,
                    quantity:currentQty,
                    order_item_id:order_item_id,
                    order_number:order_number,
                    order_item_rate:order_item_rate,
                    order_item_tax_amount:order_item_tax_amount,
                    variant_total:variant_total_sum //variant total ennu parayunnathu sum of quantity selected variant products.Athinte koode current click variant value koottiytahanu
                },
                dataType:'json',
                success: function(response) {
                    if (response.status === 'deleted')
                    {
                        const row = btn.closest('.order-item');
                        if (row) row.remove();
                        orderTotal.textContent = response.order_total;
                        return;
                    }
                    if(response.status == 'success')
                    {
                        qtyValue.textContent = currentQty;
                        const newTotal = (currentQty * rate).toFixed(2);
                        totalElement.textContent = newTotal;
                        orderTotal.textContent = response.order_total;
                        //updateOrderTotal(btn , response.order_total);
                        newVariantValue = item_variant_value * currentQty;
                        updateVariantInputInRow(btn, order_number , productId, newVariantValue);
                    }
                    else
                    {
                        setTimeout(function()
                        {
                            showConfirmation(response.message);
                        }, 300);
                    }
                }
            });
        }

        // function decrementQty(btn) {
        //     const qtyValue = btn.nextElementSibling;
        //     const orderItem = btn.closest('.order-item');
        //     const totalElement = orderItem.querySelector('.item-total');
        //     const rateElement = orderItem.querySelector('.item-rate');
        //     const rate = parseFloat(rateElement.getAttribute('data-rate'));

        //     let currentQty = parseInt(qtyValue.textContent);
        //     if (currentQty > 1) {
        //         currentQty--;
        //         qtyValue.textContent = currentQty;

        //         const newTotal = (currentQty * rate).toFixed(2);
        //         totalElement.textContent =  newTotal;

        //         updateOrderTotal(btn);
        //     }
        // }
        function getProductVariantTotal(order_number,productId) {
            const variant_totals = document.querySelectorAll(`.product_${order_number}${productId}_total_stock`);
            let sum = 0;
            variant_totals.forEach(el => {
                sum += Number(el.value) || 0;
            });
            return sum;
        }
        function updateVariantInputInRow(btn, order_number, productId, newValue) {
            const orderItem = btn.closest('.order-item');
            if (!orderItem) return;
            const variantInput = orderItem.querySelector(`.product_${order_number}${productId}_total_stock`);

            if (variantInput) {
                variantInput.value = newValue; // ✅ Set new value
            } else {
                console.warn(`Variant input .product_${order_number}${productId}_total_stock not found in this row.`);
            }
        }



        function updateOrderTotal(btn) {
            const accordionItem = btn.closest('.accordion-item');
            const orderTotal = accordionItem.querySelector('.order-total');
            const itemTotals = accordionItem.querySelectorAll('.item-total');

            let total = 0;
            itemTotals.forEach(item => {
                total += parseFloat(item.textContent.replace('$', ''));
            });

            orderTotal.textContent = total.toFixed(2);
        }






