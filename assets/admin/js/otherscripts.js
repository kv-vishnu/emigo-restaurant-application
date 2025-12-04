//MARK: - Import
import { showPopupAlert,confirmDelete,enable_disable_confirmation } from './common.js';

$(document).ready(function () {

    var base_url = $('#base_url').val();

    $(document).on('click', '.emigo-close-btn , .reload-close-btn, .emigo-btn', function () {
        location.reload();
    });

    //MARK: -  Store Checkbox
    function bindCheckbox(selector) {
        $(document).on('change', selector, function() {
            $(this).val($(this).is(':checked') ? 1 : 0);
            console.log(selector + " changed → " + $(this).val());
        });
    }
    bindCheckbox('#is_table_tab');
    bindCheckbox('#is_pickup_tab');
    bindCheckbox('#is_delivery_tab');
    bindCheckbox('#is_room_tab');


    // MARK: - Add Country
    $('#add_country').click(function (e) {
        let formData = new FormData($('#add-new-country')[0]);
        $.ajax({
            url: base_url + 'admin/Country/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#add-country').modal('hide');
                        $('#successModal .modal-body').text('Country saved successfully');
                        $('#successModal').modal('show');
                     $('#add-new-country')[0].reset();
                        $('#other_textbox').hide();
                        $('#country_name_error').html('')
                        $('#country_code_error').html('')
                        $('#country_support_error').html('')
                        $('#country_email_error').html('')
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload();
                        }, 1000);
                    }, 1000);
                } else {

                    $('#country_name_error').html('');
                    $('#country_code_error').html('');
                    $('#country_currency_error').html('');
                    $('#country_support_error').html('');
                    $('#country_email_error').html('');
                    $('#general_error').html('');
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors
                        if (response.errors.country_name) {
                            $('#country_name_error').html(response.errors.country_name);
                        }

                        if (response.errors.country_code) {
                            $('#country_code_error').html(response.errors.country_code);
                        }

                        if (response.errors.country_currency) {
                            $('#country_currency_error').html(response.errors.country_currency);
                        }
                        if (response.errors.country_support) {
                            $('#country_support_error').html(response.errors.country_support);
                        }

                        if (response.errors.country_email) {
                            $('#country_email_error').html(response.errors.country_email);
                        }

                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })

    // MARK: - Edit Country
    $(".edit_country").click(function (e) {
        var id = $(this).attr('data-id');
        $('#hidden_country_id').val(id);

        $.ajax({
            url: base_url + 'admin/Country/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success' && response.data) {
                    $('#country_name').val(response.data.name);
                    $('#country_code').val(response.data.code);
                    $('#country_currency').val(response.data.currency);
                    $('#support_number').val(response.data.support_number);
                    $('#support_email').val(response.data.support_email);
                    // $('#country_id').val(response.data.country_id);
                    $('#edit-country').modal('show');
                }
                else {
                    alert('Country data not found!');
                }
            }
        })
    });


    //MARK: - Update Country
    $('#save_country').click(function (e) {
        var save_country = $('#hidden_country_id').val();
        let formData = new FormData($('#edit_save_country')[0]);
        formData.append('hidden_country_id', save_country);


        $.ajax({
            url: base_url + "admin/Country/updatecountrydetails",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success' && response.data) {
                    showPopupAlert('success', 'Record updated...', true);
                }

                else {

                    if (response.errors.country_name) {
                        $('#country_edit_name_error').html(response.errors.country_name);
                    } else {
                        $('#country_edit_name_error').html('');
                    }

                    if (response.errors.country_code) {
                        $('#country_edit_code_error').html(response.errors.country_code);
                    } else {
                        $('#country_edit_code_error').html('');
                    }

                    if (response.errors.country_currency) {
                        $('#country_edit_currency_error').html(response.errors.country_currency);
                    }
                    else {
                        $('#country_edit_currency_error').html('');
                    }
                    if (response.errors.support_number) {
                        $('#country_edit_support_number_error').html(response.errors.support_number);
                    }
                    else {
                        $('#country_edit_support_number_error').html('');
                    }
                    if (response.errors.support_email) {
                        $('#country_edit_support_email_error').html(response.errors.support_email);
                    }
                    else {
                        $('#country_edit_support_email_error').html('');
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });

//MARK: - Delete Country
    $(".delete_country").click(function (e)
    {
        var id = $(this).attr('data-id');
        confirmDelete(
            base_url + "admin/Country/DeleteUser",
            id,
            '#deleteModal',   // confirmation modal
            '#confirmDeleteBtn',  // yes button
        );
    });

    // $('#yes_del_user').click(function () {
    //     $.ajax({
    //         method: "POST",
    //         url: base_url + "admin/Country/DeleteUser",
    //         data: {
    //             'id': $('#delete_id').val()
    //         },
    //         success: function (data) {
    //             console.log(data);
    //             window.location.href = '';
    //         }
    //     });
    // });


    // MARK: - Add Tax
    $('#add_tax').click(function (e) {
        let formData = new FormData($('#add-new-tax')[0]); // Capture form data
        console.log(formData);


        $.ajax({
            url: base_url + 'admin/Tax/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#add-tax').modal('hide');
                        $('#successModal .modal-body').text('Tax saved successfully');
                        $('#successModal').modal('show');
                         $('#add-new-tax')[0].reset();
                        $('#other_textbox').hide();
                        $('#country_name_error').html('')
                        $('#country_tax_error').html('')
                        $('#country_amount_error').html('')

                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload();
                        }, 1000);
                    }, 1000);
                } else {

                    $('#country_name_error').html('')
                    $('#country_tax_error').html('')
                    $('#country_amount_error').html('')
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors
                        if (response.errors.country_name) {
                            $('#country_name_error').html(response.errors.country_name);
                        } else {
                            $('#country_name_error').html('');
                        }

                        if (response.errors.country_tax) {
                            $('#country_tax_error').html(response.errors.country_tax);
                        } else {
                            $('#country_tax_error').html('');
                        }

                        if (response.errors.country_amount) {
                            $('#country_amount_error').html(response.errors.country_amount);
                        }
                        else {
                            $('#country_amount_error').html('');
                        }
                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })



    // MARK: - Edit Tax
    $(".edit_tax").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#hidden_tax_id').val(id);
        $.ajax({
            url: base_url + 'admin/Tax/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#country_name').val(response.data.country_id);
                    $('#country_tax').val(response.data.tax_type);
                    $('#country_amount').val(response.data.tax_rate);
                    // $('#country_id').val(response.data.country_id);
                    $('#edit-tax').modal('show');
                }
                else {
                    alert('tax data not found!');
                }
            }
        })
    });

    // MARK: - Update Tax
    $('#save_tax').click(function (e) {
        var save_tax = $('#hidden_tax_id').val();
        let formData = new FormData($('#edit_tax_country')[0]);
        formData.append('hidden_tax_id', save_tax);


        $.ajax({
            url: base_url + "admin/Tax/updatetaxdetails",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);

                if (response.success === 'success') {
                    showPopupAlert('success', 'Tax details updated', true);
                }
                else {

                    if (response.errors.country_name) {
                        $('#tax_edit_name_error').html(response.errors.country_name);
                    } else {
                        $('#tax_edit_name_error').html('');
                    }

                    if (response.errors.country_tax) {
                        $('#tax_edit_error').html(response.errors.country_tax);
                    } else {
                        $('#tax_edit_error').html('');
                    }

                    if (response.errors.country_amount) {
                        $('#tax_edit_amount_error').html(response.errors.country_amount);
                    }
                    else {
                        $('#tax_edit_amount_error').html('');
                    }


                    if (response.errors) {
                        // alert(response.errors);
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });


    // MARK: - Delete Tax
    $(".delete_tax").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#delete_id').val(id);
        $('#edit-country').modal('hide');
        $('#delete-tax').modal('show');


    });

    $('#yes_del_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Tax/DeleteUser",
            data: {
                'id': $('#delete_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });



    //MARK: - Delete store
    $(".delete_store").click(function (e) {
        var id = $(this).attr('data-id');
        confirmDelete(
            base_url + "admin/store/delete",
            id,
            '#deleteModal',   // confirmation modal
            '#confirmDeleteBtn',  // yes button
        );
    })
    //MARK: - Approve store
    $('.approve').on('click', function () {
            var id = $(this).attr('data-id');
            $.ajax({
                method: "POST",
                url: base_url + "admin/Store/approve",
                data: {
                    'id': id
                },
                success: function (data) {
                  showPopupAlert('success', 'Store approved...', true);
                }
            });
    });
    //MARK: - Disable store
    $('.disable').on('click', function () {
            var id = $(this).attr('data-id');
            var type = $(this).data('type');
            $.ajax({
                method: "POST",
                url: base_url + "admin/Store/disable",
                data: { id: id, type: type },
                dataType: "json",
                success: function (res) {
                    if (res.status === 'success') {
                        showPopupAlert('success', 'Disabled...', true);
                    }
                }
            });
    });
    //MARK: - Enable store
    $('.enable').on('click', function () {
            var id = $(this).attr('data-id');
            var type = $(this).data('type');
            $.ajax({
                method: "POST",
                url: base_url + "admin/Store/enable",
                data: { id: id, type: type },
                dataType: "json",
                success: function (res) {
                    if (res.status === 'success') {
                        showPopupAlert('success', 'Enabled...', true);
                    }
                }
            });
    });
    //MARK: - Enable Row Item
    $(".enable_item").click(function (e) {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        if( type == 'category')
        {
            var url = base_url + "admin/categories/enable";
        }
        if( type == 'product')
        {
            var url = base_url + "admin/product/enable";
        }
        enable_disable_confirmation(
            url,
            id,
            '#enabledisableModal',
            '#confirmenabledisableBtn',
        );
    });
    //MARK: - Disable Row Item
    $(".disable_item").click(function (e) {
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        if( type == 'category')
        {
            var url = base_url + "admin/categories/disable";
        }
        if( type == 'product')
        {
            var url = base_url + "admin/product/disable";
        }
        enable_disable_confirmation(
            url,
            id,
            '#enabledisableModal',
            '#confirmenabledisableBtn',
        );
    })

    // 30. qr-code store

    $(document).on('click', '.qrcode-modal', function (e) {
        var id = $(this).attr('data-id');
        $('#qr_code_id').val(id);
        document.getElementById('table_iframe').src = base_url + 'admin/table/load_store_tables_iframe/' + id;
    });


    //MARK: - Add category


    $('#add_category').click(function (e) {
        //  alert(1);
        let formData = new FormData($('#addCategories')[0]);
        console.log(formData);
        $.ajax({
            url: base_url + 'admin/Categories/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success === 'success') {
                    showPopupAlert('success', 'Category added', true);
                } else {
                    $('#category_order_error').html('')
                    // $('#category_userfile_error').html('')
                    $('#category_name_ma_error').html('')
                    $('#category_name_en_error').html('')
                    $('#category_name_hi_error').html('')
                    $('#category_name_ar_error').html('')
                    $('#category_name_desc_ma_error').html('')
                    $('#category_name_desc_en_error').html('')
                    $('#category_name_desc_hi_error').html('')
                    $('#category_name_desc_ar_error').html('')
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors

                        if (response.errors.category_order) {
                            $('#category_order_error').html(response.errors.category_order);
                        } else {
                            $('#category_order_error').html('');
                        }

                        if (response.errors.category_name_ma) {
                            $('#category_name_ma_error').html(response.errors.category_name_ma);
                        }
                        else {
                            $('#category_name_ma_error').html('');
                        }

                        if (response.errors.category_name_en) {
                            $('#category_name_en_error').html(response.errors.category_name_en);
                        }
                        else {
                            $('#category_name_en_error').html('');
                        }

                        if (response.errors.category_name_hi) {
                            $('#category_name_hi_error').html(response.errors.category_name_hi);
                        }
                        else {
                            $('#category_name_hi_error').html('');
                        }

                        if (response.errors.category_name_ar) {
                            $('#category_name_ar_error').html(response.errors.category_name_ar);
                        }
                        else {
                            $('#category_name_ar_error').html('');
                        }

                        if (response.errors.category_desc_ma) {
                            $('#category_name_desc_ma_error').html(response.errors.category_desc_ma);
                        }
                        else {
                            $('#category_name_desc_ma_error').html('');
                        }

                        if (response.errors.category_desc_en) {
                            $('#category_name_desc_en_error').html(response.errors.category_desc_en);
                        }
                        else {
                            $('#category_name_desc_en_error').html('');
                        }

                        if (response.errors.category_desc_hi) {
                            $('#category_name_desc_hi_error').html(response.errors.category_desc_hi);
                        }
                        else {
                            $('#category_name_desc_hi_error').html('');
                        }

                        if (response.errors.category_desc_ar) {
                            $('#category_name_desc_ar_error').html(response.errors.category_desc_ar);
                        }
                        else {
                            $('#category_name_desc_ar_error').html('');
                        }



                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })


    // 32. edit category

    $(".edit_category").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#hidden_category_id').val(id);
        $.ajax({
            url: base_url + 'admin/Categories/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#category_code').val(response.data.category_code);
                    $('#category_order').val(response.data.order_index);
                    $('#existing_userfile').val(response.data.category_img);
                    $('#category_name_ma').val(response.data.category_name_ma);
                    $('#category_name_en').val(response.data.category_name_en);
                    $('#category_name_hi').val(response.data.category_name_hi);
                    $('#category_name_ar').val(response.data.category_name_ar);
                    $('#category_desc_ma').val(response.data.category_desc_ma);
                    $('#category_desc_en').val(response.data.category_desc_en);
                    $('#category_desc_hi').val(response.data.category_desc_hi);
                    $('#category_desc_ar').val(response.data.category_desc_ar);
                    // Show image preview
                    // let imagePath = base_url + 'uploads/categories/' + response.data.category_img;
                    // $('#preview_img').attr('src', imagePath);
                    // $('#country_id').val(response.data.country_id);
                    //  $('#edit-tax').modal('show');
                }
                else {
                    alert('tax data not found!');
                }
            }
        })

    });

    //MARK: - Update Category
    $('#save_category').click(function (e) {
        var save_tax = $('#hidden_category_id').val();
        let formData = new FormData($('#edit_categories')[0]);
        formData.append('hidden_category_id', save_tax);
        $.ajax({
            url: base_url + "admin/categories/updatecategorydetails",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                    showPopupAlert('success', 'Record updated...', true);
                }
                else {

                    if (response.errors.category_order) {
                        $('#category_edit_order_error').html(response.errors.category_order);
                    } else {
                        $('#category_edit_order_error').html('');
                    }

                    if (response.errors.userfile) {
                        $('#category_edit_userfile_error').html(response.errors.userfile);
                    }
                    else {
                        $('#category_edit_userfile_error').html('');
                    }

                    if (response.errors.category_name_ma) {
                        $('#category_edit_name_ma_error').html(response.errors.category_name_ma);
                    }
                    else {
                        $('#category_edit_name_ma_error').html('');
                    }

                    if (response.errors.category_name_en) {
                        $('#category_edit_name_en_error').html(response.errors.category_name_en);
                    }
                    else {
                        $('#category_edit_name_en_error').html('');
                    }

                    if (response.errors.category_name_hi) {
                        $('#category_edit_name_hi_error').html(response.errors.category_name_hi);
                    }
                    else {
                        $('#category_edit_name_hi_error').html('');
                    }

                    if (response.errors.category_name_ar) {
                        $('#category_edit_name_ar_error').html(response.errors.category_name_ar);
                    }
                    else {
                        $('#category_edit_name_ar_error').html('');
                    }

                    if (response.errors.category_desc_ma) {
                        $('#category_edit_name_desc_ma_error').html(response.errors.category_desc_ma);
                    }
                    else {
                        $('#category_edit_name_desc_ma_error').html('');
                    }

                    if (response.errors.category_desc_en) {
                        $('#category_edit_name_desc_en_error').html(response.errors.category_desc_en);
                    }
                    else {
                        $('#category_edit_name_desc_en_error').html('');
                    }

                    if (response.errors.category_desc_hi) {
                        $('#category_edit_name_desc_hi_error').html(response.errors.category_desc_hi);
                    }
                    else {
                        $('#category_edit_name_desc_hi_error').html('');
                    }

                    if (response.errors.category_desc_ar) {
                        $('#category_edit_name_desc_ar_error').html(response.errors.category_desc_ar);
                    }
                    else {
                        $('#category_edit_name_desc_ar_error').html('');
                    }

                    if (response.errors) {
                        // alert(response.errors);
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });

    //MARK: - Category order update
    $('.update_category_order').on('blur', function () {
        const categoryId = this.getAttribute('data-category-id');
        const orderIndex = this.value;
        updateOrderIndex(categoryId, orderIndex);
    });


    // 34 . delete category

    $(".del_category").click(function (e) {
        var id = $(this).attr('data-id');
        $('#delete_cat_id').val(id);
    });

    $('#yes_cat_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Categories/DeleteCategory",
            data: {
                'id': $('#delete_cat_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });

    //MARK: - Product assign to store
    $('.product_assign').click(function () {
    var storeId   = $(this).attr('data-id');
    var storeName = $(this).attr('data-name');
    $('#modal_title_table').text(storeName + ' - Product Assign');
    $.get(base_url + 'admin/Product_assign/load_products_for_assign/' + storeId, function(res) {
        $('#product_assign').html(res);
        $('#product_assign').append('<input type="hidden" id="store_id" value="'+storeId+'">');
        $('#assignModal').modal('show');
    });
});


    //MARK: - Filter Change
    $('#product_category_id').change(function() {
        //alert(1);
        var cat_id = $(this).val();
        var store_id = $("#store_id").val();

        $.post(base_url + "admin/Product_assign/filter", {category_id: cat_id, store_id: store_id}, function(res) {
            $("#product_list").html(res);
        });
    });

    //MARK: -Save Assignments
    $('#saveAssignments').click(function() {
        alert(2);
        var store_id = $("#store_id").val();
        var selected = [];
        $('#product_list input[name="product_ids[]"]:checked').each(function() {
            selected.push($(this).val());
        });

        $.post(base_url + "admin/Product_assign/save", {store_id: store_id, product_ids: selected}, function(res) {
            var data = JSON.parse(res);
            alert(data.message);
        });
    });





















    // 35. add cooking

    $('#add_cooking').click(function (e) {
        // alert(1);
        let formData = new FormData($('#add-new-cooking')[0]); // Capture form data
        console.log(formData);
        $.ajax({
            url: base_url + 'admin/Cooking/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#add-cooking').modal('hide');
                        $('#successModal .modal-body').text('cooking saved successfully');
                        $('#successModal').modal('show');

                        // $('#add-new-enquiry')[0].reset();
                        // $('#other_textbox').hide();
                        $('#cooking_name_ma_error').html('')
                        $('#cooking_name_en_error').html('')
                        $('#cooking_name_hi_error').html('')
                        $('#cooking_name_ar_error').html('')
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload(); // This reloads the whole page
                        }, 1000);
                    }, 1000);
                } else {
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {

                        $('#cooking_name_ma_error').html('')
                        $('#cooking_name_en_error').html('')
                        $('#cooking_name_hi_error').html('')
                        $('#cooking_name_ar_error').html('')
                        $('#general_error').html('')
                        // Handle field-specific validation errors
                        if (response.errors.cooking_name_ma) {
                            $('#cooking_name_ma_error').html(response.errors.cooking_name_ma);
                        } else {
                            $('#cooking_name_ma_error').html('');
                        }

                        if (response.errors.cooking_name_en) {
                            $('#cooking_name_en_error').html(response.errors.cooking_name_en);
                        } else {
                            $('#cooking_name_en_error').html('');
                        }

                        if (response.errors.cooking_name_hi) {
                            $('#cooking_name_hi_error').html(response.errors.cooking_name_hi);
                        }
                        else {
                            $('#cooking_name_hi_error').html('');
                        }

                        if (response.errors.cooking_name_ar) {
                            $('#cooking_name_ar_error').html(response.errors.cooking_name_ar);
                        }
                        else {
                            $('#cooking_name_ar_error').html('');
                        }



                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })

    // 36. edit cooking

    $(".edit_cooking").click(function (e) {
        var id = $(this).attr('data-id');
        $('#hidden_cooking_id').val(id);

        $.ajax({
            url: base_url + 'admin/Cooking/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success' && response.data) {
                    $('#cooking_name_ma').val(response.data.name_ma);
                    $('#cooking_name_en').val(response.data.name_en);
                    $('#cooking_name_hi').val(response.data.name_hi);
                    $('#cooking_name_ar').val(response.data.name_ar);
                    // $('#country_id').val(response.data.country_id);

                }
                else {
                    // alert('Country data not found!');
                }
            }
        })

    });


    // 37. update cooking
    $('#save_cooking').click(function (e) {
        var save_cooking = $('#hidden_cooking_id').val();
        // alert(save_country);
        // var id = $(this).attr('data-id');
        // $('#hidden_country_id').val(id);
        // alert(id);
        let formData = new FormData($('#edit-new-cooking')[0]);
        formData.append('hidden_cooking_id', save_cooking);
        $.ajax({
            url: base_url + "admin/Cooking/updatecookingdetails",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);

                if (response.success === 'success' && response.data) {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('Cooking Updated successfully');
                        $('#edit-cooking').modal('hide');
                    $('#successModal').modal('show');
                    setTimeout(function () {
                    $('#successModal').modal('hide');
                    location.reload();
                    },1000)
                    },1000)


                }
                else {

                    if (response.errors.cooking_name_ma) {
                        $('#cooking_edit_name_ma_error').html(response.errors.cooking_name_ma);
                    } else {
                        $('#cooking_edit_name_ma_error').html('');
                    }

                    if (response.errors.cooking_name_en) {
                        $('#cooking_edit_name_en_error').html(response.errors.cooking_name_en);
                    } else {
                        $('#cooking_edit_name_en_error').html('');
                    }

                    if (response.errors.cooking_name_hi) {
                        $('#cooking_edit_name_hi_error').html(response.errors.cooking_name_hi);
                    }
                    else {
                        $('#cooking_edit_name_hi_error').html('');
                    }

                    if (response.errors.cooking_name_ar) {
                        $('#cooking_edit_name_ar_error').html(response.errors.cooking_name_ar);
                    }
                    else {
                        $('#cooking_edit_name_ar_error').html('');
                    }

                    if (response.errors) {
                        // alert(response.errors);
                    }

                    // $('#successModal .modal-body').text('Country Updated successfully');
                    // $('#successModal').modal('show');
                    // $('#edituser').modal('hide');
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });

    // 38. delete cooking

    $(".del_cooking").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#delete_cook_id').val(id);
    });

    $('#yes_del_cook_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Cooking/Deletecooking",
            data: {
                'id': $('#delete_cook_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });


    // 39. add variant

    $('#add_variant').click(function (e) {
        // alert(1);
        let formData = new FormData($('#add-new-variant')[0]); // Capture form data
        console.log(formData);
        $.ajax({
            url: base_url + 'admin/Variants/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#add-variant').modal('hide');
                        $('#successModal .modal-body').text('cooking saved successfully');
                        $('#successModal').modal('show');

                        // $('#add-new-enquiry')[0].reset();
                        // $('#other_textbox').hide();
                        $('#variant_name_error').html('')
                        $('#variant_code_error').html('')
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload(); // This reloads the whole page
                        }, 1000);
                    }, 1000);
                } else {
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        // Handle field-specific validation errors
                        if (response.errors.variant_name) {
                            $('#variant_name_error').html(response.errors.variant_name);
                        } else {
                            $('#variant_name_error').html('');
                        }

                        if (response.errors.variant_code) {
                            $('#variant_code_error').html(response.errors.variant_code);
                        } else {
                            $('#variant_code_error').html('');
                        }
                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })


    // 40. edit variant
    $(".edit_variant").click(function (e) {
        var id = $(this).attr('data-id');
        $('#hidden_variant_id').val(id);
        $.ajax({
            url: base_url + 'admin/Variants/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success' && response.data) {
                    $('#variant_name').val(response.data.variant_name);
                    $('#variant_code').val(response.data.code);

                    // $('#country_id').val(response.data.country_id);

                }
                else {
                    // alert('Country data not found!');
                }
            }
        })

    });


    // 41 save variant

    $('#save_variant').click(function (e) {
        var save_variant = $('#hidden_variant_id').val();
        // alert(save_country);
        // var id = $(this).attr('data-id');
        // $('#hidden_country_id').val(id);
        // alert(id);
        let formData = new FormData($('#edit-new-variant')[0]);
        formData.append('hidden_variant_id', save_variant);
        $.ajax({
            url: base_url + "admin/Variants/updatevariantsdetails",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success' && response.data) {
                    setTimeout(function () {
                        $('#successModal .modal-body').text('Variant Updated successfully');
                        $('#successModal').modal('show');
                        $('#edit-variant').modal('hide');
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload();
                        }, 1000)
                    }, 1000)


                }
                else {

                    if (response.errors.variant_name) {
                        $('#variant_edit_name_error').html(response.errors.variant_name);
                    } else {
                        $('#variant_edit_name_error').html('');
                    }

                    if (response.errors.variant_code) {
                        $('#variant_edit_code_error').html(response.errors.variant_code);
                    } else {
                        $('#variant_edit_code_error').html('');
                    }

                    if (response.errors) {
                        // alert(response.errors);
                    }

                    // $('#successModal .modal-body').text('Country Updated successfully');
                    // $('#successModal').modal('show');
                    // $('#edituser').modal('hide');
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });


    // 42. delete variant

    $(".del_variant").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#delete_var_id').val(id);
    });

    $('#yes_del_cook_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Variants/Deletevariant",
            data: {
                'id': $('#delete_var_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });

    // 43. add user


    $('#add_user').click(function (e) {
        // alert(1);
        let formData = new FormData($('#add-new-user')[0]); // Capture form data
        console.log(formData);
        $.ajax({
            url: base_url + 'admin/User/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success === 'success') {

                    setTimeout(function () {
                        // window.location.href = base_url + 'admin/Enquiry/success';
                        $('#add-new-user')[0].reset();
                        $('#add-user').modal('hide');
                        $('#successModal .modal-body').text('user saved successfully');
                        $('#successModal').modal('show');

                        $('#add_user_error').html('')
                        $('#add_user_email_error').html('')
                        $('#add_user_phone_error').html('')
                        $('#add_user_address_error').html('')
                        $('#add_user_username_error').html('')
                        $('#add_user_password_error').html('')
                        $('#add_user_role_error').html('')
                        $('#add_user_shop_error').html('')
                        $('#general_error').html('')
                        setTimeout(function () {
                            $('#successModal').modal('hide');
                            location.reload(); // This reloads the whole page
                        }, 1000);
                    }, 1000);
                } else {
                    // Check if this is a duplicate entry error
                    if (typeof response.errors === 'string') {
                        // Display the general error message somewhere
                        $('#general_error').html(response.errors);
                    } else if (response.errors.duplicate) {
                        // Display the duplicate entry error
                        $('#general_error').html(response.errors.duplicate);
                    }
                    else {
                        $('#add_user_error').html('')
                        $('#add_user_email_error').html('')
                        $('#add_user_phone_error').html('')
                        $('#add_user_address_error').html('')
                        $('#add_user_username_error').html('')
                        $('#add_user_password_error').html('')
                        $('#add_user_role_error').html('')
                        $('#add_user_shop_error').html('')
                        // Handle field-specific validation errors
                        if (response.errors.add_user) {
                            $('#add_user_error').html(response.errors.add_user);
                        } else {
                            $('#add_user_error').html('');
                        }

                        if (response.errors.add_user_email) {
                            $('#add_user_email_error').html(response.errors.add_user_email);
                        } else {
                            $('#add_user_email_error').html('');
                        }

                        if (response.errors.add_user_phone) {
                            $('#add_user_phone_error').html(response.errors.add_user_phone);
                        }
                        else {
                            $('#add_user_phone_error').html('');
                        }

                        if (response.errors.add_user_address) {
                            $('#add_user_address_error').html(response.errors.add_user_address);
                        }
                        else {
                            $('#add_user_address_error').html('');
                        }
                        if (response.errors.add_user_username) {
                            $('#add_user_username_error').html(response.errors.add_user_username);
                        }
                        else {
                            $('#add_user_username_error').html('');
                        }

                        if (response.errors.add_user_password) {
                            $('#add_user_password_error').html(response.errors.add_user_password);
                        }
                        else {
                            $('#add_user_password_error').html('');
                        }

                        if (response.errors.add_user_role) {
                            $('#add_user_role_error').html(response.errors.add_user_role);
                        }
                        else {
                            $('#add_user_role_error').html('');
                        }


                        if (response.errors.add_user_shop) {
                            $('#add_user_shop_error').html(response.errors.add_user_shop);
                        }
                        else {
                            $('#add_user_shop_error').html('');
                        }

                    }
                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
        });
    })


    // 44. edit user

    $(".edit_user").click(function (e) {
        var id = $(this).attr('data-id');
        $('#hidden_user_id').val(id);

        $.ajax({
            url: base_url + 'admin/User/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success' && response.data) {
                    $('#add_username').val(response.data.Name);
                    $('#add_user_email').val(response.data.userEmail);
                    $('#add_user_phone').val(response.data.UserPhoneNumber);
                    $('#add_user_address').val(response.data.userAddress);
                    $('#add_user_username').val(response.data.userName);
                    $('#add_user_password').val(response.data.userPassword);
                    $('#add_user_role').val(response.data.userroleid);
                    $('#add_user_shop').val(response.data.store_id);

                    // $('#country_id').val(response.data.country_id);

                }
                else {
                    // alert('Country data not found!');
                }
            }
        })

    });


    // 45. save user

    $('#save_user').click(function (e) {
        var save_user = $('#hidden_user_id').val();
        // alert(save_country);
        // var id = $(this).attr('data-id');
        // $('#hidden_country_id').val(id);
        // alert(id);
        let formData = new FormData($('#edit-new-user')[0]);
        formData.append('hidden_user_id', save_user);
        $.ajax({
            url: base_url + "admin/User/updateuserdetails",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success' && response.data) {
                    showPopupAlert('success', 'User details updated', true);
                }
                else {

                    if (response.errors.add_user) {
                        $('#add_edit_user_error').html(response.errors.add_user);
                    } else {
                        $('#add_edit_user_error').html('');
                    }

                    if (response.errors.add_user_email) {
                        $('#add_edit_user_email_error').html(response.errors.add_user_email);
                    } else {
                        $('#add_edit_user_email_error').html('');
                    }

                    if (response.errors.add_user_phone) {
                        $('#add_edit_user_phone_error').html(response.errors.add_user_phone);
                    }
                    else {
                        $('#add_edit_user_phone_error').html('');
                    }

                    if (response.errors.add_user_address) {
                        $('#add_edit_user_address_error').html(response.errors.add_user_address);
                    }
                    else {
                        $('#add_edit_user_address_error').html('');
                    }
                    if (response.errors.add_user_username) {
                        $('#add_edit_user_username_error').html(response.errors.add_user_username);
                    }
                    else {
                        $('#add_edit_user_username_error').html('');
                    }

                    if (response.errors.add_user_password) {
                        $('#add_edit_user_password_error').html(response.errors.add_user_password);
                    }
                    else {
                        $('#add_edit_user_password_error').html('');
                    }

                    if (response.errors.add_user_role) {
                        $('#add_edit_user_role_error').html(response.errors.add_user_role);
                    }
                    else {
                        $('#add_edit_user_role_error').html('');
                    }


                    if (response.errors.add_user_shop) {
                        $('#add_edit_user_shop_error').html(response.errors.add_user_shop);
                    }
                    else {
                        $('#add_edit_user_shop_error').html('');
                    }
                    if (response.errors) {
                        // alert(response.errors);
                    }

                    // $('#successModal .modal-body').text('Country Updated successfully');
                    // $('#successModal').modal('show');
                    // $('#edituser').modal('hide');
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });


    // 46. delete user

    $(".del_user").click(function (e) {
        var id = $(this).attr('data-id');
        //  alert(id);
        $('#delete_user_id').val(id);
    });

    $('#yes_del_user_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/User/Deleteuser",
            data: {
                'id': $('#delete_user_id').val()
            },
            success: function (data) {
                console.log(data);
                window.location.href = '';
            }
        });
    });

    // 47. test for crop image

    $('#saveProductimage').click(function () {
        let formData = new FormData($('#new-image')[0]);

        $.ajax({
            method: "POST",
            url: base_url + "admin/Test/saveProductimage",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === 'success') {
                    // alert(response.message);

                    // Optional: show images
                    response.images.forEach(function (imgUrl) {
                        $('#preview').append('<img src="' + imgUrl + '" width="150" style="margin:10px;">');
                    });
                } else {
                    alert('Upload failed: ' + response.message);
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });


    //MARK: - Add product
    $("#add_product").on("click", function (e) {
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

        if ($("input[name='products_name_en']").val().trim() === "") {
            setError("input[name='products_name_en']", "English name is required.");
        }
        if ($("input[name='products_name_ma']").val().trim() === "") {
            setError("input[name='products_name_ma']", "Malayalam name is required.");
        }
        if ($("input[name='products_name_hi']").val().trim() === "") {
            setError("input[name='products_name_hi']", "Hindi name is required.");
        }
        if ($("input[name='products_name_ar']").val().trim() === "") {
            setError("input[name='products_name_ar']", "Arabic name is required.");
        }


        if ($("textarea[name='products_desc_en']").val().trim() === "") {
            setError("textarea[name='products_desc_en']", "English description is required.");
        }
        if ($("textarea[name='products_desc_ma']").val().trim() === "") {
            setError("textarea[name='products_desc_ma']", "Malayalam description is required.");
        }
        if ($("textarea[name='products_desc_hi']").val().trim() === "") {
            setError("textarea[name='products_desc_hi']", "Hindi description is required.");
        }
        if ($("textarea[name='products_desc_ar']").val().trim() === "") {
            setError("textarea[name='products_desc_ar']", "Arabic description is required.");
        }

        // ---- IMAGE VALIDATION (ALL 4 REQUIRED) ----
        for (let i = 1; i <= 4; i++) {
            let input = $("input[name='image" + i + "']");
            if (input.length && input.val() === "") {
                setError(input, "Image " + i + " is required.");
            }
        }

        // Stop if errors exist
        if (hasError) return;

        // ---- PREPARE FORM DATA ----
        let formData = new FormData($('#add-new-product')[0]);

    $.ajax({
        url: base_url + 'admin/Product/add',
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
                        $("#add-new-product")[0].reset();
                    }
                    if (res.status === "partial_error") {

                        let errorHtml = "Upload failed:";

                        if (res.failed_images && res.failed_images.length > 0) {
                            res.failed_images.forEach(function(err){
                                errorHtml += res.failed_images.join(', ');
                            });
                        }

                        showPopupAlert('success', errorHtml, false);
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


// 49. edit product
$(document).on('click', '.edit_product', function () {
        // alert('edit product');
        var id = $(this).attr('data-id');
        $('#hidden_products_id').val(id);
        $.ajax({
            url: base_url + 'admin/Product/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);

                if (response.success === 'success' && response.data) {
                    $('#category_id').val(response.data.category_id);
                    $('#products_name_ma').val(response.data.product_name_ma);
                    $('#products_name_en').val(response.data.product_name_en);
                    $('#products_name_hi').val(response.data.product_name_hi);
                    $('#products_name_ar').val(response.data.product_name_ar);
                    $('#products_desc_ma').val(response.data.product_desc_ma);
                    $('#products_desc_en').val(response.data.product_desc_en);
                    $('#products_desc_hi').val(response.data.product_desc_hi);
                    $('#products_desc_ar').val(response.data.product_name_ar);
                    $('#images1').attr('src', base_url + '/uploads/product/' + response.data.image1);
                    $('#images2').attr('src', base_url + '/uploads/product/' +  response.data.image2);
                    $('#images3').attr('src', base_url + '/uploads/product/' +  response.data.image3);
                    $('#images4').attr('src', base_url + '/uploads/product/' +  response.data.image4);
                    $('#imagehidden1').val(response.data.image1);
                    $('#imagehidden2').val(response.data.image2);
                    $('#imagehidden3').val(response.data.image3);
                    $('#imagehidden4').val(response.data.image4);

                    // $('#country_id').val(response.data.country_id);
                    $('#edit-country').modal('show');
                }
                else {
                    alert('Country data not found!');
                }
            }
        })

    });


    //MARK: - Update Product
    $('#save_product').click(function (e) {
        var save_product = $('#hidden_products_id').val();
        let formData = new FormData($('#edit-new-product')[0]);
        formData.append('hidden_products_id', save_product);
        $.ajax({
            url: base_url + "admin/Product/Update",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response);
                if (response.success === 'success' && response.data) {
                    showPopupAlert('success', 'Product updated...', true);
                }
                else {

                    if (response.errors.category_id) {
                        $('#category_edit_id_error').html(response.errors.category_id);
                    } else {
                        $('#category_edit_id_error').html('');
                    }

                    if (response.errors.products_name_ma) {
                        $('#products_edit_name_ma_error').html(response.errors.products_name_ma);
                    }
                    else {
                        $('#products_edit_name_ma_error').html('');
                    }

                    if (response.errors.products_name_en) {
                        $('#products_edit_name_en_error').html(response.errors.products_name_en);
                    }
                    else {
                        $('#products_edit_name_en_error').html('');
                    }
                    if (response.errors.products_name_hi) {
                        $('#products_edit_name_hi_error').html(response.errors.products_name_hi);
                    }
                    else {
                        $('#products_edit_name_hi_error').html('');
                    }

                    if (response.errors.products_name_ar) {
                        $('#products_edit_name_ar_error').html(response.errors.products_name_ar);
                    }
                    else {
                        $('#products_edit_name_ar_error').html('');
                    }

                    if (response.errors.products_desc_ma) {
                        $('#products_edit_desc_ma_error').html(response.errors.products_desc_ma);
                    }
                    else {
                        $('#products_edit_desc_ma_error').html('');
                    }


                    if (response.errors.products_desc_en) {
                        $('#products_edit_desc_en_error').html(response.errors.products_desc_en);
                    }
                    else {
                        $('#products_edit_desc_en_error').html('');
                    }

                    if (response.errors.products_desc_hi) {
                        $('#products_edit_desc_hi_error').html(response.errors.products_desc_hi);
                    }
                    else {
                        $('#products_edit_desc_hi_error').html('');
                    }

                    if (response.errors.products_desc_ar) {
                        $('#products_edit_desc_ar_error').html(response.errors.products_desc_ar);
                    }
                    else {
                        $('#products_edit_desc_ar_error').html('');
                    }

                    if (response.errors.image1) {
                        $('#products_edit_image1_error').html(response.errors.image1);

                    }
                    else {
                        $('#products_edit_image1_error').html('');
                    }

                    if (response.errors.image2) {
                        $('#products_edit_image2_error').html(response.errors.image2);
                    }
                    else {
                        $('#products_edit_image2_error').html('');
                    }

                    if (response.errors.image3) {
                        $('#products_edit_image3_error').html(response.errors.image3);
                    }
                    else {
                        $('#products_edit_image3_error').html('');
                    }

                    if (response.errors.image4) {
                        $('#products_edit_image4_error').html(response.errors.image4);
                    }
                    else {
                        $('#products_edit_image4_error').html('');
                    }

                    if (response.errors) {
                        // alert(response.errors);
                    }
                }
            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });




    $(document).on('click', '#checkbox_is_customizable', function () {
        if ($(this).is(':checked')) {
            $('#iscustomizablee_hidden').val(1);
        } else {
            $('#iscustomizablee_hidden').val(0);
        }
    });

    $(document).on('click', '#checkbox_is_addon', function () {
        if ($(this).is(':checked')) {
            $('#isaddon_hiddenn').val(1);
        } else {
            $('#isaddon_hiddenn').val(0);
        }
    });



    $(document).on('click', '#checkbox_is_customizable_edit', function () {
        if ($(this).is(':checked')) {
            $('#iscustomizable_hidden').val(1);
        } else {
            $('#iscustomizable_hidden').val(0);
        }
    });

    $(document).on('click', '#checkbox_is_addon_edit', function () {
        if ($(this).is(':checked')) {
            $('#isaddon_hidden').val(1);
        } else {
            $('#isaddon_hidden').val(0);
        }
    });



    //MARK:Delete product
    $(document).on('click', '.del_product', function () {
        var id = $(this).attr('data-id');
        confirmDelete(
            base_url + "admin/Product/Deleteproduct",
            id,
            '#deleteModal',   // confirmation modal
            '#confirmDeleteBtn',  // yes button
        );
    });
    //MARK:-Search product on keyup
    $('#search_admin_product').on('keyup', function () {
        var search = $(this).val();
        $.ajax({
            url: base_url + "admin/Product/searchProductOnadminKeyUp",
            type: 'GET',
            data: {
                search: search
            },
            success: function (response) {
                $('#search_result_admin_container').html(response);
            },
            error: function (xhr, status, error) {
                console.error('Error: ' + error);
            }
        })
    })


    //6. Load tables within iframe from add store
    $(document).on('click', '.qrcodes-modal', function (e) {
        var storeId = $(this).attr('data-id');
        // alert(storeId);
        var storeName = $(this).attr('data-name');
        // document.getElementById('modal_title_table').innerHTML = storeName + ' - Tables';
        document.getElementById('table_iframes').src = base_url + 'admin/table/load_store_Qr_code_tables_iframe/' + storeId;
    });



//MARK:  - Add Store
    $('#storeForm').on('submit', function (e) {
        e.preventDefault();
        // Clear previous error messages
        $('.errormsg').text('');

        let isValid = true;

        // Basic client-side validation
        if ($('#country_id').val() === '') {
            $('#country_error').text('Select country.');
            isValid = false;
        }

        if ($('#sel_gst_or_tax').val() === '') {
            $('#gst_or_tax_error').text('Select tax.');
            isValid = false;
        }

        if ($('#disp_name').val().trim() === '') {
            $('#disp_name_error').text('Enter display Name');
            isValid = false;
        }

        if ($('#location').val().trim() === '') {
            $('#error_location').text('Enter location');
            isValid = false;
        }

        if ($('#reg_name').val().trim() === '') {
            $('#name_error').text('Enter registered name');
            isValid = false;
        }

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test($('#email').val().trim())) {
            $('#email_error').text('Enter valid email address.');
            isValid = false;
        }

        const phonePattern = /^\d{10}$/;
        if (!phonePattern.test($('#phone').val().trim())) {
            $('#phone_error').text('Enter valid 10-digit phone number.');
            isValid = false;
        }



        if ($('input[name="contract_start_date"]').val() === '') {
            $('#error_contract_start_date').text('Enter start date.');
            isValid = false;
        }

        if ($('input[name="contract_end_date"]').val() === '') {
            $('#error_contract_end_date').text('Enter end date.');
            isValid = false;
        }

        if ($('input[name="next_followup_date"]').val() === '') {
            $('#error_next_followup_date').text('Enter followup date');
            isValid = false;
        }





        // Validate 'Default Language'
        if ($('#language').val() === '') {
            $('#error_language').text('Select language.');
            isValid = false;
        }

        // Validate 'Contact person name'
        if ($('#contact_person_name').val() === '') {
            $('#error_contact_person_name').text('Enter name.');
            isValid = false;
        }

        // Validate 'Contact person phone'
        if ($('#contact_person_phone').val() === '') {
            $('#error_contact_person_phone').text('Enter phone.');
            isValid = false;
        }

        // Validate 'Contact person designation'
        if ($('#contact_person_designation').val() === '') {
            $('#error_contact_person_designation').text('Select designation.');
            isValid = false;
        }

        // Username Validation
        if ($('#username').val().trim() === '') {
            $('#error_username').text('Enter Username');
            isValid = false;
        }

        // Password Validation
        if ($('#password').val().trim() === '') {
            $('#error_password').text('Enter Password');
            isValid = false;
        }

        // Username Validation
        if ($('#user_username').val().trim() === '') {
            $('#error_user_username').text('Enter username');
            isValid = false;
        }

        // Password Validation
        if ($('#user_password').val().trim() === '') {
            $('#error_user_password').text('Enter password');
            isValid = false;
        }

        if ($('#store_logo_image').val().trim() === '') {
            $('#error_store_logo_image').text('Choose logo image');
            isValid = false;
        }

        // If all validations pass, submit the form via AJAX
        if (isValid) {

            var form = $('#storeForm')[0]; // Get the form element
            var formData = new FormData(form); // Create FormData object
            $.ajax({
                url: base_url + 'admin/Store/add_store',  // Replace with your controller method
                type: 'POST',
                data: formData,
                contentType: false,  // Must be false for file upload
                processData: false,
                success: function (response) {
                    console.log(response);
                    location.reload();
                    window.location.href = base_url + 'admin/store/all';

                    // location.reload();
                },
                error: function (xhr, status, error) {
                    // Handle error
                    alert('An error occurred while submitting the form.');
                }
            });
        }
    });


    //16. Is whatsapp enable in add store
    $(document).on('click', '#is_whatsapp', function () {
        var isChecked = $(this).is(':checked') ? 1 : 0;
        $('#is_whatsapp_check').val(isChecked);
    })

    //2. Delete store
    // $(".del_store").click(function () {
    //     $('#store_id').val($(this).data('id'));
    // });

    $('#yes_del_store').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/store/delete',
            data: { 'id': $('#store_id').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/store';
            }
        });
    });

    //alert(111);


    //3. Change tax value depends on country
    $('#country_id').change(function () {
        var country_id = $(this).val();//alert(base_url);
        $.ajax({
            method: "POST",
            url: base_url + 'admin/store/getTaxRates',
            data: { 'country_id': country_id },
            success: function (data) {
                $('#sel_gst_or_tax').html(data);
            }
        });




// MARK: - Select Gst or Tax change

        $('#sel_gst_or_tax').change(function ()
        {
            var taxRate = $(this).val();
            var dataType = $(this).find('option:selected').data('type');
            // alert(dataType);

            if(dataType == 'vat'){
               $('#Tax_label').text('VAT Number');
               $('.textbox').removeClass('d-none');
                $('#Tax_label').removeClass('d-none');
            }else if(dataType == 'gst'){
                $('#Tax_label').text('GST Number');
                $('.textbox').removeClass('d-none');
                 $('#Tax_label').removeClass('d-none');
            }
            else{
                $('#Tax_label').addClass('d-none');
                  $('.textbox').addClass('d-none');
            }
        });
    });


    //4. Checkbox for store serving modes dining delivery and takeaway
    $('#checkbox_pickup_or_take_away').on('click', function () {
        if ($(this).is(':checked')) {
            $('#pickup_hidden').val(1);
        } else {
            $('#pickup_hidden').val(0);
        }
    });


    $('#checkbox_dining').on('click', function () {
        if ($(this).is(':checked')) {
            $('#dining_hidden').val(1);
        } else {
            $('#dining_hidden').val(0);
        }
    });

    $('#checkbox_delivery').on('click', function () {
        if ($(this).is(':checked')) {
            $('#delivery_hidden').val(1);
        } else {
            $('#delivery_hidden').val(0);
        }
    });



    //MARK: - Datepicker contract Date
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: new Date(), // Set minimum date if needed
        endDate: '+364d' // Set maximum date to 365 days in the future
    }).on('changeDate', function (e) {
        // Get the selected date as a JavaScript Date object
        var selectedDate = e.date;

        // Calculate the date 365 days after the selected date
        var dateAfter365Days = new Date(selectedDate);
        dateAfter365Days.setDate(dateAfter365Days.getDate() + 364);

        // Format the new date as 'yyyy-mm-dd'
        var formattedDateAfter365 =
            dateAfter365Days.getFullYear() + '-' +
            (dateAfter365Days.getMonth() + 1).toString().padStart(2, '0') + '-' +
            dateAfter365Days.getDate().toString().padStart(2, '0');

        // Update another input field with the date 365 days after the selected date in yyyy-mm-dd format
        $('#datepicker1').val(formattedDateAfter365);

        // Calculate the date 365 days after the selected date
        var dateAfter335Days = new Date(selectedDate);
        dateAfter335Days.setDate(dateAfter335Days.getDate() + 335);

        // Format the new date as 'yyyy-mm-dd'
        var formattedDateAfter335 =
            dateAfter335Days.getFullYear() + '-' +
            (dateAfter335Days.getMonth() + 1).toString().padStart(2, '0') + '-' +
            dateAfter335Days.getDate().toString().padStart(2, '0');

        // Update another input field with the date 365 days after the selected date in yyyy-mm-dd format
        $('#datepicker2').val(formattedDateAfter335);
    });


    //6. Load tables within iframe from add store
    $('.store_table').click(function () {
        var storeId = $(this).attr('data-id');
        var storeName = $(this).attr('data-name');
        document.getElementById('modal_title_table').innerHTML = storeName + ' - Tables';
        document.getElementById('table_iframe').src = base_url + 'admin/table/load_store_tables_iframe/' + storeId;
    });




    //7. Send test message dining,pickup,delivery
    $('#send_pickup_test_message').click(function () {
        const phoneNumber = $('#pickup_country_code').val() + $('#txt_pickup_or_take_away')
            .val(); // Replace with the recipient's phone number
        const message = 'Hello, this is a test message!'; // The message to send
        const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank');
        return false;
    })

    $('#send_dining_test_message').click(function () {
        const phoneNumber = $('#dining_country_code').val() + $('#txt_dining')
            .val(); // Replace with the recipient's phone number
        const message = 'Hello, this is a test message!'; // The message to send
        const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank');
    })

    $('#send_delivery_test_message').click(function () {
        const phoneNumber = $('#delivery_country_code').val() + $('#txt_delivery')
            .val(); // Replace with the recipient's phone number
        const message = 'Hello, this is a test message!'; // The message to send
        const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank');
    })

    function updateOrderIndex(id, order_index) {
        $.ajax({
            url: base_url + 'admin/categories/update_order_index',
            method: 'POST',
            data: {
                id: id,
                order_index: order_index
            },
            success: function (response) {
                showPopupAlert('success', 'Order updated...', true);
             },
            error: function (xhr, status, error) {
                console.error('Error updating order index');
            }
        });
    }

    //10. delete category
    $(".del_category").click(function () {
        $('#category_id').val($(this).data('id'));
    });

    $('#yes_del_category').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/categories/delete',
            data: { 'id': $('#category_id').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/categories';
            }
        });
    });

    //delete tax
    $(".del_tax").click(function () {
        $('#tax_id').val($(this).data('id'));
    });

    $('#yes_del_tax').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/tax/delete',
            data: { 'id': $('#tax_id').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/tax';
            }
        });
    });
    //delete tax


    //Delete User
    $(".del_user").click(function () {
        $('#user_id').val($(this).data('id'));
    });

    $('#yes_del_user').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/user/delete',
            data: { 'id': $('#user_id').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/user';
            }
        });
    });
    //delete user

    //delete package
    $(".del_package").click(function () {
        $('#package_id1').val($(this).data('id'));
    });

    $('#yes_del_package').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/package/delete',
            data: { 'id': $('#package_id1').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/package';
            }
        });
    });
    //delete package


    //13. Delete cookings from admin dashboard
    $(".del_cooking").click(function () {
        $('#cooking_id').val($(this).data('id'));
    });

    $('#yes_del_cooking').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/cooking/delete',
            data: { 'id': $('#cooking_id').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/cooking';
            }
        });
    });

    //14.delete variants from admin dashboard
    $(".del_variant").click(function () {
        //alert('click');
        $('#variant_id').val($(this).data('id'));
    });

    $('#yes_del_variant').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + 'admin/variants/delete',
            data: { 'id': $('#variant_id').val() },
            success: function (data) {
                window.location.href = base_url + 'admin/variants';
            }
        });
    });











    //11.Image Cropping from Add Product page
    const imageInput = document.getElementById("imageInput");
    const imagePreview = document.getElementById("imagePreview");
    const imageEditor = document.getElementById("imageEditor");
    const editorCanvas = document.getElementById("editorCanvas");
    const saveEdit = document.getElementById("saveEdit");
    const closeEditor = document.getElementById("closeEditor");
    let cropper = null;
    let currentImage = null;

    // Handle image input
    imageInput.addEventListener("change", (e) => {
        const files = e.target.files;

        const currentImages = imagePreview.querySelectorAll(".image-container").length;

        // If the total exceeds 5, prevent further action
        if (currentImages + files.length > 5) {
            alert("You can only upload a maximum of 5 images.");
            return;
        }

        Array.from(files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = (event) => {
                const container = document.createElement("div");
                container.classList.add("image-container");

                const img = document.createElement("img");
                img.src = event.target.result;

                const editBtn = document.createElement("button");
                editBtn.textContent = "Edit";
                editBtn.classList.add("edit-btn");
                editBtn.addEventListener("click", () => openEditor(img));

                container.appendChild(img);
                container.appendChild(editBtn);
                imagePreview.appendChild(container);
            };
            reader.readAsDataURL(file);
        });
    });

    // Open image editor
    function openEditor(img) {
        currentImage = img;
        const ctx = editorCanvas.getContext("2d");
        const image = new Image();
        image.src = img.src;
        image.onload = () => {
            editorCanvas.width = image.width / 2;
            editorCanvas.height = image.height / 2;
            ctx.drawImage(image, 0, 0, editorCanvas.width, editorCanvas.height);

            // Initialize Cropper.js
            cropper = new Cropper(editorCanvas, {
                aspectRatio: 1,
                viewMode: 1,
            });
        };

        imageEditor.style.display = "block";
        overlay.style.display = "block";
    }

    // Save edited image
    saveEdit.addEventListener("click", () => {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas();
            currentImage.src = canvas.toDataURL();
            cropper.destroy();
            cropper = null;
            imageEditor.style.display = "none";
        }
    });

    // Close editor
    closeEditor.addEventListener("click", () => {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        imageEditor.style.display = "none";
    });




    $('#saveProduct').click(function () {

        let formData = new FormData($('#productForm')[0]); // Capture the form data, including files

        $.ajax({
            url: base_url + 'admin/Product/save',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the Content-Type header
            success: function (response) {
                console.log(response.success);

                if (response.errors) {
                    if (response.errors.category_id) {
                        $('#category_id_error').html(response.errors.category_id);
                    } else if (response.errors.subcategory_id) {
                        $('#subcategory_id_error').html(response.errors.subcategory_id);
                    } else if (response.errors.product_veg_nonveg) {
                        $('#product_veg_nonveg_error').html(response.errors
                            .product_veg_nonveg);
                    } else if (response.errors.product_name_ma) {
                        $('#product_name_ma_error').html(response.errors.product_name_ma);
                    } else if (response.errors.product_name_en) {
                        $('#product_name_en_error').html(response.errors.product_name_en);
                    } else if (response.errors.product_name_hi) {
                        $('#product_name_hi_error').html(response.errors.product_name_hi);
                    } else if (response.errors.product_name_ar) {
                        $('#product_name_ar_error').html(response.errors.product_name_ar);
                    }
                } else {
                    // alert('success');
                    window.location.href = base_url + 'admin/Product';
                }

            },
            error: function (xhr) {
                $('#response').html('<p>An error occurred: ' + xhr
                    .responseText +
                    '</p>');
            }
        });
    });

    //..   Crop image when edit product
    var cropper1;

    // Trigger cropper modal when image is clicked
    $('.image-to-crop').click(function () {
        var imageSrc = $(this).attr('src');
        var dataId = $(this).attr('id');
        $('#image-to-crop-modal').attr('src', imageSrc);

        // Destroy existing cropper if any
        if (cropper1) {
            cropper1.destroy();
        }

        // Initialize the cropper on the modal image
        $('#cropper-modal').modal('show');
        $('#hiddenImgId').val(dataId);
        var image = document.getElementById('image-to-crop-modal');
        cropper1 = new Cropper(image, {
            aspectRatio: 1, // Optional: change aspect ratio if needed
            viewMode: 1,
            scalable: true,
            zoomable: true,
            movable: true
        });
    });

    // Crop the image and upload
    $('#crop-button').click(function () {
        var croppedCanvas = cropper1.getCroppedCanvas();
        var croppedImage = croppedCanvas.toDataURL('image/jpeg'); // Get cropped image data
        var fileName = 'cropped-image-' + new Date().getTime() + '.jpg';
        $.ajax({
            url: '<?= base_url("admin/Product/update_image") ?>',
            method: 'POST',
            dataType: 'json',
            data: {
                image: croppedImage,
                imageId: $('#hiddenImgId').val(),
                file_name: fileName // Send file name for saving
            },
            success: function (response) {
                console.log(response);

                $('.image-to-crop[src="' + $('#image-to-crop-modal').attr(
                    'src') + '"]')
                    .attr('src', croppedImage);

                // Hide the modal after updating
                $('#cropper-modal').modal('hide');
                if (response.imageId == 'previewImage1') {
                    $('#imghidden1').val(response.filename);
                }
                if (response.imageId == 'previewImage2') {
                    $('#imghidden2').val(response.filename);
                }
                if (response.imageId == 'previewImage3') {
                    $('#imghidden3').val(response.filename);
                }
                if (response.imageId == 'previewImage4') {
                    $('#imghidden4').val(response.filename);
                }
                if (response.imageId == 'previewImage5') {
                    $('#imghidden5').val(response.filename);
                }
            },
            error: function () {
                alert('Failed to update the image.');
            }
        });
    });

    // Handle real-time image preview when files are selected
    function previewImage(inputId, previewImageId, imgHidden) {
        $(inputId).on('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const filename = file.name;
                $(imgHidden).val(filename);
                const reader = new FileReader();
                reader.onload = function (e) {
                    $(previewImageId).attr('src', e.target
                        .result); // Update the preview image
                };
                reader.readAsDataURL(file); // Read the file as a data URL
                var formData = new FormData();
                formData.append("file", file);
                $.ajax({
                    url: '<?= base_url("admin/Product/update_image1") ?>',
                    method: 'POST',
                    data: formData,
                    contentType: false, // Don't set contentType
                    processData: false,
                    success: function (response) { }
                });
            }
        });
    }

    // Bind preview image functionality to file inputs
    previewImage('#preview1', '#previewImage1', '#imghidden1');
    previewImage('#preview2', '#previewImage2', '#imghidden2');
    previewImage('#preview3', '#previewImage3', '#imghidden3');
    previewImage('#preview4', '#previewImage4', '#imghidden4');
    previewImage('#preview5', '#previewImage5', '#imghidden5');













});