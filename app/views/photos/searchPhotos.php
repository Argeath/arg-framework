<?php foreach($photos as $photo): ?>
    <div class="photo">
        <a href="/assets/uploads/<?= $photo->bigPath; ?>"><img src="/assets/uploads/<?= $photo->smallPath; ?>"/></a><br />
        <?= $photo->title; ?><?= (isset($photo->tryb) && $photo->tryb == "private") ? " (prywatne)" : "" ?><br />
        <?= $photo->autor; ?><br />
    </div>
<?php endforeach; ?>
<div class="clearfix"></div>