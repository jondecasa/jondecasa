{{-- <script src="https://cdn.tiny.cloud/1/ptqhx4dd0qzox34w8tev7bsbhu122u30cmpwqwzcvwdwokxf/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
    plugins: 'code preview searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor advlist lists wordcount emoticons',
    toolbar: 'preview code undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | link image',
    image_title: true,
    automatic_uploads: true,
    images_upload_url: "{{url('/subirImagen')}}",
    relative_urls: false,
    file_picker_types: "image",
    // file_picker_callback: function(cb, value, meta){
    //   console.log(cb);
    //   console.log(value);
    //   console.log(meta);
    //     var input = document.createElement("input");
    //     input.setAttribute("type", "file");
    //     input.setAttribute("accept", "image/*");
    //     input.onchange = function(){
    //         var file = this.files[0];

    //         var reader = new FileReader();
    //         reader.readAsDataUrl(file);
    //         reader.onload = function(){
    //             var id = "blobid" + (new Date()).getTime();
    //             var blobCache = tinymce.activeEditor.editorUpload.blobCache;
    //             var base64 = reader.result.split(",")[1];
    //             var blobInfo = blobCache.create(id, file, base64);
    //             console.log(id);
    //             console.log(file);
    //             console.log(base64);
    //             blobCache.add(blobInfo);
    //             cb(blobInfo.blobUri(), {title: file.name});
    //         };
    //     };
    // },
  });
</script>