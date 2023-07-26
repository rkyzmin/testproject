<?php

namespace helpers;

class Html
{
    public static function generateBlocksHtml($blocks = [], $childId = null, $isChild = false)
    {
        foreach ($blocks as $block) {
            $dataParent = $isChild ? 'data-parent-id="' . $childId . '"' : '';

            echo '<div ' . $dataParent . ' class="blocks">';
            echo self::generateButtonsForAdmin('header', $block['id']);

            echo '<input placeholder="Название" id="title" type="text" value="' . $block['name'] . '"/>
                  <br />
                  <textarea placeholder="Описание" id="description">' . $block['description'] . '</textarea>
                  <br />' . self::generateButtonsForAdmin('footer', $block['id']);

            if ($block['childrens']) {
                echo '<button class="show-elements-admin main" data-show-ch-parents="' . $block['id'] . '">Раскрыть</button>';

                foreach ($block['childrens'] as $child) {
                    echo '<div id="elementId_'. $child['id'] .'" data-parent-id="' . $block['id'] . '">';
                    echo self::generateButtonsForAdmin('header', $child['id']);
                    echo '<input placeholder="Название" id="title" type="text" value="' . $child['name'] . '"/>
                    <br />
                    <textarea placeholder="Описание" id="description">' . $child['description'] . '</textarea>
                    <br />' . self::generateButtonsForAdmin('footer', $child['id']);;
                    
                    if ($child['childrens']) {
                        echo '<button class="show-elements-admin child" data-show-ch-parents="' . $child['id'] . '">Раскрыть</button>';
                        self::generateBlocksHtml($child['childrens'], $child['id'], true);
                    }

                    echo '</div>';
                }
            }
            echo '</div>';
        }
    }

    private static function generateButtonsForAdmin($type, $id)
    {
        if (Functions::checkPageAdmin()) return '';
        if ($type === 'header') {
            return '<button data-id="' . $id . '" class="add-children-block">Добавить подблок</button>';
        } elseif($type === 'footer') {
            return '<div class="buttons-footer-block-blocks">
            <button data-id="' . $id . '" class="update-item-block">Обновить</button>
            <button data-delete-id="' . $id . '" class="delete-item-block">Удалить</button></div>';
        }
    } 
}
