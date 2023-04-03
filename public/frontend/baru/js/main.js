function alertError(pesan) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: pesan,
        timer: 2000,
    })
}

function alertSuccess(pesan) {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: pesan,
        timer: 2000,
    })
}