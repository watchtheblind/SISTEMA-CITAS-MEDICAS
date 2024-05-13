// aplicando modal de formulario para todos los botones de reservar cita

for (let i=1;i<=12;i++){
  $(`#cita-${i}`).click(function (){
    $(`#modalFormulario-${i}`).modal('show');
    $('#fechaCita').val(a);
    $(`#puesto-${i}`).val(i).prop("readonly", true);
    $("#fechaCita").prop("readonly", true);
  })
}

// hacer que los select se cambien al cambiar la especialidad
document.getElementById('atiende-select').addEventListener('change', function() {
document.getElementById('medico-select').selectedIndex = 0;
});

//el select del médico estará bloqueado hasta elegir una opción
document.getElementById('atiende-select').addEventListener('change', function() {
  if (this.value!== '') {
    document.getElementById('medico-select').disabled = false;
  } else {
    document.getElementById('medico-select').disabled = true;
  }
});
//filtrar según la especialidad
$(document).ready(function() {
  // Selecciona el elemento con el id "atiende-select" y escucha el evento de cambio
  $('#atiende-select').on('change', function() {
    // Obtener el valor de la opción seleccionada en el elemento "atiende-select"
    var atiendeValue = $(this).val();
    
    // Ocultar todas las opciones en el elemento "medico-select"
    $('#medico-select option').hide();
    
    // Mostrar solo las opciones del elemento "medico-select" que coincidan con el valor "atiende" seleccionado
    $('#medico-select option[data-atiende="' + atiendeValue + '"]').show();
  });
});
