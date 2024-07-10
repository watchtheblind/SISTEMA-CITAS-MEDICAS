// aplicando modal de formulario para todos los botones de reservar cita
$(`#modalFormulario`).on("shown.bs.modal", function () {
  $(`#fechaCita`).val(getFecha);
  // $(`#puesto`).val(i).prop("readonly", true);
  $(`#fechaCita`).prop("readonly", true);
});

// hacer que los select se cambien al cambiar la especialidad
document
  .getElementById(`atiende-select`)
  .addEventListener("change", function () {
    document.getElementById(`medico-select`).selectedIndex = 0;
  });

//el select del médico estará bloqueado hasta elegir una opción
document
  .getElementById(`atiende-select`)
  .addEventListener("change", function () {
    if (this.value !== "") {
      document.getElementById(`medico-select`).disabled = false;
    } else {
      document.getElementById(`medico-select`).disabled = true;
    }
  });

//filtrar médicos según la especialidad que yo seleccione
$(document).ready(function () {
  $(`#atiende-select`).on("change", function () {
    var atiendeValue = $(this).val();
    $(`#medico-select option`).hide();
    $(`#medico-select option[data-atiende="${atiendeValue}"]`).show();
  });
});
//hacer que la página se recargue si se cierra el modal de reservas
$("#modalFormulario").on("hidden.bs.modal", function () {
  // Verificar si otro modal no se abrió después de cerrar este
  if (!$(".modal:visible").length) {
    // Recargar la página
    location.reload();
  }
});
