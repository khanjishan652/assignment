$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
       
    $(".ajaxForm").submit(function(event) {
        $('.err').text('');
        $('.form-control').css('border-color','green');
        event.preventDefault();
        formdata = new FormData($(this)[0]);
        $.ajax({
            url: $(this).attr('action'),
            contentType: false,
            processData: false,
            cache:false,
            data: formdata,
            type: $(this).attr('method'),
            beforeSend: function() {
                $("#overlay").fadeIn(300);
            },complete: function() {
                $("#overlay").fadeOut(300);
                
            },
            success: function(response){
            if(response.status){
                $('.ajaxForm')[0].reset();
                swal({
                    title: "Success!",
                    text: response.message,
                    icon: "success",
                });
                if(typeof(response.url) != "undefined"){
                    setTimeout(function() {
                        window.location.replace(response.url);
                    }, 1000);
                }
                
            }else{
                console.log(response.errors,'response.errors');
                $.each(response.errors, function(key,val) {
                    var fieldElement = $('.' + key.replace(/\./g, '_')+'Err');
                    fieldElement.css('color','red').text(val[0]);
                    $('input[name="'+key+'"], select[name="' + key + '"], select[name="mothers[]"]').css('border-color','red');
                });
            }
            },

        });
    });

});
$(document).on('change','#state_field',function(){
   var state_id = $(this).val();
   $.ajax({
        url: 'change-state/'+state_id,
        contentType: false,
        processData: false,
        cache:false,
        type: 'get',
        beforeSend: function() {
            $("#overlay").fadeIn(300);
        },complete: function() {
            $("#overlay").fadeOut(300);
            
        },
        success: function(response){
            $('#cities').html(response.data);
        }
    });
})

$(document).on('change','#marital_status',function(){
   var status = $(this).val();
   console.log(status);
   if(status==1){
    $('.wedding_date').show();
   }else{
    $('.wedding_date').hide();
   }
});
