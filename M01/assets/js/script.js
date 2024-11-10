var fileInput = document.getElementById('fileInput');
var addLocation = document.getElementById('addLocation');

// SHOW MODAL(BOOTSTRAP) TO CREATE A POST
function selectSideNavOpt(btnID) {

    if (btnID === 'btnCreate') {
        var modal = new bootstrap.Modal(document.getElementById("confirmationModal"));
        modal.show();
    }
}

// CLICKS THE FILE INPUT ELEMENT
function uploadFile() {
    fileInput.click();
}

// DISPLAY THE LOCATION INPUTS
function inputLocation() {
    addLocation.style.display = "block";
}

// FUNCTION TO PREVIEW THE IMAGE UPLOADED BY THE USER
// CHECK FILE > LOAD FILE > READ FILE
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




