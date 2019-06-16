<?php

class __Mustache_7dc20f838c9f69180c45e711803e9a7f extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<div id="snap-footer-alert" tabindex="-1">
';
        $buffer .= $indent . '    <h5 class="snap-footer-alert-title"></h5>
';
        $buffer .= $indent . '    <p class="sr-only">-</p>
';
        $buffer .= $indent . '    <a class="snap-footer-alert-cancel snap-action-icon snap-icon-close" href="#">
';
        $buffer .= $indent . '        <small>';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section41daf2a5bd82b6e0ae970791683f4776($context, $indent, $value);
        $buffer .= '</small>
';
        $buffer .= $indent . '    </a>
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section41daf2a5bd82b6e0ae970791683f4776(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'cancel, moodle';
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
                
                $buffer .= 'cancel, moodle';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
