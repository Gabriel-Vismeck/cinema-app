$(function(){
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.masc-telefone').mask('(00) 0 0000-0000');
    $('.masc-data').mask('00/00/0000');
    $('.masc-cep').mask('00000-000');
    $('.masc-cnpj').mask('00.000.000/0000-00', { reverse: true });
    $('.masc-dinheiro').mask('000.000.000.000.000,00', { reverse: true });
})
