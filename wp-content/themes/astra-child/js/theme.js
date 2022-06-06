var $ = jQuery.noConflict();

$(document).ready(function(){
    $(".book_btn").on('click',function(){
        
        var post_id = $(this).closest(".booking_div").find("[name='list_post_id']").val();
        var post_name = $(this).closest(".booking_div").find("[name='list_post_name']").val();
        if(!post_name){
            post_name = "";
            
        }
        
        $('#bookingModal form [name="text-listing_post"]').val(post_name + "(" + post_id + ")");
        
        $('#bookingModal').modal('show');
    });    
    
     $('#bookingModal').on('hidden.bs.modal', function (e) {
        $(e.target).removeData('bs.modal');
        $('#bookingModal form [name="text-listing_post"]').val('');
        
    });
});


