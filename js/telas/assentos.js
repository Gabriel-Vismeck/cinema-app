var divs = document.querySelectorAll(".assento");
divs.forEach(div => {
    div.addEventListener("click", alterarassento);
});

var assentosEscolhidos = [];

function alterarassento() {
    if (this.classList.contains('indisponivel')) return;

    if (this.classList.contains('disponivel')) {
        this.classList.remove('disponivel');
        this.classList.add('selecionado');
        assentosEscolhidos.push(this.innerHTML);
    } else {
        this.classList.remove('selecionado');
        this.classList.add('disponivel');
        assentosEscolhidos.splice(assentosEscolhidos.indexOf(this.innerHTML), 1);
    }

    var divEscolhidos = document.getElementById('assentos-escolhidos');
    divEscolhidos.innerHTML = montarStringListaSelecionados();
}

function montarStringListaSelecionados() {
    var stringLista = "";
    assentosEscolhidos.forEach(assento => {
        stringLista += `
            <div class="assento-escolhido">
                <div class="d-flex align-items-center gap-2">
                    <input type="hidden" name="assentos[]" value="${assento}">
                    <div class="item-sala assento disponivel selecionado">
                        ${assento}
                    </div>
                    <div>
                        - LIVRE - R$20,00
                    </div>
                </div>
                <h2 class="cancelar-assento">
                    <i class="fa-solid fa-xmark"></i>
                </h2>
            </div>`;
    });
    stringLista += `
        <input type="hidden" name="preco" value="${assentosEscolhidos.length * 20}">
        <button class="botao-comprar" type="submit">
            COMPRAR
        </button>`;
    return stringLista;
}