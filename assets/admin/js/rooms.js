$(document).ready(function () {

     var base_url = $('#base_url').val();
     
//1. add the room
$('#addrooms').click(function (e) {
    var formData = new FormData($('#addroomsform')[0]);
    $.ajax({
        url: base_url + 'admin/Rooms/add',
        type: 'POST',
        data: formData,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.success === 'success') {
                $('#roomselect_error').html('');
                location.reload();
            } else {
                if (data.errors.roomselect) {
                    $('#roomselect_error').html(data.errors.roomselect);
                } else {
                    $('#roomselect_error').html('');
                }
            }
        }
    });
});


//2.room name textbox enable when edit button is clicks

     $(document).on('click', '.edit_rooms', function () {
        // alert('edit');
     var row = $(this).closest('tr'); // Find the parent row
     row.find('.editable_room').removeAttr('readonly').focus();
    })


        // common function for modal

function show_message_modal(message) {
    console.log(message);

     $('#successModal .modal-body').html(message);
    $('#successModal').modal('show');
    setTimeout(function () {
        $('#successModal').modal('hide');
         setTimeout(function () {
            window.location.reload();
        }, 500); // small delay to ensure modal finishes hiding
    }, 1000);

}


//3. room name  change when textbox enter the data


$(document).on('blur', '.editable_room', function () {
        let row = $(this).closest('tr');
        let tableId = row.find('.editable_room').data('id'); // Get table ID from any input
        let tableName = row.find('[data-field="table_name"]').text().trim();
        let storeTableName = row.find('[data-field="store_table_name"]').val(); // Get store_table_name
        // alert(tableName);
        // alert(tableId);
        // alert(storeTableName);
        $.ajax({
            url: base_url + "admin/Rooms/UpdateRoom",
            method: 'POST',
            data: { tableid: tableId, tablename:tableName, store_table_name: storeTableName },
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                   show_message_modal(response.message);
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

//4. delete the room in admin side


    $(".del_room").click(function (e) {
        var id = $(this).attr('data-id');
        // alert(id);
        $('#room_id').val(id);
        $('#delete-room').modal('show');


    });

    $('#yes_del_room').click(function () {
        $.ajax({
            method: "POST",
            url: base_url + "admin/Rooms/DeleteRoom",
            data: {
                'id': $('#room_id').val()
            },
            success: function (data) {
                console.log(data);
                location.reload();
            }
        });
    });


// 5 generate room qr code function

$(document).on('click', '.qr-code', function (e) {
    var table_id = $(this).attr('data-id');
    var store_id = $(this).attr('data-store-id');
    var store_name = $(this).attr('store-name');
    // var $this = $(this);

// Add class to <a> tag
// $this.removeClass('tblQrcodeBtn');
// $this.addClass('tblEditBtn');

// Update <i> icon inside <a>
// $this.find('i')
//      .removeClass('fa-upload')
//      .addClass('fa-download');
    $.ajax({
        url: base_url + "admin/Qrcodes/GenerateRoomQrCode",
        method: 'POST',
        data: { table_id: table_id, store_id: store_id, store_name: store_name },
        dataType: 'json',
        success: function (response) {
            console.log(response);

            if (response.status === 'success') {
                show_message_modal(response.message);

            } else {
                // show_message_modal(response.message);
                console.error('Error updating record');
            }
        },
        error: function (error) {
            console.error('Error:', error);
        }
    });


});






});