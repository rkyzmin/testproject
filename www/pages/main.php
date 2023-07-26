<?php

use Models\Blocks;
use helpers\Html;

$bl = new Blocks();
$blocks = $bl->allBlocks();
?>

<?php if (empty($blocks)) : ?>
    <div>
        <span>Не были добавлены блоки(:</span>
        <div>Войдите в админку, чтобы быть первым! <a href="http://localhost/?page=login">Войти</a></div>
    </div>
<?php else : ?>
    <? Html::generateBlocksHtml($blocks); ?>
<?php endif; ?>