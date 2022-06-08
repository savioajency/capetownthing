var $ = jQuery.noConflict();

$(document).ready(function(){
    $(document).on('click',".book_btn",function(){
        $('#bookingModal form').trigger("reset");
        $('#bookingModal form .wpcf7-response-output').html('');
        
        var post_id = $(this).closest(".booking_div").find("[name='list_post_id']").val();
        var post_name = $(this).closest(".booking_div").find("[name='list_post_name']").val();
        if(!post_name){
            post_name = "";
            
        }
        
        var contact_email = $(this).closest(".booking_div").find("[name='list_contact_email']").val();
        
        
        $('#bookingModal form [name="text-listing_post"]').val(post_name + "(" + post_id + ")");
        $('#bookingModal form [name="text-contact_email"]').val(contact_email);
        
        $('#bookingModal').modal('show');
    });    
    
     $('#bookingModal').on('hidden.bs.modal', function (e) {
        $(e.target).removeData('bs.modal');
        $('#bookingModal form [name="text-listing_post"]').val('');
         $('#bookingModal form [name="text-contact_email"]').val('');        
    });
});


