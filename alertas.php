
<script> import Swal from 'sweetalert2'; </script>
<script>
    // Alerta usuario ya existe 
    document.addEventListener('DOMContentLoaded', function() {
    if (location.search.includes('shSuccMsg=0')) {
        Swal.fire({
        icon: "error",
        title: "¡Este usuario ya existe!",
        showConfirmButton: false,
        timer: 1500
        }).then(() => {
        history.pushState('', document.title, window.location.pathname);
    });
        }
});
    //Alerta registro exitoso
    document.addEventListener('DOMContentLoaded', function() {
        if (location.search.includes('shSuccMsg=1')) {
        Swal.fire({
            icon: 'success',
            title: 'Datos registrados con éxito',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            history.pushState('', document.title, window.location.pathname);
        });
    }
});
// alerta borrado usuario con exito
document.addEventListener('DOMContentLoaded', function() {
        if (location.search.includes('shSuccMsg=2')) {
            Swal.fire({
            icon: 'success',
            title: 'Datos borrados con éxito',
            showConfirmButton: false,
            timer: 1500
            }).then(() => {
            history.pushState('', document.title, window.location.pathname);
        });
    }
});
//alerta de actualización de datos
document.addEventListener('DOMContentLoaded', function() {
        if (location.search.includes('shSuccMsg=3')) {
            Swal.fire({
            icon: 'success',
            title: 'Datos actualizados con éxito',
            showConfirmButton: false,
            timer: 1500
            }).then(() => {
            history.pushState('', document.title, window.location.pathname);
        });
    }
});
document.addEventListener('DOMContentLoaded', function() {
        if (location.search.includes('shSuccMsg=4')) {
            Swal.fire({
                title: "Do you want to save the changes?",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire("Saved!", "", "success");
                } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
                }
                });
    }
});

</script>
