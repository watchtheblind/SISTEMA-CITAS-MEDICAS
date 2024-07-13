// Agregamos un evento de change a cada checkbox
const checkboxes = document.querySelectorAll("input[type=checkbox]");
checkboxes.forEach((checkbox) => {
  //a cada checkbox le pasamos un eventlistener
  checkbox.addEventListener("change", () => {
    //verificamos que cada checkbox diferente a la actual y que este marcada se quite
    checkboxes.forEach((otraCheckbox) => {
      if (otraCheckbox !== checkbox && otraCheckbox.checked) {
        otraCheckbox.checked = false;
      }
    });
  });
});
