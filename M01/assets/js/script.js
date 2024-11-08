var fileInput = document.getElementById('fileInput');
var addLocation = document.getElementById('addLocation');

function selectSideNavOpt(btnID) {
    console.log("button CLICKED");
    if (btnID === 'btnCreate') {
        var modal = new bootstrap.Modal(document.getElementById("confirmationModal"));
        modal.show();
    }
}

function uploadFile() {
    fileInput.click();
}

function inputLocation() {
    addLocation.style.display = "block";
}

function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('imagePreview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
        preview.src = '';
    }
}
