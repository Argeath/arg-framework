function isArray(obj) {
    return obj instanceof Array;
}

if(localStorage.getItem("ksiegaGosci") === null)
localStorage.setItem("ksiegaGosci", "[]");

function odswiezKsiege() {
    var list = JSON.parse(localStorage.getItem("ksiegaGosci"));

    var ksiega = document.getElementById("ksiega_gosci");
    if ( ! ksiega) return false;
    while (ksiega.firstChild) {
        ksiega.removeChild(ksiega.firstChild);
    }

    if(list && isArray(list)) {
        list.forEach(function(element, index, array) {
            var li = document.createElement("li");
            li.innerHTML = "[" + element.czas + "] " + element.imieNazwisko + ": " + element.text;
            ksiega.appendChild(li);
        });
    }
}

odswiezKsiege();

$(function() {
    $("#dodaj_wpis input[type='submit']").on('click', function(e) {
        e.preventDefault();
        var imie = $("#dodaj_wpis input[name='imie_nazwisko']").val();
        var text = $("#dodaj_wpis textarea").val();

        var list = JSON.parse(localStorage.getItem("ksiegaGosci"));
        if( ! isArray(list)) {
            list = [];
        }

        var wpis = {
            imieNazwisko: imie,
            text: text,
            czas: (new Date()).toDateString() + " " + (new Date()).toLocaleTimeString()
        };

        list.push(wpis);
        localStorage.setItem("ksiegaGosci", JSON.stringify(list));

        odswiezKsiege();
    });


});