function highlightOnDelete(row) {
    row.effect('highlight', {}, 500, function(){ // See app.css for highlight class
        $(this).fadeOut('fast', function(){            
            $(this).remove();
        });
    });  
}