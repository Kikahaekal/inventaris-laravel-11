$('#addModal').on('shown.bs.modal', function () {
    $('#categoriesAddModal').select2({
        dropdownParent: $('#addModal')
    });
});

$('[id^="editModal"]').on('shown.bs.modal', function () {
    $(this).find('#categoriesEditModal').select2({
        dropdownParent: $(this) // Set parent dropdown agar tetap dalam modal
    });
});