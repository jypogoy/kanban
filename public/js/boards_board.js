$(function() {
    //loadWorkflowList();    

    $('.loader').fadeOut();

    $('[id^="sortable_"]').sortable({
        cursor: 'move',
        connectWith: ".connectedSortable",
        change: function(event, ui) {
            ui.placeholder.css({ visibility: 'visible', border : '2px dashed teal', overFlow: 'hidden', textAlign: 'center', margin: '10px' });
            ui.placeholder.html(' <i class="hand point down outline icon"></i>Drop here');
        },
        update:function(event, ui){
            // var el = $(this).data().uiSortable.currentItem;
            // var currentWorkflowId = $($(el).children()[1]).find('#workflowId').val();            
            // var targetWorkflowId = $($(el).next('tr').children()[1]).find('#workflowId').val();            
            // $.post('../../workflows/switchsequence?current=' + currentWorkflowId + '&target=' + targetWorkflowId, function (data) {
            //     // Do nothing...      
            // })
            // .done(function (data) {
            //    // Do nothing...
            // })
            // .fail(function (xhr, status, error) {
            //     toastr.error(error);
            // });
        }
    }).disableSelection();    

    var startIndex;
    $('[id^="sortable_grid"]').sortable({
        cursor: 'move',
        connectWith: ".connectedGridSortable",
        change: function(event, ui) {
            ui.placeholder.css({ visibility: 'visible', border : '2px dashed teal', overFlow: 'hidden', textAlign: 'center', margin: '10px' });
            ui.placeholder.html(' <i class="hand point down outline icon"></i>Drop here');
        },
        start:  function(event, ui) {
            startIndex = ui.item.index();
        },
        update: function(event, ui) {
            var moved = ui.item,
                replaced = ui.item.prev();            
            
            // Check if item has been pushed to the top of the list or moved backwards the list
            // In this case we need the .next() sibling
            if (replaced.length == 0 || moved.index() < startIndex) {
                replaced = ui.item.next();
            }

            var movedId = moved.find('#workflowId').val();
            var replacedId = replaced.find('#workflowId').val();
            
            $.post('../../workflows/switchsequence?current=' + movedId + '&target=' + replacedId, function (data) {
                // Do nothing...      
            })
            .done(function (data) {
               // Do nothing...
            })
            .fail(function (xhr, status, error) {
                toastr.error(error);
            });
        }    
    }).disableSelection();

    $('.ui.dropdown').dropdown();
});

// function loadWorkflowList() {    
//     $.get('../../workflows/listbyproject/' + $('#projectId').val(), function (data) {
//         //$('#workflowTable tbody tr').remove();
//         for (let i = 0; i < data.length; i++) {
//             const rec = data[i];
//             $('#boardWrapper').append('<div id="' + rec.id + '_column" class="column wf-border">' +
//                                             '<div class="ui equal width grid column-header">' +
//                                                 '<div class="column">' +
//                                                     '<h4 class="ui header">' + rec.name + '</h4>' +
//                                                 '</div>' +
//                                                 '<div class="column">' +
//                                                     '<a href class="ui right floated icon mini primary button"><i class="plus icon"></i></a>' + 
//                                                 '</div>' +
//                                             '</div>' +
//                                             '<div id="' + rec.id + '_content" class="row row-content connectedSortable"></div>' +                                                                                        
//                                         '</div>');

//             $('#' + rec.id + '_content').append('<div class="scontent">Test</div>');
//             // $('.row-content').append('<div class="ui link card">' +
//             //                             '<div class="content">' +
//             //                             '<img class="right floated mini ui image" src="../../img/avatar/elliot.jpg">' +
//             //                             '<div class="header">' +
//             //                                 'Elliot Fu' +
//             //                             '</div>' +
//             //                             '<div class="meta">' +
//             //                                 'Friends of Veronika' +
//             //                             '</div>' +
//             //                             '<div class="description">' +
//             //                                 'Elliot requested permission to view your contact details' +
//             //                             '</div>' +
//             //                             '</div>' +
//             //                             '<div class="extra content">' +
//             //                             '<div class="ui two buttons">' +
//             //                                 '<div class="ui basic green button">Approve</div>' +
//             //                                 '<div class="ui basic red button">Decline</div>' +
//             //                             '</div>' +
//             //                             '</div>' +
//             //                         '</div>');                                                     
//         }    
        
//     //     $('.row-content').append('<ul id="sortable1" class="connectedSortable">' +
//     //     '<li class="ui-state-default">Item 1</li>' +
//     //     '<li class="ui-state-default">Item 2</li>' +
//     //     '<li class="ui-state-default">Item 3</li>' +
//     //     '<li class="ui-state-default">Item 4</li>' +
//     //     '<li class="ui-state-default">Item 5</li>' +
//     //   '</ul>');

//         if (data.length == 0) {
//             $('#boardWrapper').append('<p><p><div class="ui warning message">No workflows found for this project.</div>'); 
//         }        
//     })
//     .done(function (data) {
//         $('.loader').fadeOut();
//     })
//     .fail(function (xhr, status, error) {
//         toastr.error(error);
//     });
// }

