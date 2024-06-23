let smallElement = null;

function fetchData(i) {
  const cedula = document.getElementById(`Cedula-${i}`).value;
  if (cedula !== "") {
    $.ajax({
      type: "POST",
      url: "get_datos.php",
      data: { cedula },
    }).done((data) => {
      const response = JSON.parse(data);
      let nombre =
        response && response.nombre ? response.nombre.split(" ")[0] : "";
      let apellido =
        response && response.apellido ? response.apellido.split(" ")[0] : "";
      if (nombre !== "") {
        document.getElementById(`Nombre-${i}`).value = nombre;
        // Elimina el elemento small si se encontró un resultado
        let smallElement = document
          .getElementById(`Cedula-${i}`)
          .parentNode.querySelector("small");
        if (smallElement) {
          smallElement.remove();
        }
      }
      if (apellido !== "") {
        document.getElementById(`Apellido-${i}`).value = apellido;
      } else {
        if (!smallElement) {
          let textElement = document.createElement("small");
          textElement.textContent = "Sin resultados. ";
          let aElement = document.createElement("a");
          aElement.href = "#"; // No se abre un enlace real
          aElement.textContent = "Registrar Paciente";
          aElement.addEventListener("click", function () {
            // Abrir modal
            $("#pacModal2").modal("show");
            // Ocultar modal ModalFormulario
            $(`#modalFormulario-${i}`).modal("hide");
            $("#pacModal2").on("hidden.bs.modal", function () {
              $(`#modalFormulario-${i}`).modal("show");
            });
            // Aquí puedes incluir el código para abrir el modal
          });
          textElement.appendChild(aElement);
          smallElement = textElement;
        }
        document
          .getElementById(`Cedula-${i}`)
          .parentNode.appendChild(smallElement);
      }
    });
  }
}
