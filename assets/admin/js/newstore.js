 //1. Add Store
//MARK: - Import
 $(document).ready(function () {

   var base_url = 'http://localhost/emigo-restaurant-application/';
    //  var base_url = 'https://qr-experts.com/emigo-restaurant-application/';

    //MARK: -  Add Store
    $('#storeForm').on('submit', function (e) {
        e.preventDefault();
        $('.errormsg').text('');

        let isValid = true;

        // Basic client-side validation
        if ($('#country_id').val() === '') {
            $('#country_error').text('Select country.');
            isValid = false;
        }
        if ($('#sel_gst_or_tax').val() === '') {
            $('#gst_or_tax_error').text('Select Tax.');
            isValid = false;
        }
        if ($('#disp_name').val().trim() === '') {
            $('#disp_name_error').text('Enter display name');
            isValid = false;
        }
        if ($('#reg_name').val().trim() === '') {
            $('#name_error').text('Enter registered name');
            isValid = false;
        }
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test($('#email').val().trim())) {
            $('#email_error').text('Enter a valid email address.');
            isValid = false;
        }

        const phonePattern = /^\d{10}$/;
        if (!phonePattern.test($('#phone').val().trim())) {
            $('#phone_error').text('Enter a valid 10-digit phone number.');
            isValid = false;
        }

        if ($('#address').val().trim() === '') {
            $('#address_error').text('Enter address');
            isValid = false;
        }

        // if ($('#store_desc').val().trim() === '') {
        //     $('#store_desc_error').text('Description is required.');
        //     isValid = false;
        // }

        if ($('input[name="contract_start_date"]').val() === '') {
            $('#error_contract_start_date').text('Enter contract start date');
            isValid = false;
        }

        if ($('input[name="contract_end_date"]').val() === '') {
            $('#error_contract_end_date').text('Enter contract end date');
            isValid = false;
        }

        if ($('input[name="next_followup_date"]').val() === '') {
            $('#error_next_followup_date').text('Enter followup date');
            isValid = false;
        }

        // if ($('input[name="followup_remarks"]').val() === '') {
        //     $('#error_followup_remarks').text('Followup remark is required.');
        //     isValid = false;
        // }


        // Validate 'Select Package'
        if ($('#no_of_tables').val() === '') {
            $('#error_no_of_tables').text('Select package.');
            isValid = false;
        }

        // Validate 'Trade License'
        // if ($('#trade_license').val().trim() === '') {
        //     $('#error_trade_license').text('Trade license is required.');
        //     isValid = false;
        // }

        // Validate 'Location'
        if ($('#location').val().trim() === '') {
            $('#error_location').text('Enter location');
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
        // if ($('#username').val().trim() === '') {
        //     $('#error_username').text('Enter username');
        //     isValid = false;
        // }

        // Password Validation
        // if ($('#password').val().trim() === '') {
        //     $('#error_password').text('Enter password');
        //     isValid = false;
        // }

        // Username Validation
        // if ($('#user_username').val().trim() === '') {
        //     $('#error_user_username').text('Enter username.');
        //     isValid = false;
        // }

        // Password Validation
        // if ($('#user_password').val().trim() === '') {
        //     $('#error_user_password').text('Enter password.');
        //     isValid = false;
        // }

        if ($('#store_logo_image').val().trim() === '') {
            $('#error_store_logo_image').text('Choose logo image');
            isValid = false;
        }

        // If all validations pass, submit the form via AJAX
        if (isValid) {

            var form = $('#storeForm')[0]; // Get the form element
            var formData = new FormData(form); // Create FormData object
            $.ajax({
                url: base_url + 'admin/Newstore/add_store',  // Replace with your controller method
                type: 'POST',
                data: formData,
                contentType: false,  // Must be false for file upload
                processData: false,
                success: function (response) {
                    $("button[type=submit]").prop("disabled", true).text("SAVED");
                    alert('Store details saved...');
                    $('#storeForm').trigger("reset");
                    $("button[type=submit]").prop("disabled", false).text("SAVE");
                },
                error: function (xhr, status, error) {
                    // Handle error
                    alert('An error occurred while submitting the form.');
                }
            });
        }
    });


     //2. Change tax value depends on country
    $('#country_id').change(function () {
        var country_id = $(this).val();

        // alert(country_id);
        $.ajax({
            method: "POST",
            url: base_url + 'admin/Newstore/getTaxRates',
            data: { 'country_id': country_id },
            success: function (data) {
                console.log(data);

                $('#sel_gst_or_tax').html(data);
            }
        });
    });

    //MARK:  - Select Gst or Tax change in New Store

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


     //5. Datepicker contract start end followup dates
    $('#datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: new Date(), // Set minimum date if needed
        endDate: '+364d' // Set maximum date to 365 days in the future
    }).on('changeDate', function (e) {
        // Get the selected date as a JavaScript Date object
        var selectedDate = e.date;
        // alert(selectedDate);

        // Calculate the date 365 days after the selected date
        var dateAfter365Days = new Date(selectedDate);
        dateAfter365Days.setDate(dateAfter365Days.getDate() + 364);

        // Format the new date as 'yyyy-mm-dd'
        var formattedDateAfter365 =
            dateAfter365Days.getFullYear() + '-' +
            (dateAfter365Days.getMonth() + 1).toString().padStart(2, '0') + '-' +
            dateAfter365Days.getDate().toString().padStart(2, '0');
            // alert(formattedDateAfter365);

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
});


