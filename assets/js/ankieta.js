function dodajStrefe(e) {
    e.preventDefault();
    var label = document.createElement("label");
    var input = document.createElement("input");
    input.type = "text";
    input.name = "bezpieczenstwo_strefy[]";
    label.appendChild(input);
    document.getElementById("bezpieczenstwo_strefy").appendChild(label);
}

document.getElementById('bezpieczenstwo_strefy_dodaj').addEventListener(
    'click', dodajStrefe, false
);
document.getElementById('bezpieczenstwo_strefy_dodaj').style.display = "block";

$(function() {
    var imieNazwisko = $("input[name='imie_nazwisko']");
    var wiek = $("input:radio[name='wiek']:checked").val();
    var plec = $("input:radio[name='plec']:checked").val();


    if( ! imieNazwisko.val())
        $("#ankieta_wiek").hide();

    if( ! wiek || !imieNazwisko.val())
        $("#ankieta_plec").hide();

    if( ! plec || ! wiek || !imieNazwisko.val())
        $("#ankieta_pytania").hide();

    imieNazwisko.on("blur", function() {
        if($(this).val() ) {
            $("#ankieta_wiek").show();
        } else {
            $("#ankieta_wiek").hide();
            $("#ankieta_plec").hide();
            $("#ankieta_pytania").hide();
        }
    });

    $('input:radio[name="wiek"]').on("change", function() {
        $("#ankieta_plec").show();
    });

    $('input:radio[name="plec"]').on("change", function() {
        $("#ankieta_pytania").show();
    });

    $("input[type='reset']").on("click", function() {
        $("#ankieta_wiek").hide();
        $("#ankieta_plec").hide();
        $("#ankieta_pytania").hide();
    });
});