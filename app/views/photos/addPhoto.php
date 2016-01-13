<article style="text-align: center;">
    <h2>Dodaj zdjęcie</h2>

    <?php if(isset($errorField)): ?>
        <div class="errorBox">
            <?= $errorField . ": " . $error ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="/index.php/photos/add" enctype="multipart/form-data">
        <label>Tytuł:</label><br />
        <input type="text" class="form-input" placeholder="Tytuł" name="title"/><br />

        <label>Autor:</label><br />
        <?php if( ! $isLogged) { ?>
            <input type="text" class="form-input" placeholder="Autor" name="autor"/><br />
        <?php } else { ?>
            <b><?= $user->username; ?></b>
            <input type="hidden" name="autorUser" value="<?= $user->_id; ?>"/>
            <br /><br />

            <label>Tryb:</label><br />
            <label><input type="radio" name="tryb" value="public" checked>Publiczne</label><br />
            <label><input type="radio" name="tryb" value="private">Prywatne</label><br />
            <br />
        <?php } ?>

        <label>Zdjęcie:</label><br />
        <input type="file" class="form-input" name="file"><br />

        <div class="buttons">
            <input class="btn" type="submit" value="Dodaj zdjęcie"/>
        </div>
    </form>
</article>