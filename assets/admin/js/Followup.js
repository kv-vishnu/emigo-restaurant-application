//MARK: - Import
import { showPopupAlert,confirmDelete } from './common.js';
$(document).ready(function () {



    var base_url = $('#base_url').val();
    $(document).on('click', '.emigo-close-btn , .reload-close-btn, .emigo-btn', function () {
        location.reload();
    });

//MARK: - Add Followup
$('#add_followup').click(function (e) {
    let formData = new FormData($('#add-new-followup')[0]);
    let storeId = $('#store_id').val();
    formData.append('store_id', storeId);
    $.ajax({
       url: base_url + 'admin/Followup/add',
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
                success: function (response) {
                if (response.success === 'success') {
                    showPopupAlert('success', 'Followup details saved...', true);
                } else {
                       $('#followup_user_error').html('')
                       $('#followup_date_error').html('')
                       $('#followup_remarks_error').html('')
                        // Handle field-specific validation errors
                        if (response.errors.followup_user) {
                            $('#followup_user_error').html(response.errors.followup_user);
                        }

                        if (response.errors.followup_date) {
                            $('#followup_date_error').html(response.errors.followup_date);
                        }

                        if (response.errors.followup_remarks) {
                            $('#followup_remarks_error').html(response.errors.followup_remarks);
                        }


                }
            },
            error: function (xhr, status, error) {
                // Handle error
                alert('An error occurred while submitting the form.');
            }
    })
})


// MARK: - Edit Followup

$(".edit_followup").click(function (e)
{
        var id = $(this).attr('data-id');
        $('#hidden_followup_id').val(id);
        $.ajax({
            url: base_url + 'admin/Followup/edit',
            type: 'POST',
            data: { 'id': id },
            dataType: 'json',
            success: function (response) {
                console.log(response.data);
                if (response.success === 'success') {
                    $('#followup_edit_user').val(response.data.entered_user);
                    $('#followup_edit_date').val(response.data.date_and_time);
                    $('#followup_edit_remarks').val(response.data.remark);
                    $('#edit-followup').modal('show');
                }
                else {
                    alert('Followup data not found!');
                }
            }
        })
});


// MARK: - Save Followup

$('#save_followup').click(function (e)
{
        var save_followup = $('#hidden_followup_id').val();
        let formData = new FormData($('#edit_save_followup')[0]);
        formData.append('hidden_followup_id', save_followup);
        $.ajax({
            url: base_url + "admin/Followup/update",
            type: 'POST',
            data: formData,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                if (response.success === 'success') {
                      showPopupAlert('success', 'Record updated...', true);
                }

                else {

                    if (response.errors.followup_edit_user) {
                        $('#followup_edit_user_error').html(response.errors.followup_edit_user);
                    } else {
                        $('#followup_edit_user_error').html('');
                    }

                    if (response.errors.followup_edit_date) {
                        $('#followup_edit_date_error').html(response.errors.followup_edit_date);
                    } else {
                        $('#followup_edit_date_error').html('');
                    }

                    if (response.errors.followup_edit_remarks) {
                        $('#followup_edit_remarks_error').html(response.errors.followup_edit_remarks);
                    }
                    else {
                        $('#followup_edit_remarks_error').html('');
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

//MARK: - Delete Followup

$("#delete_followup").click(function (e)
{
        var id = $(this).attr('data-id');
        confirmDelete(
            base_url + "admin/Followup/delete",
            id,
            '#deleteModal',   // confirmation modal
            '#confirmDeleteBtn',  // yes button
        );
});
});