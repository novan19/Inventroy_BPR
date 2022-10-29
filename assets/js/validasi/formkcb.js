function validateForm() {
    var kcb = document.forms["myForm"]["kcb"].value;
    var notelp = document.forms["myForm"]["notelp"].value;
    var contact = document.forms["myForm"]["contact"].value;

    if (kcb == "") {
        validasi('Nama KCB wajib di isi!', 'warning');
        return false;
    } else if (notelp == "") {
        validasi('Nomor Telepon wajib di isi!', 'warning');
        return false;
    } else if (alamat == "") {
        validasi('Contact Person wajib di isi!', 'warning');
        return false;
    }

}

function validateFormUpdate() {
    var kcb = document.forms["myFormUpdate"]["kcb"].value;
    var notelp = document.forms["myFormUpdate"]["notelp"].value;
    var contact = document.forms["myFormUpdate"]["contact"].value;

    if (kcb == "") {
        validasi('Nama KCB wajib di isi!', 'warning');
        return false;
    } else if (notelp == "") {
        validasi('Nomor Telepon wajib di isi!', 'warning');
        return false;
    } else if (alamat == "") {
        validasi('Contact Person wajib di isi!', 'warning');
        return false;
    }

}


function validasi(judul, status) {
    swal.fire({
        title: judul,
        icon: status,
        confirmButtonColor: '#4e73df',
    });
}