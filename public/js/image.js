//update
document.getElementById('product_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('imgPreview');
    const container = document.querySelector('.image');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            preview.src = event.target.result;
            container.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});


//create
 $(document).ready(function() {
   $('#product_image').on('change',function (e) {
    let file=e.target.files[0];
    // const preview=('#imgPreview');
    // const container =('.image');
    // console.log('Preview object:', preview);
    if(file)
    {
         let reader = new FileReader();
              reader.onload = function(event) {
                  $('#imgPreview').attr('src', event.target.result);
                  $('.image').show();
              }
              reader.readAsDataURL(file);
       
    }
   })
     })