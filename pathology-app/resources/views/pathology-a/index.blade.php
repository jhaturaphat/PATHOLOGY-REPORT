<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pathology report</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pathology-a.css">
</head>
<body>
    @include('pathology-a.image1')
    @include('pathology-a.image2')
    @include('pathology-a.image3')
    @include('pathology-a.image4')
    @include('pathology-a.image5')

    <button id="release" style="position: fixed; top:0; left:0; z-index:100">Release</button>

    <script src="{{asset('js/pathology-a.js')}}"></script>
    <script src="{{asset('js/plugins/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/dcgwk7e1pfejbm42161axxt4cxm5sxzoj8jwryxerpo92i0q/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>        
        CKEDITOR.replace( 'editor', {
            // extraPlugins: 'uicolor,colorbutton,colordialog,font',
        } );
        CKEDITOR.addCss(".cke_editable { cursor:text; font-size: 25px; font-family: 'Roboto', sans-serif;  color: #FFFFFF;background-color: #006991;}");
    </script>

<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ]
    });
  </script>
</body>
</html>