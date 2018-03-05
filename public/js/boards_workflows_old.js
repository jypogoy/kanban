$(function () {
    // Sortable rows
    $( ".sorted_table").sortable({
        containerSelector: 'table',
        itemPath: '> tbody',
        itemSelector: 'tr',
        placeholder: '<tr class="placeholder"/>'
    });

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
        $('#project_id').val($('#projectId').val());
        modals.showWorkflow();
    });
});

function editWorkflow(id) {
    clear(); // See form.js
    $.post('../../workflows/get/' + id, function (data) {
        $('form *').filter(':input').each(function () {
            var el = this;
            el.value = data[0][el.id]; 
        });  
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
        var form = $('#dataForm_Workflow')[0];
        form.action = id ? '../../workflows/save' : '../../workflows/create';
        form.submit();
        
        // $.post(action, $('form').serialize(), function (msg) {  
        //     alert(msg);  
        //     var startPos = msg.indexOf('>') + 1;
        //     var endPos = msg.indexOf('<', startPos);
        //     var textMsg = msg.substring(startPos, endPos);  
        //     if (msg.indexOf('danger') != -1) {                
        //         toastr.error(textMsg);
        //     } else if (msg.indexOf('success') != -1) {                
        //         toastr.success(textMsg);
        //     }            
        // })
        // .done(function (msg) {
        //     if (isSaveNew) {
        //         clear(); // See form.js
        //     } else {                
        //         modals.hideWorkflow();
        //     }
        //     $('.loader').fadeIn();
        //     //location.reload();
        //     loadWorkflowList();
        // })
        // .fail(function (xhr, status, error) {
        //     toastr.error(error);
        // });
    }    
}

function del(id, name) {

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
            window.location = '../../workflows/delete/' + id;
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
                //window.location = 'projects/delete/' + id;
            }
        })
        .modal('setting', { detachable:false })
        .modal('show');
    },
    hideWorkflow : function () {
        $('.ui.tiny.modal.flow').modal('hide');
    }
}