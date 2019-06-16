<?php

class __Mustache_514b2ca7f4d09982df287643265dfa12 extends Mustache_Template
{
    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<a href="';
        $value = $this->resolveValue($context->find('url'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '"
';
        $buffer .= $indent . '    data-container="body"
';
        $buffer .= $indent . '    data-toggle="popover"
';
        $buffer .= $indent . '    data-html="true"
';
        $buffer .= $indent . '    data-trigger="hover"
';
        $buffer .= $indent . '    data-placement="top"
';
        $buffer .= $indent . '    data-title="';
        $value = $this->resolveValue($context->find('title'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '"
';
        $buffer .= $indent . '    data-content="';
        $value = $this->resolveValue($context->find('content'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '"
';
        $buffer .= $indent . '>';
        $value = $this->resolveValue($context->find('day'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</a>
';

        return $buffer;
    }
}
