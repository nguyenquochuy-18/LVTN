$(function (){
    const urlUpload = $('input[name="route-upload-ckeditor"]').data('route')
    const config = {}
    config.filebrowserUploadUrl = urlUpload
    config.filebrowserUploadMethod = 'form'
    config.height = '30vh'

    CKEDITOR.replace('content-blog', config)
});
