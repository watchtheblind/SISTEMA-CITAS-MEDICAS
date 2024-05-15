// aplicando modal de formulario para todos los botones de reservar cita

for (let i=1;i<=12;i++){
  $(`#cita-${i}`).click(function (){
    $(`#modalFormulario-${i}`).modal('show');
    $(`#fechaCita-${i}`).val(a);
    $(`#puesto-${i}`).val(i).prop("readonly", true);
    $(`#fechaCita-${i}`).prop("readonly", true);
  })
}

for (let i=1;i<=12;i++){
// hacer que los select se cambien al cambiar la especialidad
document.getElementById(`atiende-select-${i}`).addEventListener('change', function() {
document.getElementById(`medico-select-${i}`).selectedIndex = 0;
});
}
for (let i=1;i<=12;i++){
//el select del médico estará bloqueado hasta elegir una opción
document.getElementById(`atiende-select-${i}`).addEventListener('change', function() {
  if (this.value!== '') {
    document.getElementById(`medico-select-${i}`).disabled = false;
  } else {
    document.getElementById(`medico-select-${i}`).disabled = true;
  }
});
}

$(document).ready(function() {
  for (let i = 1; i <= 12; i++) {
    $(`#atiende-select-${i}`).on('change', function() {
      var atiendeValue = $(this).val();

      $(`#medico-select-${i} option`).hide();
      $(`#medico-select-${i} option[data-atiende="${atiendeValue}"]`).show();
    });
  }
});