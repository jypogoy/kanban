$(function () {
    
    loadWorkflowList();    

    $('#workflowTable tbody').sortable({
        cursor: 'move',
        update:function(event, ui){
            let el = $(this).data().uiSortable.currentItem;
            console.log(el[0].innerText);
        }
    }).disableSelection();
    
    $('#btnAddWorkflow').on('click', function () {       
        $('#board_id').val($('#boardId').val());       
        $('#newActions').show();
        $('#editActions').hide();
        workFlowModal.show();
        Form.reset(); // See form.js
    });
});

function loadWorkflowList() {    
    $.get('../../workflows/listbyboard/' + $('#boardId').val(), function (data) {
        $('#workflowTable tbody tr').remove();
        for (let i = 0; i < data.length; i++) {
            const rec = data[i];
            $('#workflowTable tbody').append(
                '<tr>' +
                '<td><div data-tooltip="Move" data-position="right center"><i class="ellipsis vertical icon move"></i><i class="ellipsis vertical icon move pair"></i></div></td>' +
                '<td>' + rec.name + '</td>' + 
                '<td>' + rec.description + '</td>' + 
                '<td>' +
                    '<a class="ui icon" data-tooltip="Edit" data-position="bottom center" onclick="editWorkflow(' + rec.id + ');">' +
                        '<i class="edit icon"></i>' +
                    '</a>' +
                    '<a class="ui icon" onclick="del(this, \'' + rec.id + '\', \'' + rec.name + '\'); return false;" data-tooltip="Delete" data-position="bottom center">' +
                        '<i class="remove red icon"></i>' +
                    '</a>' +
                '</td>' +
                '</tr>');                                              
        }    
        
        if (data.length == 0) {
            $('#workflowTable tbody').append('<tr><td colspan="4">No workflows to show...</td></tr>'); 
        }        
    })
    .done(function (data) {
        $('.loader').fadeOut();
    })
    .fail(function (xhr, status, error) {
        toastr.error(error);
    });
}

function editWorkflow(id) {    
    $.post('../../workflows/get/' + id, function (data) {
        $('form *').filter(':input').each(function () {
            var el = this;
            el.value = data[0][el.id]; 
        });  
       
        $('#newActions').hide();
        $('#editActions').show();
        workFlowModal.show();
        Form.reset(true); // See form.js
    })
    .done(function (msg) {
        // Do nothing...
    })
    .fail(function (xhr, status, error) {
        toastr.error(error);
    });
}

function saveWorkflow(isSaveNew) {    
    var isValid = Form.validate(true, isSaveNew); // See form.js (isAjax, isSaveNew)   
    if (isValid) {        
        var id = $('#id').val();
        var boardId = $('#board_id').val(); // Keep reference of the board
        var action = id ? '../../workflows/ajaxsave' : '../../workflows/ajaxcreate';
        
        $.post(action, $('form').serialize(), function (msg) {  
            // Do nothing...      
        })
        .done(function (msg) {
            toastr.success(msg);
            if (isSaveNew) {
                Form.reset(); // See form.js
                $('#board_id').val(boardId); // Fill board if save and new                                          
            } else {                
                workFlowModal.hide();
            }
            $('.loader').fadeIn();
            loadWorkflowList();
        })
        .fail(function (xhr, status, error) {
            toastr.error(error);
        });
    }    
}

function del(actionEl, id, name) {

    $('.custom-text').html('<p>Are you sure you want to delete workflow <strong>' + name + '</strong>? Click OK to proceed.</p>');

    $('.ui.tiny.modal.delete.workflow')
    .modal({
        inverted : true,
        closable : true,
        observeChanges : true, // <-- Helps retain the modal position on succeeding show.
        onDeny : function(){
            // Do nothing
        },
        onApprove : function() {
            var action = '../../workflows/ajaxdelete/' + id;
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

var workFlowModal = {
    show : function () {
        $('.ui.tiny.modal.flow')
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
    },
    hide : function () {
        $('.ui.tiny.modal.flow').modal('hide');
    }
}