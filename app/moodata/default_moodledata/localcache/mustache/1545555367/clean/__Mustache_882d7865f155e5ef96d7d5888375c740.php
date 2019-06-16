<?php

class __Mustache_882d7865f155e5ef96d7d5888375c740 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<a id="';
        $value = $this->resolveValue($context->find('uniqid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" href="';
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
        $buffer .= '">';
        $value = $this->resolveValue($context->find('day'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</a>
';
        // 'js' section
        $value = $context->find('js');
        $buffer .= $this->section853a9fded22656627523105e6c6e34d6($context, $indent, $value);

        return $buffer;
    }

    private function section853a9fded22656627523105e6c6e34d6(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
require([\'jquery\'], function($) {
    require([\'theme_bootstrapbase/bootstrap\'], function() {
        $(\'#{{uniqid}}\').popover();
    });
});
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
                
                $buffer .= $indent . 'require([\'jquery\'], function($) {
';
                $buffer .= $indent . '    require([\'theme_bootstrapbase/bootstrap\'], function() {
';
                $buffer .= $indent . '        $(\'#';
                $value = $this->resolveValue($context->find('uniqid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '\').popover();
';
                $buffer .= $indent . '    });
';
                $buffer .= $indent . '});
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
