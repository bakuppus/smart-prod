<?php

class __Mustache_3824cc1b92a2edbdb15b00c47b7bf219 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        
        $blocksContext['element'] = array($this, 'block59c33681bfe971ab471dfc1a7af26c0c');
        
        if ($parent = $this->mustache->loadPartial('core_form/element-template')) {
            $context->pushBlockContext($blocksContext);
            $buffer .= $parent->renderInternal($context, $indent);
            $context->popBlockContext();
        }

        return $buffer;
    }

    private function section03ae853a492a34ffcd7ac0559504074c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            {{{separator}}}
            {{{html}}}
        ';
            $result = call_user_func($value, $source, $this->lambdaHelper);
            if (strpos($result, '{{') === false) {
                $buffer .= $result;
            } else {
                $buffer .= $this->mustache
                    ->loadLambda((string) $result)
                    ->renderInternal($context);
            }
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '            ';
                $value = $this->resolveValue($context->find('separator'), $context);
                $buffer .= $value;
                $buffer .= '
';
                $buffer .= $indent . '            ';
                $value = $this->resolveValue($context->find('html'), $context);
                $buffer .= $value;
                $buffer .= '
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    public function block59c33681bfe971ab471dfc1a7af26c0c($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= $indent . '        <span class="fdate_selector">
';
        // 'element.elements' section
        $value = $context->findDot('element.elements');
        $buffer .= $this->section03ae853a492a34ffcd7ac0559504074c($context, $indent, $value);
        $buffer .= $indent . '        </span>
';
    
        return $buffer;
    }
}
