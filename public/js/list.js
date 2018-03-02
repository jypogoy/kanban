function highlightOnDelete(row) {
    row.effect('highlight', {}, 500, function(){ // See app.css for highlight class
        $(this).fadeOut('fast', function(){
            toastr.success(msg); // See toaster.js
            $(this).remove();
        });
    });  
}