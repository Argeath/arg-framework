<nav>
    <ul id="menu">
        <li <?= ( $controller == "index" && $action == "index" ) ? 'class="active"' : '' ?>>
            <a href="/">Strona Główna</a></li>
        <li <?= ( $controller == "photos" && $action != "rememberedphotos" && $action != "searchphotos" ) ? 'class="active"' : '' ?>>
            <a href="/index.php/photos">Galeria Zdjęć</a></li>
        <li <?= ( $controller == "photos" && $action == "rememberedphotos" ) ? 'class="active"' : '' ?>>
            <a href="/index.php/photos/remembered">Zapamiętane Zdjęcia</a></li>
        <li <?= ( $controller == "photos" && $action == "searchphotos" ) ? 'class="active"' : '' ?>>
            <a href="/index.php/photos/search">Wyszukaj Zdjęcia</a></li>
        <li <?= ( $action == "airforces" ) ? 'class="active"' : '' ?>>
            <a href="/index.php/airforces">Siły Powietrzne</a>
            <ul class="hide-xs">
                <li><a href="#polska">Polska</a></li>
                <li><a href="#porownanie">Porównanie</a></li>
            </ul>
        </li>
        <li <?= ( $action == "ankieta" ) ? 'class="active"' : '' ?>>
            <a href="/index.php/ankieta">Ankieta</a></li>
        <li <?= ( $action == "ksiegagosci" ) ? 'class="active"' : '' ?>>
            <a href="/index.php/ksiegaGosci">Księga Gości</a></li>
        <li><a href="#kontakt">Kontakt</a></li>
    </ul>
</nav>