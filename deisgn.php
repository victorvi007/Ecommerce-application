<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <img alt="" id="image">
    <input type="file" name="" id="file">
    <button>Submit</button>
    

    <script>
        var file = document.getElementById('file');
        var image = document.getElementById('image');
        file.addEventListener('change', function(e) {
            console.log(e);
            console.log(e.target.value);
            var result = e.target.value;

            image.setAttribute('src','.../'+result);

        })
    </script>
</body>

</html>