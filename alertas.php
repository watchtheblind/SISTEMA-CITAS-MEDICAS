
<!-- Alerta registro exitoso -->
<script>
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

</script>
