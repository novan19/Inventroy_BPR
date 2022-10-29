function validateForm() {
    var supplier = document.forms["myForm"]["supplier"].value;
    var notelp = document.forms["myForm"]["notelp"].value;
    var alamat = document.forms["myForm"]["nama_sales"].value;

    if (supplier == "") {
        validasi('Nama Supplier wajib di isi!', 'warning');
        return false;
    } else if (notelp == "") {
        validasi('Nomor Telepon wajib di isi!', 'warning');
        return false;
    } else if (alamat == "") {
        validasi('Nama Sales wajib di isi!', 'warning');
        return false;
    }

}

function validateFormUpdate() {
    var supplier = document.forms["myFormUpdate"]["supplier"].value;
    var notelp = document.forms["myFormUpdate"]["notelp"].value;
    var nama_sales = document.forms["myFormUpdate"]["nama_sales"].value;

    if (supplier == "") {
        validasi('Nama Supplier wajib di isi!', 'warning');
        return false;
    } else if (notelp == "") {
        validasi('Nomor Telepon wajib di isi!', 'warning');
        return false;
    } else if (nama_sales == "") {
        validasi('Nama Sales wajib di isi!', 'warning');
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