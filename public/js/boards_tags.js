$(function () {
    
    loadTagList();    

    $('#tagTable tbody').sortable({
        cursor: 'move',
        update:function(event, ui){
            let el = $(this).data().uiSortable.currentItem;
            console.log(el[0].innerText);
        }
    }).disableSelection();

    $('#btnAddTag').on('click', function () {        
        $('#board_id').val($('#boardId').val());       
        $('#newTagActions').show();
        $('#editTagActions').hide();
        TagModal.show();
        Form.reset(); // See form.js        
    });    
});

function loadTagList() {
    $.get('../../tags/listbyboard/' + $('#boardId').val(), function (data) {
        $('#tagTable tbody tr').remove();
        for (let i = 0; i < data.length; i++) {
            const rec = data[i];
            $('#tagTable tbody').append(
                '<tr>' +
                '<td>' + rec.name + '</td>' + 
                '<td>' + rec.description + '</td>' + 
                '<td>' +
                    '<a class="ui icon" data-tooltip="Edit" data-position="bottom center" onclick="editWorkflow(' + rec.id + ');">' +
                        '<i class="edit icon"></i>' +
                    '</a>' +
                    '<a class="ui icon" onclick="delTag(this, \'' + rec.id + '\', \'' + rec.name + '\'); return false;" data-tooltip="Delete" data-position="bottom center">' +
                        '<i class="remove red icon"></i>' +
                    '</a>' +
                '</td>' +
                '</tr>');                                              
        }    
        
        if (data.length == 0) {
            $('#tagTable tbody').append('<tr><td colspan="4">No tags to show...</td></tr>'); 
        }        
    })
    .done(function (data) {
        $('.loader').fadeOut();
    })
    .fail(function (xhr, status, error) {
        toastr.error(error);
    });
}

function saveTag(isSaveNew) {    
    var isValid = Form.validate(true, isSaveNew); // See form.js (isAjax, isSaveNew)   
    if (isValid) {        
        var id = $('#id').val();
        var boardId = $('#board_id').val(); // Keep reference of the board
        var action = id ? '../../tags/save' : '../../workflows/ajaxcreate';
        
        $.post(action, $('form').serialize(), function (msg) {  
            // Do nothing...      
        })
        .done(function (msg) {
            toastr.success(msg);
            if (isSaveNew) {
                Form.reset(); // See form.js
                $('#board_id').val(boardId); // Fill board if save and new                                          
            } else {                
                TagModal.hide();
            }
            $('.loader').fadeIn();
            loadWorkflowList();
        })
        .fail(function (xhr, status, error) {
            toastr.error(error);
        });
    }    
}

function delTag(actionEl, id, name) {

    $('.custom-text').html('<p>Are you sure you want to delete tag <strong>' + name + '</strong>? Click OK to proceed.</p>');

    $('.ui.tiny.modal.delete.tag')
    .modal({
        inverted : true,
        closable : true,
        observeChanges : true, // <-- Helps retain the modal position on succeeding show.
        onDeny : function(){
            // Do nothing
        },
        onApprove : function() {
            var action = '../../tags/ajaxdelete/' + id;
            $.post(action, function (msg) {  
                // Do nothing...      
            })
            .done(function (msg) {            
                var row = $(actionEl).closest('tr');
                highlightOnDelete(row); // See list.js
                toastr.success(msg); // See toaster.js
            })
            .fail(function (xhr, status, error) {
                toastr.error(error);
            });
        }
    })
    .modal('show');

}

var TagModal = {
    show : function () {
        $('.ui.tiny.modal.tag.form')
        .modal('setting',
        {
            inverted : true,
            closable : true,
            onDeny : function(){
                // Do nothing
            },
            onApprove : function() {
                //window.location = 'boards/delete/' + id;
            }
        })
        .modal('setting', { detachable:false })
        .modal('show');
        $('.ui.dropdown').dropdown();
    },
    hide : function () {
        $('.ui.tiny.modal.tag').modal('hide');
    }
}