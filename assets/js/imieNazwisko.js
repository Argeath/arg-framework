$(function() {
    var imieNazwiskoZapisane = sessionStorage.getItem("imieNazwisko");
    if (!imieNazwiskoZapisane && imieNazwiskoZapisane !== "-1")
        $("#imie_nazwisko_dialog").show().dialog();

    if (imieNazwiskoZapisane && imieNazwiskoZapisane !== "-1") {
        $("input[name='imie_nazwisko']").val(imieNazwiskoZapisane);
        $("#ankieta_wiek").show();
    }
});