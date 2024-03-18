// Impedir que los formularios se sse envíen con la tecla Enter 
    document.onkeydown = function() {
        if (event.keyCode == 13) {
            if (document.activeElement.tagName.toLowerCase () != "textarea") {
                      event.preventDefault();
                      return false;
                }
        }
    }
