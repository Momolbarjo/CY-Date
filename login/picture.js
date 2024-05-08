document.getElementById('imageUpload').addEventListener('change', function (e) {
    const img = document.querySelector('.round-image');
    const file = e.target.files[0];
    const reader = new FileReader();

    if (file && ['image/png', 'image/jpeg', 'image/gif'].includes(file.type)) {
        reader.onloadend = function () {
            img.src = reader.result;
        }
        reader.readAsDataURL(file);
    } else {
        alert('Please upload a jpg, a jpeg ,a png or a gif file!');
    }
});

for (let i = 1; i < 7; i++) {
    document.getElementById('imageUpload' + i).addEventListener('change', function (e) {
        const img = document.querySelector('.square-image' + i);
        const file = e.target.files[0];
        const reader = new FileReader();

        if (file && ['image/png', 'image/jpeg', 'image/gif'].includes(file.type)) {
            reader.onloadend = function () {
                img.src = reader.result;
            }
            reader.readAsDataURL(file);
        } else {
            alert('Please upload a jpg, a jpeg ,a png or a gif file!');
        }
    });
}

