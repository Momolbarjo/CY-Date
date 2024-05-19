$(document).ready(function(){
    const table = $(".visitsTableContainer");
    const button = $("#visited");
    const form = $("form");
    
    function showTable(){
        table.show();
        form.addClass("blurred");
    }

    if(sub == 'gld'){
        button.show();
    }
    function hideTable(){
        table.hide();
        form.removeClass("blurred");
    }
    button.click(function(){
        showTable();
    });
    
    $(document).click(function(event){
        if (!$(event.target).closest(".visitsTableContainer").length && !$(event.target).is("#visited")){
            hideTable();
        }
    });
});
