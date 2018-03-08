$(function() {
    //loadWorkflowList();

    $('[id^="sortable_"]').sortable({
        cursor: 'move',
        connectWith: ".connectedSortable"
    }).disableSelection();

    $('[id^="sortable_grid"]').sortable({
        cursor: 'move',
        connectWith: ".connectedGridSortable"
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

