$(function () {
    
    loadWorkflowList();    

    // Sortable rows. See jquery-sortable.js
    // $( ".sorted_table").sortable({
    //     containerSelector: 'table',
    //     itemPath: '> tbody',
    //     itemSelector: 'tr',
    //     placeholder: '<tr class="placeholder"/>'
    // });

    // Sortable column heads
    var oldIndex;
    $('.sorted_table tr').sortable({
        containerSelector: 'tr',
        itemSelector: 'th',
        placeholder: '<th class="placeholder"/>',
        vertical: false,
        onDragStart: function ($item, container, _super) {
            oldIndex = $item.index();
            $item.appendTo($item.parent());
            _super($item, container);
        },
        onDrop: function  ($item, container, _super) {
            var field,
                newIndex = $item.index();

            if(newIndex != oldIndex) {
            $item.closest('table').find('tbody tr').each(function (i, row) {
                row = $(row);
                if(newIndex < oldIndex) {
                row.children().eq(newIndex).before(row.children()[oldIndex]);
                } else if (newIndex > oldIndex) {
                row.children().eq(newIndex).after(row.children()[oldIndex]);
                }
            });
            }

            _super($item, container);
        }
    });

    $('#btnAddWorkflow').on('click', function () {
        clear(); // See form.js
        $('#board_id').val($('#boardId').val());
       
        $('#newActions').show();
        $('#editActions').hide();
        modals.showWorkflow();
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
    clear(); // See form.js
    $.post('../../workflows/get/' + id, function (data) {
        $('form *').filter(':input').each(function () {
            var el = this;
            el.value = data[0][el.id]; 
        });  
       
        $('#newActions').hide();
        $('#editActions').show();
        modals.showWorkflow();
    })
    .done(function (msg) {
        // Do nothing...
    })
    .fail(function (xhr, status, error) {
        toastr.error(error);
    });
}

function saveWorkflow(isSaveNew) {    
    var isValid = Form.validate(true); // See form.js    
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
                clear(); // See form.js
                $('#board_id').val(boardId); // Fill board if save and new                                          
            } else {                
                modals.hideWorkflow();
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

    $('.ui.tiny.modal.delete')
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
                highlightOnDelete(row);              
            })
            .fail(function (xhr, status, error) {
                toastr.error(error);
            });
        }
    })
    .modal('show');

}

var modals = {
    showWorkflow : function () {
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
    hideWorkflow : function () {
        $('.ui.tiny.modal.flow').modal('hide');
    }
}