<meta name="csrf-token" content="{{ csrf_token()}}"/>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#myeditorinstance',
    width: 900,
    height: 300,
    convert_uls: false,
    statusbar: false,
    plugins: [
      'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
      'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen', 'insertdatetime',
      'media', 'table', 'emoticons', 'template', 'codesample' ,'help',
    ],
    toolbar: 'undo redo | formatselect| styles | bold italic underline | alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist outdent indent | blockquote | link image | print preview media fullscreen | ' +
      'forecolor backcolor emoticons | code | table| codesample | help',
    menu: {
      favs: { title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons' }
    },
    menubar: 'favs file edit view insert format tools table help',
    content_css: 'css/content.css',
    image_title: true,
    automatic_uploads: true,
    images_upload_url: '{{ url("/file-upload") }}',
    file_picker_types: 'image',
    file_picker_callback: function(cb, value, meta){
      var input = document.createElement('input');
      input.setAttribute('type','file');
      input.setAttribute('accept','image/*');

      input.onchange = function(){
        var file = this.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function(){
          var id = 'blobid' + (new Date()).getTime();
          var blobCache = tinymce.activeEditor.editorUpload.blobCache;
          var base64 = reader.result.split(',')[1];
          var blobInfo = blobCache.create(id, file, base64);
          blobCache.add(blobInfo);
          cb(blobInfo.blobUrl(),{ title: file.name});
        };
      };
      input.click();
    }
  });
  </script>