$(`#enviar`).click(function () {
  var form = $(`#Formajax`);
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
      $(`#respuesta`).html(res);
      setTimeout(function () {
        window.location.href = "calendar.php?shSuccMsg=1";
      }, 0);
    });
  } else {
    alert("Por favor, complete todos los campos obligatorios");
  }
});
