$(function() {
    
    $('.loader').fadeOut();

    $('.ui.dropdown').dropdown();

    $('#listForm').form({});

    $('#resetBtn').click(function () {
        $('#fieldKeyword').val('');
        $('#listForm').submit();
    });

});

function del(id, name) {

    $('.custom-text').html('<p>Are you sure you want to delete board <strong>' + name + '</strong>? Click OK to proceed.</p>');

    $('.ui.tiny.modal.delete')
    .modal({
        inverted : true,
        closable : true,
        observeChanges : true, // <-- Helps retain the modal position on succeeding show.
        onDeny : function(){
            // Do nothing
        },
        onApprove : function() {
            window.location = 'boards/delete/' + id;
        }
    })
    .modal('show');

}

function sort(sortField, sortDirection) {
    $('#sortField').val(sortField);
    $('#sortDirection').val(sortDirection);
    $('#listForm').submit();
}