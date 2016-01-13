<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lotnictwo - Dominik Kinal 160589</title>

    <meta content="width=device-width, initial-scale=1" name="viewport">

    <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/jquery-ui.theme.css" />

    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/jquery-ui.min.js"></script>

</head>
<body>
<div id="background">
    <div class="bottom"></div>
    <div class="top" id="top-background"></div>
</div>
<?php $header->render(); ?>

<div class="container">
    <div class="content">
        <?php if(isset($message)): ?>
        <div class="messageBox">
            <?= $message; ?>
        </div>
        <?php endif; ?>
        <?php $menu->render(); ?>
        <?php $content->render(); ?>
    </div>
    <div class="clearfix"></div>
</div>

<?php $footer->render(); ?>

<script src="/assets/js/background.js"></script>
<script src="/assets/js/imieNazwisko.js"></script>

</body>
</html>