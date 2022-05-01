var logoBtn = document.getElementById('logoBtn');
var bannerBtn = document.getElementById('bannerInputBtn');

var randomText = document.getElementById('btnContent');
var randomTextBanner = document.getElementById('btnContentBanner');
console.log(bannerBtn);

var logoPreview = document.querySelector('#logoPreview');
var bannerPreview = document.querySelector('#bannerPreview');

logoBtn.addEventListener('change', function () {
    var logo = logoBtn.files[0];
    console.log(logo);


    if (logo) {
        var reader = new FileReader();
        // console.log(reader);
        randomText.style.display = "none";
        logoPreview.style.display = "block";

        // console.log(reader);

        reader.addEventListener('load', function (e) {
            logoPreview.setAttribute('src', e.target.result);
            // console.log(cont);

        })
        reader.readAsDataURL(logo);
    } else {
        randomText.style.display = 'block';
        logoPreview.style.display = "none";

    }
})


bannerBtn.addEventListener('change', function () {
    var banner = bannerBtn.files[0];
    console.log(banner);


    if (banner) {
        var reader = new FileReader();
        // console.log(reader);
        randomTextBanner.style.display = "none";
        // logoPreview.style.display = "block";

        // console.log(reader);

        reader.addEventListener('load', function (e) {
            bannerPreview.setAttribute('src', e.target.result);
            // console.log(cont);

        })
        reader.readAsDataURL(banner);
    } else {
        randomTextBanner.style.display = 'block';
        bannerPreview.style.display = 'none';
    }
})
