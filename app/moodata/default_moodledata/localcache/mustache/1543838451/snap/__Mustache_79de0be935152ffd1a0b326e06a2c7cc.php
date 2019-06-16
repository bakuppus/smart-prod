<?php

class __Mustache_79de0be935152ffd1a0b326e06a2c7cc extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';
        $blocksContext = array();

        if ($partial = $this->mustache->loadPartial('core_form/element-group')) {
            $buffer .= $partial->renderInternal($context);
        }

        return $buffer;
    }
}
