function cambiarDataBsTarget(clase, modal) {
  const botones = document.getElementsByClassName(clase);
  for (const boton of botones) {
    boton.setAttribute("data-bs-target", "#" + modal);
  }
}
