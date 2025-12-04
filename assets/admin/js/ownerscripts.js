//MARK: - Import
import { showPopupAlert,confirmDelete,enable_disable_confirmation } from './common.js';

$(document).ready(function () {

    var base_url = $('#base_url').val();

    //new DataTable('#example');
    $(document).on('click', '.emigo-close-btn', function () {
        location.reload();
    });

    //20. Scroll top jquery
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#goToTop').fadeIn();
        } else {
            $('#goToTop').fadeOut();
        }
    });


    $('#goToTop').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 600);
        return false;
    });

     //MARK: - Add stock
    $(document).on('click', '.add_stock', function () {

        $('#addstock').on('shown.bs.modal', function () {
            $('#stocks').val('');
            $('#stocks').focus();
        });

        var id = $(this).attr('data-id');
        $('#product_id').val(id);
        $('#addStockBtn').click(function () {
            var id = $(this).attr('data-id');
            $('#addstocks').val(id);
            let formData = new FormData($('#productstock')[
                0]);
            $.ajax({
                url: base_url + "owner/Product/addstock",
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        showPopupAlert('success', 'Stock updated...', true);
                    } else if (response.errors.pu_qty) {
                        $('#addstocks_error').html(response.errors.pu_qty);
                    }
                },

            });
        })
    })

    //MARK:- Remove Stock
    $(document).on('click', '.remove_stock', function () {

        $('#removestock').on('shown.bs.modal', function () {
            $('#remove_stocks').val('');
            $('#removestocks_error').html('');
            $('#remove_stocks').focus();
        });

        var id = $(this).attr('data-id');
        $('#product_id_remove').val(id);
        $('#removeStockBtn').click(function () {
            let formData = new FormData($('#removesstock')[
                0]);
            $.ajax({
                url: base_url + "owner/Product/removestock",
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        showPopupAlert('success', 'Stock updated...', true);
                    } else if (response.errors.sl_qty) {
                        $('#removestocks_error').html(response.errors.sl_qty).show();
                    }
                    else if (response.errors.message) {
                        $('#removestocks_error').html(response.errors.message).show();
                    } else {
                        $('#remove_stocks').val('');
                        $('#removestock').modal('hide');
                        $('#removestocks_error').html('');
                    }
                },
            })
        })
    })

    //MARK: - Change Availability
    var isAvailable, productID;
    $(document).on('change', '.change_availability', function () {
        isAvailable = $(this).val();
        productID = $(this).data('id');
        $('#confirmModal').modal('show');
    });

    $('#confirmStatusChange').click(function () {
        $.ajax({
            url: base_url + "owner/Product/changeProductAvailability",
            type: 'POST',
            data: {
                is_active: isAvailable,
                store_product_id: productID
            },
            success: function (response) {
                location.reload();
            }
        });
    });

    $('#cancelStatusChange').click(function () {
        location.reload();
    });


    //MARK: - Store product detail popup
    $(document).on('click', '.store_product_details', function () {
        $("#productForm").show();
        $("#iframe_body").hide();
        var id = $(this).attr('data-id');
        var isCustomizable = $(this).attr('data-isCustomizable'); //alert(isCustomizable);
        if (isCustomizable == 1) {
            $(".product_rate").addClass("d-none");
            $(".product_rate_label").addClass("d-none");
            $(".isCustomize").removeClass("d-none");
        } else {
            $(".product_rate").removeClass("d-none");
            $(".product_rate_label").removeClass("d-none");
            $(".isCustomize").addClass("d-none");

        }
        $('#hiddenField').val(id);
        $('#isCustomizable').val(isCustomizable);
        $('#product_id_new').val(id);
        $.ajax({
            url: base_url + "owner/Product/getDescriptions",
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('#store_is_customisable').val(response.data
                    .customisable);
                    $('#is_addon').val(response.data.is_addon);
                    $('#type').val(response.data.type);
                $('#store_product_rate').val(response.data
                    .rate);
                $('#store_product_name_ma').val(response.data
                    .malayalam_name);
                $('#store_product_name_en').val(response.data
                    .english_name);
                $('#store_product_name_hi').val(response.data
                    .hindi_name);
                $('#store_product_name_ar').val(response.data
                    .arabic_name);
                $('#description_malayalam').val(response.data
                    .malayalam_desc);
                $('#description_english').val(response.data
                    .english_desc);
                $('#description_hindi').val(response.data.hindi_desc);
                $('#description_arabic').val(response.data.arabic_desc);

            },
            error: function () {
                alert('An error occurred while fetching data.');
            }
        });
    });

    //MARK: - Store product Tab click
    $(document).on('click', '.store_product', function () {
        $("#productForm").show();
        $("#iframe_body").hide();
        var id = $('#hiddenField').val();
        var isCustomizable = $('#isCustomizable').val();
        if (isCustomizable == 0) {
            $(".isCustomize").addClass("d-none");
        } else {
            $(".isCustomize").removeClass("d-none");
        }
        $('#hiddenField').val(id);
        $('#product_id_new').val(id);
        $.ajax({
            url: base_url + "owner/Product/getDescriptions",
            type: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                $('#store_product_rate').val(response.data
                    .rate);
                $('#store_product_name_ma').val(response.data
                    .malayalam_name);
                $('#store_product_name_en').val(response.data
                    .english_name);
                $('#store_product_name_hi').val(response.data
                    .hindi_name);
                $('#store_product_name_ar').val(response.data
                    .arabic_name);
                $('#description_malayalam').val(response.data
                    .malayalam_desc);
                $('#description_english').val(response.data
                    .english_desc);
                $('#description_hindi').val(response.data.hindi_desc);
                $('#description_arabic').val(response.data.arabic_desc);

            },
            error: function () {
                alert('An error occurred while fetching data.');
            }
        });
    });


    //MARK: - Update product details
    $('#saveProduct').click(function () {
        let formData = new FormData($('#productForm')[
            0]); // Capture the form data, including files
        //alert(formData);
        $.ajax({
            url: base_url + "owner/Product/changeDescriptions", // URL to the controller method
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);

                if (response.errors) {
                    if (response.errors.description_malayalam) {
                        $('#description_malayalam_error').html(response.errors
                            .description_malayalam);
                    } else if (response.errors.description_english) {
                        $('#description_english_error').html(response.errors
                            .description_english);
                    } else if (response.errors.description_hindi) {
                        $('#description_hindi_error').html(response.errors
                            .description_hindi);
                    } else if (response.errors.description_arabic) {
                        $('#description_arabic_error').html(response.errors
                            .description_arabic);
                    }
                } else {
                    showPopupAlert('success', 'Product details updated...', true);
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });


    //MARK: Search product on keyup
    $('#search_product').on('keyup', function () {
        var search = $(this).val(); //alert(search);
        $.ajax({
            url: base_url + "owner/Product/searchProductOnKeyUp",
            type: 'GET', // HTTP method (can be POST if needed)
            data: {
                search: search
            }, // Data sent to the controller
            success: function (response) {
                console.log(response); // Log the response for debugging
                $('#search_result_container').html(response); // Update the HTML content of a container
            },
            error: function (xhr, status, error) {
                console.error('Error: ' + error);
            }
        })
    })

    $('#product-search__button').on('keyup', function () {
        var search = $(this).val(); //alert(search);
        $.ajax({
            url: base_url + "owner/Product/searchProductOnKeyUp",
            type: 'GET', // HTTP method (can be POST if needed)
            data: {
                search: search
            }, // Data sent to the controller
            success: function (response) {
                console.log(response); // Log the response for debugging
                $('#search_result_container').html(response); // Update the HTML content of a container
            },
            error: function (xhr, status, error) {
                console.error('Error: ' + error);
            }
        })
    })

    //MARK:- Delete product.
    $('.delete_store_product').click(function () {
        $('#Edit-dish').modal('hide');
        productID = $('#hiddenField').val();
        $('#confirmDeleteProduct').modal('show');
    });

    $('#confirmDeleteProductbtn').click(function () {
        $.ajax({
            url: base_url + "owner/stock/delete_product", // Correct endpoint
            data: { product_id: productID },
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                $('#confirmDeleteProduct').modal('hide');
                location.reload();
            }
        });
    });

    //MARK: Edit dish and load variants, addons, recipes, photos, combo
    $('.editProduct').click(function () {
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/product/load_variants/' + product_id;
    });

    $('.addVariant').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/product/load_variants/' + product_id;
    });

    $('.addAddons').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/product/load_addons/' + product_id;
    });

    $('.addRecipe').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/product/load_recipes/' + product_id;
    });

    $('.addPhotos').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/product/load_images/' + product_id;
    });

    $('.listCombo').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        var product_id = $('#hiddenField').val();
        document.getElementById('iframe_body').src = base_url + 'owner/combo/load_combo/' + product_id;
    });

    //MARK: - Set default image
    $('.set_default').click(function() {
        alert(      )
            var image = $(this).data('image');
            var store_product_id = $(this).data('id'); //alert(image);alert(id);
            $.ajax({
                url: base_url + "owner/Product/set_default_image",
                method: 'POST',
                data: {
                    image: image,
                    store_product_id: store_product_id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        var modalWindow = window.top.document.querySelector(".emigo-modal");
                        if (modalWindow) {
                            modalWindow.style.display = "none";
                            if (window.top !== window.self) {
                                window.top.location.reload();
                            } else {
                                location.reload();
                            }
                        }
                    }
                }
            });
        });

        //MARK: - Upload new image
        $('#imageUpload').on('change', function() {
            const formData = new FormData();
            const store_product_id = $('#store_product_id').val();
            formData.append('image', this.files[0]); // Appending the image file
            formData.append('id', store_product_id);
            $.ajax({
                url: base_url + "owner/Product/upload_new_image",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    //alert(response);
                    if (response.status === 'success') {
                        var modalWindow = window.top.document.querySelector(".emigo-modal");
                        if (modalWindow) {
                            modalWindow.style.display = "none";
                            if (window.top !== window.self) {
                                window.top.location.reload();
                            } else {
                                location.reload();
                            }
                        }
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        });

        //MARK: - Update variants
        $('#update_variants').on('click', function () {
        let store_product_id = $('#store_product_id').val();
        let taxRate = $('#taxRate').val();

        let variants = [];
        $('.variant_checkbox').each(function () {
            let variant_id = $(this).data('variant-id');
            let checked = $(this).is(':checked') ? 1 : 0;
            let rate = $('.rate[data-variant-id="'+variant_id+'"]').val();
            let variant_value = $('.variant_value[data-variant-id="'+variant_id+'"]').val();
            let is_default = $('.is_default[data-variant-id="'+variant_id+'"]').is(':checked') ? 1 : 0;

            variants.push({
                variant_id: variant_id,
                variant_value: variant_value,
                checked: checked,
                rate: rate,
                is_default: is_default
            });
        });

        console.log(variants); // For debugging


        $.ajax({
            url: base_url + "owner/Product/updateVariants",
            type: "POST",
            data: {
                store_product_id: store_product_id,
                taxRate: taxRate,
                variants: variants
            },
            success: function (res) {
                showPopupAlert('success', 'Variants updated successfully!', true);
            }
        });
    });

    $(document).on('change', '.is_default', function () {
        $('.is_default').not(this).prop('checked', false);
    });

    $(document).on("change", ".variant_checkbox", function () {
        updateVariantValues();
    });

    function updateVariantValues() {
        // Check which variants are selected
        let hasQuarter = $('.variant_checkbox[data-variant-id="4"]').is(':checked');
        let hasHalf    = $('.variant_checkbox[data-variant-id="3"]').is(':checked');
        let hasFull    = $('.variant_checkbox[data-variant-id="2"]').is(':checked');

        let quarterVal = 0, halfVal = 0, fullVal = 0;

        if (hasQuarter && hasHalf && hasFull) {
            quarterVal = 1;
            halfVal = 2;
            fullVal = 4;
        } else if (hasQuarter && hasHalf) {
            quarterVal = 1;
            halfVal = 2;
            fullVal = 0;
        } else if (hasHalf && hasFull) {
            quarterVal = 0;
            halfVal = 1;
            fullVal = 2;
        } else if (hasFull) {
            quarterVal = 0;
            halfVal = 0;
            fullVal = 1;
        }

        // Update inputs
        $('.rate[data-variant-id="4"]').closest('tr').find('input[name="variant_value"]').val(quarterVal);
        $('.rate[data-variant-id="3"]').closest('tr').find('input[name="variant_value"]').val(halfVal);
        $('.rate[data-variant-id="2"]').closest('tr').find('input[name="variant_value"]').val(fullVal);
    }

    //MARK: - Update addons
    $('#update_addons').on('click', function () {
        //alert('clicked');
        let store_product_id = $('#store_product_id').val();

        let addons = [];
        $('.addon_checkbox').each(function () {
            let addon_id = $(this).data('addon-id');
            let checked = $(this).is(':checked') ? 1 : 0; // convert to 1/0

            addons.push({
                addon_id: addon_id,
                checked: checked
            });
        });

        $.ajax({
            url: base_url + "owner/Product/updateAddons",
            type: "POST",
            data: {
                store_product_id: store_product_id,
                addons: addons
            },
            success: function (res) {
                showPopupAlert('success', 'Addons updated successfully!', true);
            }
        });
    });


    // MARK: RECIPES
    $('#saveReciepe').click(function() {
    let formData = new FormData($('#addreciepe')[0]);
    formData.append('store_product_id', $('#store_product_id').val());
    $.ajax({
        url: base_url + "owner/product/saveReciepe",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'JSON',
        success: function(response) {
            showPopupAlert('success', 'Recipe updated successfully!', true);
        }
    })
})

//MARK: Delete recipe
$(document).on('click', '.delete-recipe', function() {
    let recipeId = $(this).data('id');

    if(confirm("Are you sure you want to delete this recipe?")) {
        $.ajax({
            url: base_url + "owner/product/deleteReciepe",
            type: 'POST',
            data: { id: recipeId },
            dataType: 'JSON',
            success: function(response) {
                if(response.success) {
                    showPopupAlert('success', 'Recipe Deleted successfully!', true);
                } else {
                    alert("Failed to delete recipe");
                }
            }
        });
    }
});




















    //1. Get current date and time in owner dashboard
    fetchHolidays();
    updateDateTime();
    setInterval(updateDateTime, 1000);
    function getCurrentDateTime() {
        const now = new Date();
        const date = now.toLocaleDateString(); // Format: MM/DD/YYYY
        const time = now.toLocaleTimeString(); // Format: HH:MM:SS AM/PM
        return `${date}, ${time}`;
    }

    function updateDateTime() {
        $('#dateTimeButton').text(getCurrentDateTime());
    }

    //2. Change time from settings
    $('#edit_time').click(function (e) {
        let formData = new FormData($('#edittimes')[0]);
        $.ajax({
            url: base_url + "owner/Settings/editstoreTime",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    $('#editopeningandclosing').modal('hide');
                    location.reload();
                }
            },
        });
    });

    //3. Add holiday from owner dashboard
    $('#add_holiday').click(function (e) {
        let formData = new FormData($('#addholidays')[0]);
        $.ajax({
            url: base_url + "owner/settings/addHoliday",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    console.log(response); // Log response for debugging
                    $('#holidaydate_error').html('');
                    $('#holidayname_error').html('');
                    $('#holidays_date').val('');
                    $('#holidays_name').val('');
                    $('#holidays_description').val('');
                    fetchHolidays();
                } else if (response.errors.holiday_date) {
                    $('#holidaydate_error').html(response.errors
                        .holiday_date);
                }
                if (response.errors.holiday_name) {
                    $('#holidayname_error').html(response.errors
                        .holiday_name);
                }
            },
        });
    });

    //4. Fetch holidays and delete a holiday
    function fetchHolidays() {
        $.ajax({
            url: base_url + "owner/settings/getHolidaysByStoreId",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                renderTable(data);
            },
            error: function (error) {
                console.error('Error fetching holidays:', error);
            }
        });
    }

    // Render holidays in the table
    function renderTable(data) {
        const tableBody = $('#holidayTable tbody');
        tableBody.empty(); // Clear existing rows
        data.forEach(function (holiday, index) {
            const row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${holiday.holiday_name}</td>
                            <td>${holiday.holiday_date}</td>
                            <td><button class="btn btn-danger delete-btn" data-id="${holiday.id}">Delete</button></td>
                        </tr>
                    `;
            tableBody.append(row);
        });

        // Attach delete event to buttons
        $('.delete-btn').click(function () {
            const id = $(this).data('id');
            deleteHoliday(id);
        });
    }

    // Delete a holiday
    function deleteHoliday(id) {
        if (!confirm('Are you sure you want to delete this holiday?')) return;

        $.ajax({
            url: base_url + "owner/Settings/DeleteHoliday",
            type: "POST",
            data: {
                id: id
            },
            success: function (response) {
                const result = JSON.parse(response);
                if (result.success) {
                    // alert('Holiday deleted successfully.');
                    fetchHolidays(); // Refresh the table
                } else {
                    alert(result.message || 'Failed to delete the holiday.');
                }
            },
            error: function (error) {
                console.error('Error deleting holiday:', error);
            }
        });
    }



    //5. Add user from owner dashboard
    $('.adduser').click(function () {
        $("#iframe_body").show();
        $("#productForm").hide();
        document.getElementById('iframe_body').src = base_url + "owner/settings/listStoreUsers/";
    });


    //6.Form submission add user from owner dashboard
    $('#add_user').click(function (e) {
        //alert(1);
        let formData = new FormData($('#addusers')[0]);
        $.ajax({
            url: base_url + "owner/Settings/addUserValidation",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            /*************  ✨ Codeium Command ⭐  *************/
            /******  0b7c96ce-e4e5-430e-bba5-068a0e2f0f27  *******/
            success: function (response) {
                console.log(response);
                if (response.success) {
                    console.log(response);
                    $('#user_name_error').html('');
                    $('#user_email_error').html('');
                    $('#user_phoneno_error').html('');
                    $('#user_address_error').html('');
                    $('#user_username_error').html('');
                    $('#user_password_error').html('');
                    $('#user_role_error').html('');
                    $('#adduser').modal('hide');
                    location.reload();
                } else {
                // if (response.errors.user_name) {
                //     $('#duplicate_error').html(response.errors.user_name);
                // }


                    if (response.errors.user_name) {
                        $('#user_name_error').html(response.errors.user_name);
                    } else {
                        $('#user_name_error').html('');
                    }

                    if (response.errors.user_email) {
                        $('#user_email_error').html(response.errors.user_email);
                    } else {
                        $('#user_email_error').html('');
                    }

                    if (response.errors.user_phoneno) {
                        $('#user_phoneno_error').html(response.errors.user_phoneno);

                    } else {
                        $('#user_phoneno_error').html('');
                    }

                    if (response.errors.user_address) {
                        $('#user_address_error').html(response.errors.user_address);
                    } else {
                        $('#user_address_error').html('');
                    }
                    if (response.errors.user_username) {
                        $('#user_username_error').html(response.errors.user_username);
                    } else {
                        $('#user_username_error').html('');
                    }
                    if (response.errors.user_password) {
                        $('#user_password_error').html(response.errors.user_password);

                    } else {
                        $('#user_password_error').html('');
                    }

                    if (response.errors.role) {
                        $('#user_role_error').html(response.errors.role);
                    } else {
                        $('#user_role_error').html('');
                    }
                }
            },
        });
    })


    //7. Password change from owner dashboard
    $(document).on('click', '.password-change', function () {
        var id = $(this).data('id');
        $('#user_id_change').val(id);
    });

    $('#change_password').click(function () {
        let formData = new FormData($('#passwordchange')[0]);
        $.ajax({
            url: base_url + "owner/Settings/ChangePassword",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    console.log(response);
                    location.reload();
                } else {
                    if (response.errors && response.errors.password_changes) {
                        $('#password_change_error').html(response.errors.password_changes);
                    }
                }
            },
        })
    })

    //8. Edit user from owner dashboard
    $(document).on('click', '.edit-user', function () {
        var id = $(this).data('id');
        $('#user_id').val(id);
        $('#user_name').val($(this).data('name'));
        $('#user_email').val($(this).data('email'));
        $('#user_username').val($(this).data('username'));
        $('#user_phoneno').val($(this).data('phone'));
        $('#edit_user_role').val($(this).data('role'));
    });
    $(document).on('click', '.delete-user', function () {
        var id = $(this).data('id');
        $('#delete_id').val(id);
    });
    $('#edit_user').click(function () {
        let formData = new FormData($('#editusers')[0]);
        formData.append('user_id', $('#user_id').val());
        $.ajax({
            url: base_url + "owner/Settings/UpdateEditUser",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.success) {
                    $('#edituser').modal('hide');
                    location.reload();
                } else {
                    if (response.errors.edit_user_email) {
                        $('#edit_user_email_error').html(response.errors.edit_user_email);
                    }

                    if (response.errors.edit_user_phoneno) {
                        $('#edit_user_phoneno_error').html(response.errors
                            .edit_user_phoneno);
                    }
                }

            }
        })

    });

    //9. Delete user from owner dashboard
    $('#yes_del_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "owner/Settings/DeleteUser",
            data: {
                'id': $('#delete_id').val()
            },
            success: function (data) {
                window.location.href = '';
            }
        });
    });


    //10. Report from owner dashboard
    $('.sales').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_sales').src = base_url + 'owner/order/salesReport/' + $(this).attr('data-store-id');
    });

    $('.user').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_user').src = base_url + 'owner/order/userReport/' + $(this).attr('data-store-id');
    });

    $('.delivery').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_delivery').src = base_url + 'owner/order/deliveryReport/' + $(this).attr('data-store-id');
    });

/* pending reports */

        $('.reports_pending').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_reports_pending').src = base_url + 'owner/order/pending_reports/' + $(this).attr('data-store-id');
    });

    //27. Report from supplier dashboard
    $('.supplier_sales').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_sales').src = base_url + 'owner/order/supplierSalesReport/' + $(this).attr('data-store-id');
    });

    $('.supplier_user').click(function () {
        $('#table_name').html('REPORT -' + $(this).attr('data-name'));
        document.getElementById('table_iframe_user').src = base_url + 'owner/order/SupplierUserReport/' + $(this).attr('data-store-id');
    });

    // $('.supplier_delivery').click(function () {
    //     $('#table_name').html('REPORT -' + $(this).attr('data-name'));
    //     document.getElementById('table_iframe_delivery').src = base_url + 'owner/order/deliveryReport/' + $(this).attr('data-store-id');
    // });








    //19. Next available time updation
    $(document).on('click', '.nextavialable-modal', function () {
        var id = $(this).attr('data-id');
        $('#product_id_time').val(id)
    })
    $('#nextavaialabletimes').click(function () {
        var hours = $('#hours').val();
        var minutes = $('#minutes').val();
        var ampm = $('#ampm').val();
        var time = $('#available_select').val() + hours + ":" + minutes + " " + ampm;
        let formData = new FormData($('#avialablestimes')[
            0]);
        formData.append('product_id', $('#product_id_time').val());
        formData.append('time', time);
        $.ajax({
            url: base_url + "owner/Product/avialabletime",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response); // Log response for debugging
                if (response.success) {
                    location.reload();
                }
            },
        })
    });


    //22. Change table secret code and list tables from settings

    $('#list-table').click(function () {
        fetchTableRecords();
        $('#list-tables').modal('show');
    });

    function fetchTableRecords() {
        $.ajax({
            url: base_url + "owner/settings/load_store_tables",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let tbody = $('#Table-list tbody');
                tbody.empty(); // Clear existing rows
                $.each(data, function (index, table) {
                    let row = $('<tr></tr>');
                    let tableName = table.table_name ? table.table_name : "";
                    let store_table_name = table.store_table_name ? table.store_table_name : "";
                    let secret_code = table.secret_code ? table.secret_code : "";
                    row.append(`<td>${index + 1}</td>`);
                    row.append(`<td><input type="text" readonly value="${tableName}" class="form-control editable" data-id="${table.table_id}" data-field="table_name"></td>`);
                    row.append(`<td><input type="text" readonly value="${store_table_name}" class="form-control  editable" data-id="${table.table_id}" data-field="store_table_name"></td>`);
                    row.append(`<td><input type="text" readonly value="${secret_code}" class="form-control   editable" data-id="${table.table_id}" data-field="secret_code"></td>`);
                     row.append(`<td><button class="btn btn-success btn-sm edit-table-btn" data-id="${table.table_id}">edit</button></td>`);
                    tbody.append(row);
                });
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

     $(document).on('click', '.edit-table-btn', function () {
     var row = $(this).closest('tr'); // Find the parent row
     row.find('.editable').removeAttr('readonly').focus();
    })

    $(document).on('blur', '.editable', function () {
        let row = $(this).closest('tr');
        let tableId = row.find('.editable').data('id'); // Get table ID from any input
        let tableName = row.find('[data-field="table_name"]').val(); // Get table_name
        let storeTableName = row.find('[data-field="store_table_name"]').val(); // Get store_table_name
        let secretCode = row.find('[data-field="secret_code"]').val(); // Get secret_code
        $.ajax({
            url: base_url + "owner/settings/update_table",
            method: 'POST',
            data: { tableid: tableId, table_name: tableName, store_table_name: storeTableName, secret_code: secretCode },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    //alert('Record updated successfully');
                } else {
                    console.error('Error updating record');
                }
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });

    });





    //23. Clear stock from settings page.
    $('.clearstock').click(function () {
        $('#confirmModalStock').modal('show');
    });

    $('#confirmClearStock').click(function () {
        //alert(isAvailable); alert(productID);
        $.ajax({
            url: base_url + "owner/settings/clearStoreStock", // Correct endpoint
            type: 'POST',
            success: function (response) {
                $('#confirmModalStock').modal('hide');
                location.reload();
            }
        });
    });

    //24. Close order from settings page
    $('.close-order').click(function () {
        $('#confirmCloseOrder').modal('show');
    });

    $('.isOnlineOrderEnable').click(function () {
        $.ajax({
            url: base_url + "owner/settings/ChangeOnlineOrderStatus", // Correct endpoint
            type: 'POST',
            data: { 'status': '1' },
            success: function (response) {
                $('#confirmModalStock').modal('hide');
                location.reload();
            }
        });
    });
    $('.isOnlineOrderDisable').click(function () {
        $.ajax({
            url: base_url + "owner/settings/ChangeOnlineOrderStatus", // Correct endpoint
            type: 'POST',
            data: { 'status': '0' },
            success: function (response) {
                $('#confirmModalStock').modal('hide');
                location.reload();
            }
        });
    });
    //25. Enable or Disable KOT print from settings page
    $(document).on('click', '#is_kot_print', function () {
        var isChecked = $(this).is(':checked') ? 1 : 0;
        $.ajax({
            url: base_url + "owner/Settings/kotPrintEnable",
            method: 'POST',
            data: { is_kot_print_enable: isChecked },
            dataType: 'json',
            success: function (response) {
                $('#kotPrintMessage').text(response.message);
                $('#confirmModalKot').modal('show');

            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });

    //MARK: Asigining table
    $(document).on('click', '.assign-table', function () {
        $('#user_id_for_assigning').val($(this).data('id')); // User id from data attribute
        var user_id = $(this).data('id');
        $.ajax({
            url: base_url + "owner/Settings/GetAlreadyAssignedTables", //Return already assigned tables and checcked tables assigned when modal display
            type: "POST",
            data: { user_id: user_id }, // Send only user_id to fetch assigned tables
            dataType: "json",
            success: function (response) {
                console.log(response);
                //Uncheck all checkboxes first
                $('.table-checkbox').prop('checked', false);
                $('#tableTakeaway').prop('checked', false); // Pickup
                $('#tableDelivery').prop('checked', false); // Delivery

                // Loop through the response and check the assigned tables
                if (response.assignedTables) {
                    response.assignedTables.forEach(function (table_id) {
                        $('.table-checkbox[value="' + table_id + '"]').prop('checked', true);
                    });
                }

                // Check Is Delivery & Is Pickup based on response
                if (response.enable_delivery == 1) {
                    $('#tableDelivery').prop('checked', true);
                }
                if (response.enable_pickup == 1) {
                    $('#tableTakeaway').prop('checked', true);
                }

                // Show the modal after updating checkboxes
                $('#tableassign').modal('show');
            }
        });
    });

    function toggleTableAssignButton() {
        if ($("input[name='table-options[]']:checked").length > 0) {
            $("#assign_table_btn").prop("disabled", false);
        } else {
            $("#assign_table_btn").prop("disabled", false);
        }
    }

    toggleTableAssignButton();// Check initially on page load


    $("input[name='table-options[]']").on("change", function () {  // Listen for changes in checkbox selection
        toggleTableAssignButton();
    });

    $("#table_assign_form").on("submit", function (e) {
        e.preventDefault(); // Prevent form submission

        let selectedTables = [];
        let isPickup = false;
        let isDelivery = false;

        // Loop through all checked checkboxes
        $("input[name='table-options[]']:checked").each(function () {
            let value = $(this).val();
            if (value === "PK") {
                isPickup = true;  // Takeaway selected
            } else if (value === "DL") {
                isDelivery = true; // Delivery selected
            } else {
                selectedTables.push(value); // Store selected tables
            }
        });

        let formData = {
            user_id: $("#user_id_for_assigning").val(),
            selectedTables: selectedTables,
            isPickup: isPickup,
            isDelivery: isDelivery
        };

        $.ajax({
            url: base_url + "owner/Settings/TableAssign",
            type: "POST",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function (response) {
                $('#tableassign').modal('hide');
            }
        });
    });

    //MARK: ROOM ASSIGNING
    $(document).on('click', '.assign-room', function () {
        $('#user_id_for_assigning').val($(this).data('id')); // User id from data attribute
        var user_id = $(this).data('id');
        $.ajax({
            url: base_url + "owner/Settings/GetAlreadyAssignedRooms", //Return already assigned tables and checcked tables assigned when modal display
            type: "POST",
            data: { user_id: user_id }, // Send only user_id to fetch assigned tables
            dataType: "json",
            success: function (response) {
                console.log(response);
                //Uncheck all checkboxes first
                $('.room-checkbox').prop('checked', false);

                // Loop through the response and check the assigned tables
                if (response.assignedTables) {
                    response.assignedTables.forEach(function (table_id) {
                        $('.room-checkbox[value="' + table_id + '"]').prop('checked', true);
                    });
                }

                // Show the modal after updating checkboxes
                $('#roomassign').modal('show');
            }
        });
    });

    function toggleRoomAssignButton() {
        if ($("input[name='room-options[]']:checked").length > 0) {
            $("#assign_room_btn").prop("disabled", false);
        } else {
            $("#assign_room_btn").prop("disabled", false);
        }
    }

    toggleRoomAssignButton();// Check initially on page load


    $("input[name='room-options[]']").on("change", function () {  // Listen for changes in checkbox selection
        toggleRoomAssignButton();
    });

    $("#room_assign_form").on("submit", function (e) {
        e.preventDefault(); // Prevent form submission

        let selectedRooms = [];
        let isPickup = false;
        let isDelivery = false;

        // Loop through all checked checkboxes
        $("input[name='room-options[]']:checked").each(function () {
            let value = $(this).val();
            if (value === "PK") {
                isPickup = true;  // Takeaway selected
            } else if (value === "DL") {
                isDelivery = true; // Delivery selected
            } else {
                selectedRooms.push(value); // Store selected tables
            }
        });

        let formData = {
            user_id: $("#user_id_for_assigning").val(),
            selectedRooms: selectedRooms,
            isPickup: isPickup,
            isDelivery: isDelivery
        };

        console.log(selectedRooms);


        $.ajax({
            url: base_url + "owner/Settings/RoomAssign",
            type: "POST",
            data: JSON.stringify(formData),
            contentType: "application/json",
            success: function (response) {
                $('#roomassign').modal('hide');
            }
        });
    });

    //MARK:USER LOG OUT
    $(document).on('click', '.user-log-out', function () {
        var user_id = $(this).data('id');
        $.ajax({
            url: base_url + "owner/Settings/user_log_out",
            type: "POST",
            data: { user_id: user_id },
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    showPopupAlert('success', 'User Logout Successfully...', true);
                }
            }
        });
    });


    // qrcode window in owner side

    $(document).on('click', '#list-qrcode', function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#qr_code_id').val(id);
        document.getElementById('table_iframe').src = base_url + 'admin/table/load_store_tables_iframe/' + id;
    });


    // add whatsapp no

     $('#add_whatsapp_no').click(function (e) {
        //  alert(1);
        let formData = new FormData($('#addWhatsappno')[0]); // Capture form data
        console.log(formData);
        $.ajax({
            url: base_url + 'owner/Settings/addwhatsappno',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#add-category').modal('hide');
                        $('#successModal .modal-body').text('Whatsapp number saved successfully');
                        $('#successModal').modal('show');
                        $('#add-whatsappno').modal('hide');
                        $('#addWhatsappno')[0].reset();
                        $('#other_textbox').hide();
                        $('#whatsapp_no_error').html('')
                        // category_name_desc_ma_error
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            // window.location.href = base_url + 'admin/categories';
                            location.reload();
                        }, 1000);
                    }, 1000);
                } else {

                    $('#whatsapp_no_error').html('');
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors
                        if (response.errors.whatsapp_no) {
                            $('#whatsapp_no_error').html(response.errors.whatsapp_no);
                        } else {
                            $('#whatsapp_no_error').html('');
                        }




                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    });

    // delete whatsapp no

        $(".del_whatsapp").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#delete_whatsapp_no_id').val(id);
        // $('#edit-tax').modal('hide');
        // $('#delete-country').modal('show');
    });

    $('#yes_whatsapp_no_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "owner/Settings/deletewhatsappno",
            data: {
                'id': $('#delete_whatsapp_no_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });




//MARK: ADD PRODUCT
    $("#addNewDish").on("click", function (e) {
        // alert('ss');
        e.preventDefault();

        // Remove all old error messages
        $(".error-text").remove();

        let hasError = false;

        // Validation helper
        function setError(element, message) {
            hasError = true;
            $(element).after('<small class="error-text text-danger d-block">' + message + '</small>');
        }

        // ---- VALIDATION ----

        // Category
        if ($("select[name='category_id']").val() === "") {
            setError("select[name='category_id']", "Please select a category.");
        }
        if ($("select[name='product_veg_nonveg']").val() === "") {
            setError("select[name='product_veg_nonveg']", "Please select type.");
        }

        if ($("input[name='rate']").val().trim() === "") {
            setError("input[name='rate']", "Rate is required.");
        }
        if ($("input[name='product_name_ma']").val().trim() === "") {
            setError("input[name='product_name_ma']", "Malayalam name is required.");
        }
        if ($("input[name='product_name_en']").val().trim() === "") {
            setError("input[name='product_name_en']", "English name is required.");
        }
        if ($("input[name='product_name_hi']").val().trim() === "") {
            setError("input[name='product_name_hi']", "Hindi name is required.");
        }
        if ($("input[name='product_name_ar']").val().trim() === "") {
            setError("input[name='product_name_ar']", "Arabic name is required.");
        }


        if ($("textarea[name='product_desc_en']").val().trim() === "") {
            setError("textarea[name='product_desc_en']", "English description is required.");
        }
        if ($("textarea[name='product_desc_ma']").val().trim() === "") {
            setError("textarea[name='product_desc_ma']", "Malayalam description is required.");
        }
        if ($("textarea[name='product_desc_hi']").val().trim() === "") {
            setError("textarea[name='product_desc_hi']", "Hindi description is required.");
        }
        if ($("textarea[name='product_desc_ar']").val().trim() === "") {
            setError("textarea[name='product_desc_ar']", "Arabic description is required.");
        }

        if ($("input[name='images']").val().trim() === "") {
            setError("input[name='images']", "Product image is required.");
        }


        // Stop if errors exist
        if (hasError) return;

        // ---- PREPARE FORM DATA ----
        let formData = new FormData($('#add-new-dish')[0]);

    $.ajax({
        url: base_url + 'owner/Product/add_product',
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log("RAW RESPONSE:", response);
                try {
                    let res = JSON.parse(response);
                    // alert(res.status);


                    if (res.status === "success") {
                        showPopupAlert('success', res.message , true);
                        $("#add-new-dish")[0].reset();
                    }
                } catch (e) {
                    alert("Unexpected server response.");
                }
            },
            error: function () {
                $("#add_product").prop("disabled", false).text("Save");
                alert("AJAX error. Try again.");
            }
        });
    });


});