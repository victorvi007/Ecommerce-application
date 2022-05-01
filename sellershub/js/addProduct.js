var image1Btn = document.getElementById('image1');
var image2Btn = document.getElementById('image2');
var image3Btn = document.getElementById('image3');


var textContent1 = document.getElementById('text-content-1');
var textContent2 = document.getElementById('text-content-2');
var textContent3 = document.getElementById('text-content-3');



var Preview1 = document.querySelector('#preview-1');
var Preview2 = document.querySelector('#preview-2');
var Preview3 = document.querySelector('#preview-3');


image1Btn.addEventListener('change', function () {
    var image1 = image1Btn.files[0];
    console.log(image1);


    if (image1) {
        var reader = new FileReader();
        console.log(reader);
        textContent1.style.display = "none";
        Preview1.style.display = "block";

        // console.log(reader);

        reader.addEventListener('load', function (e) {
            Preview1.setAttribute('src', e.target.result);
            // console.log(cont);

        })
        reader.readAsDataURL(image1);
    } else {
        textContent1.style.display = 'block';
        Preview1.style.display = "none";

    }
})


image2Btn.addEventListener('change', function () {
    var image2 = image2Btn.files[0];
    console.log(image1);


    if (image2) {
        var reader = new FileReader();
        console.log(reader);
        textContent2.style.display = "none";
        Preview2.style.display = "block";

        // console.log(reader);

        reader.addEventListener('load', function (e) {
            Preview2.setAttribute('src', e.target.result);
            // console.log(cont);

        })
        reader.readAsDataURL(image2);
    } else {
        textContent2.style.display = 'block';
        Preview2.style.display = "none";

    }
})


image3Btn.addEventListener('change', function () {
    var image3 = image3Btn.files[0];
    console.log(image3);


    if (image3) {
        var reader = new FileReader();
        console.log(reader);
        textContent3.style.display = "none";
        Preview3.style.display = "block";

        // console.log(reader);

        reader.addEventListener('load', function (e) {
            Preview3.setAttribute('src', e.target.result);
            // console.log(cont);

        })
        reader.readAsDataURL(image3);
    } else {
        textContent3.style.display = 'block';
        Preview3.style.display = "none";

    }
})