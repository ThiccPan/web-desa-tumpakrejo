function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
        $('#preview-tag').attr('src', e.target.result);
    } 
    reader.readAsDataURL(input.files[0]);
  }
}
  
$("#gambar").change(function(){
  readURL(this);
}); 