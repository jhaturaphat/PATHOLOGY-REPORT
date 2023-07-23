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
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    <script>        
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html>