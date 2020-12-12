$(document).ready(function(){
    $('.phone_with_ddd').mask('(00) 0000-0000');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.money2').mask("R$ 0,00", {reverse: true});
    $('.money3').mask("R$ 0,00", {reverse: true});
    $('.money4').mask("R$ 000,00", {reverse: true});
    $('.money5').mask("R$ 0.000,00", {reverse: true});
});