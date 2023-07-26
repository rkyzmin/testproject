<?php

namespace Models;

use base\Database;

class Blocks extends Database
{
    protected $table = 'blocks';

    public function allBlocks()
    {
        $elements = $this->show(['id', 'name', 'description', 'parent']);
        return $this->sortedTreeElements($elements);
    }

    private function sortedTreeElements($blocks, $parent = null)
    {
        $newElements = [];
        foreach ($blocks as $block) {
            if ($block['parent'] === $parent) {
                $children = $this->sortedTreeElements($blocks, $block['id']);
                if ($children) {
                    $block['childrens'] = $children;
                }
                $newElements[] = $block;
            }
        }
        return $newElements;
    }

    public function deleteElements($id)
    {
        $this->delete("id=$id");
        $this->deleteChildsElements($id);
    }

    private function deleteChildsElements($id)
    {
        $where = ['parent' => $id];
        $elements = $this->show(['id'], $where);

        if (!empty($elements)) {
            foreach($elements as $element) {
                $elId = $element['id'];
                $this->delete("id=$elId");
                $this->deleteChildsElements($element['id']);
            }
        }
    }
}
