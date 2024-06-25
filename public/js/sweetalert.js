function showSuccessMessage(message) {
    Swal.fire({
        position: "center",
        icon: "success",
        title: message,
        showConfirmButton: false,
        timer: 3500
    });
}

function showErrorMessage(message) {
    Swal.fire({
        position: "center",
        icon: "error",
        title: message,
        showConfirmButton: true, 
        confirmButtonColor: '#39A900', 
        confirmButtonText: 'Aceptar', 
    });
}