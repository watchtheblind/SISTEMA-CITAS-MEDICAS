for (let i = 1; i <= 12; i++) {
  $(`#enviar-${i}`).click(function () {
    var form = $(`#Formajax-${i}`);
    //validar campos obligatorios para la reservación
    var isValid = true;
    form.find("input, select").each(function () {
      if ($(this).attr("required") && $(this).val() === "") {
        isValid = false;
        $(this).addClass("invalid");
      } else {
        $(this).removeClass("invalid");
      }
    });
    if (isValid) {
      $.ajax({
        url: "guardarDatosCalendario.php",
        type: "POST",
        data: form.serialize(),
      }).done(function (res) {
        $(`#respuesta-${i}`).html(res);
        setTimeout(function () {
          window.location.href = "calendar.php?shSuccMsg=1";
        }, 0);
      });
    } else {
      alert("Por favor, complete todos los campos obligatorios");
    }
  });
}
