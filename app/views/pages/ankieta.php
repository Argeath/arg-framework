<article>
    <h2>Ankieta</h2>
    <form id="ankieta" method="POST">
        <label>Imię i Nazwisko:</label><br />
        <input class="form-input" type="text" name="imie_nazwisko" placeholder="Twoje imię i nazwisko" />

        <div id="ankieta_wiek">
            Wiek:<br />
            <label><input type="radio" name="wiek" value="1" /> &lt; 18</label><br />
            <label><input type="radio" name="wiek" value="2" /> 18-25</label><br />
            <label><input type="radio" name="wiek" value="3" /> 26-35</label><br />
            <label><input type="radio" name="wiek" value="4" /> 36-45</label><br />
            <label><input type="radio" name="wiek" value="5" /> &gt; 45</label><br />
        </div>
        <div id="ankieta_plec">
            Płeć:<br />
            <label><input type="radio" name="plec" value="1" /> Kobieta</label><br />
            <label><input type="radio" name="plec" value="2" /> Mężczyzna</label>
        </div>

        <div id="ankieta_pytania">
            <label>Jaki jest wg Ciebie poziom bezpieczeństwa na polskich lotniskach?</label><br />
            <select name="bezpieczenstwo_poziom">
                <option value="2">Wysoki</option>
                <option value="1">Przeciętny</option>
                <option value="0">Niski</option>
                <option value="-1">Nie wiem</option>
            </select>
            <br />
            <br />

            <label>Jakie jest wg Ciebie prawdopodobieństwo ataku terrorystycznego na polskich lotniskach?</label><br />
            <select name="bezpieczenstwo_terrorysci">
                <option value="2">Wysokie</option>
                <option value="1">Średnie</option>
                <option value="0">Niskie</option>
                <option value="-1">Nie wiem</option>
            </select>
            <br />
            <br />

            Które strefy lotniska wg Ciebie wymagają szczególnej ochrony?<br />
            <div id="bezpieczenstwo_strefy">
                <label><input type="checkbox" name="bezpieczenstwo_strefy[]" value="hol" /> Hol Główny</label>
                <label><input type="checkbox" name="bezpieczenstwo_strefy[]" value="bagaz" /> Kontrola bagażu i kontrola
                                                                                              osobista</label>
                <label><input type="checkbox" name="bezpieczenstwo_strefy[]" value="bramki" /> Bramki</label>
                <label><input type="checkbox" name="bezpieczenstwo_strefy[]" value="terminal" /> Terminal</label>
                <label><input type="checkbox" name="bezpieczenstwo_strefy[]" value="samolot" /> Samolot</label>
                <label><input type="checkbox" name="bezpieczenstwo_strefy[]" value="odprawy" /> Miejsca odpraw</label>
                <label><input type="checkbox" name="bezpieczenstwo_strefy[]" value="toalety" /> Toalety</label>
            </div>
            <button class="btn" id="bezpieczenstwo_strefy_dodaj">Dodaj własne pole</button>
            <br />
            <br />

            <label>Co jeszcze wg. Ciebie można by zrobić, aby zwiększyć poziom bezpieczeństwa?</label><br />
            <textarea name="opinia" class="form-input"></textarea>
        </div>

        <div class="buttons">
            <input class="btn" type="submit" value="Wyślij" />
            <input class="btn" type="reset" value="Wyczyść" />
        </div>
    </form>
</article>

<script src="/assets/js/ankieta.js"></script>