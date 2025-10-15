//relóginho...
function showDate() {
    var date = new Date();

    var dia = date.getDate();
    var mes = date.getMonth();
    var ano = date.getFullYear();
    var dias = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
    var meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    var data = dias[date.getDay()] + ', ' + dia + ' de ' + meses[mes] + ' de ' + ano;

    document.getElementById("MyDateDisplay").innerHTML = data;

    setTimeout(showDate, 1000);
}

function showTime24() {
    var date = new Date();
    var h = date.getHours();
    var m = date.getMinutes();
    var s = date.getSeconds();

    h = (h<10) ? "0" + h : h;
    m = (m<10) ? "0" + m : m;
    s = (s<10) ? "0" + s : s;

    var data = h + ':' + m + ':' + s;
    document.getElementById("MyClockDisplay").innerHTML = data;

    setTimeout(showTime24, 1000);
}

showDate();
showTime24();
//datinha...
function showDate() {
    var date = new Date();
    var h = date.getHours();
    var m = date.getMinutes();
    var s = date.getSeconds();

    h = (h<10) ? "0" + h : h;
    m = (m<10) ? "0" + m : m;
    s = (s<10) ? "0" + s : s;

    // Mostrar no formato: dia da semana, dia, mês por extenso, ano
    var dia = date.getDate();
    var mes = date.getMonth();
    var ano = date.getFullYear();
    var dias = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
    var meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];
    var data = dias[date.getDay()] + ', ' + dia + ' de ' + meses[mes] + ' de ' + ano;
    document.getElementById("MyDateDisplay").innerHTML = data;
    document.getElementById("MyDateDisplay").textContent = data;

    setTimeout(showDate, 1000);

}

showDate();
