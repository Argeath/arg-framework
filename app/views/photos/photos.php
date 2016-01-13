<article>
    <a href="/index.php/photos/add" class="btn" style="float: right;">Dodaj zdjęcie</a>
    <h2>Galeria zdjęć</h2>
    <div class="photos">
        <form method="post" action="/index.php/photos/remember">
        <?php foreach($photos as $photo): ?>
        <div class="photo">
            <a href="/assets/uploads/<?= $photo->bigPath; ?>"><img src="/assets/uploads/<?= $photo->smallPath; ?>"/></a><br />
            <input type="checkbox" name="remember_photo_<?= $photo->_id; ?>" value="Y" <?= ($photo->isRemembered) ? 'checked' : '' ?>/>
            <?= $photo->title; ?><?= (isset($photo->tryb) && $photo->tryb == "private") ? " (prywatne)" : "" ?><br />
            <?= $photo->autor; ?><br />
        </div>
        <?php endforeach; ?>
        <?= (count($photos) <= 1) ? "Brak zdjęć." : "" ?><br /><br /><br />
        <div class="clearfix"></div>
        <button class="btn">Zapamiętaj zdjęcia</button><br /><br /><br />
        </form>
    </div>
</article>