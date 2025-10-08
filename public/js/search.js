

$(document).ready(function () {

      
        
$('#search').on('keyup',function()
{
    $value=$(this).val();
    console.log($value);
    


    if($value!="")
    {
        $('.actual').hide();
        $('.search-body').show()
        $('.page').hide();
    
    }

     else
    {
        $('.actual').show();
        $('.search-body').hide()
         $('.page').show();
       
    }
    
    $.ajax({
        type: "GET",
        url: '/search',
        data: {search:$value},
        success: function (data) {
            // console.log(data);
            $('#search-body').html(data);


        }

        
    });
});
});
    $(document).on('click', '.sort-link', function(e) {
        if ($('#search').val() != "") {
            e.preventDefault();
            return false;
        }
    });



