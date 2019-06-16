<?php

class __Mustache_7eda1573d9ec18b017fbc3a9d74a69a0 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        
        $blocksContext['paging-content-item'] = array($this, 'block2f5d17c61f05ade5148fc9404c54520b');
        
        if ($parent = $this->mustache->loadPartial('block_myoverview/paging-content')) {
            $context->pushBlockContext($blocksContext);
            $buffer .= $parent->renderInternal($context, $indent);
            $context->popBlockContext();
        }

        return $buffer;
    }


    public function block2f5d17c61f05ade5148fc9404c54520b($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        if ($partial = $this->mustache->loadPartial('block_myoverview/course-paging-content-item')) {
            $buffer .= $partial->renderInternal($context, $indent . '        ');
        }
    
        return $buffer;
    }
}
