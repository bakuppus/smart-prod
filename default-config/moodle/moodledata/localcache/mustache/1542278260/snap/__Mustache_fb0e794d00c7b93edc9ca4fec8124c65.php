<?php

class __Mustache_fb0e794d00c7b93edc9ca4fec8124c65 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';
        $blocksContext = array();

        if ($partial = $this->mustache->loadPartial('core_form/element-select')) {
            $buffer .= $partial->renderInternal($context);
        }

        return $buffer;
    }
}
