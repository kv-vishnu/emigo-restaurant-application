//MARK: Show popup alert
export function showPopupAlert(type, message, reload = false, hideAfter = 2000)
{
    //alert('showPopupAlert');
    let modalId = (type === 'success') ? '#successModal' : '#errorModal';
    $(modalId + ' .modal-body').text(message);
    $(modalId).modal('show');
    setTimeout(function () {
        $(modalId).modal('hide');
        if (reload) {
            location.reload();
        }
    }, hideAfter);
}

//MARK: - Delete confirmation
export function confirmDelete(deleteUrl, idField, confirmModal, yesButton, modalToHide = null)
{
    $(confirmModal + ' #delete_id').val(idField);
    if (modalToHide) {
        $(modalToHide).modal('hide');
    }
    $(confirmModal).modal('show');
    $(yesButton).off('click').on('click', function () {
        $.ajax({
            method: "POST",
            url: deleteUrl,
            data: {
                'id': $(confirmModal + ' #delete_id').val()
            },
            success: function (response) {
                /* alert(response) */
                console.log(response);
                location.reload();
            }
        });
    });
}

//MARK: - Enable Disable confirmation
export function enable_disable_confirmation(deleteUrl, idField, confirmModal, yesButton, modalToHide = null)
{
    $(confirmModal + ' #enabledisable_id').val(idField);
    if (modalToHide) {
        $(modalToHide).modal('hide');
    }
    $(confirmModal).modal('show');
    $(yesButton).off('click').on('click', function () {
        $.ajax({
            method: "POST",
            url: deleteUrl,
            data: {
                'id': $(confirmModal + ' #enabledisable_id').val()
            },
            success: function (response) {
                /* alert(response) */
                console.log(response);
                location.reload();
            }
        });
    });
}

