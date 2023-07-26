<?php

use Models\Blocks;
use helpers\Html;

$bl = new Blocks();
$blocks = $bl->allBlocks();
?>

<button class="add-new-element">Добавить новый элемент</button>
<br />
<br />
<div class="modal-block-add-item">
    <img src="../resources/icons/close.svg">
    <form method="GET" action="#" class="modal-block-add-item__form">
        <input class="modal-block-add-item__form__title" type="text" placeholder="Название" required />
        <textarea class="modal-block-add-item__form__description" placeholder="Описание"></textarea>
        <input id="ch_id" type="hidden" />
        <input class="modal-block-add-item__form__add" value="Добавить" type="submit" />
    </form>
</div>
<? Html::generateBlocksHtml($blocks); ?>