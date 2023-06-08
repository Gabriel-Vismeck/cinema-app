function alterarbarralateral() {
    var element = document.getElementById("barra-lateral");

    if (element.classList.contains('fechado')) {
      element.classList.remove("fechado");
      element.classList.add("aberto");
    } else {
      element.classList.remove("aberto");
      element.classList.add("fechado");
    }
  }