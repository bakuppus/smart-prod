<?php

class __Mustache_b82ab9287727aae61c562d0131f6cf1b extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<div id="';
        $blockFunction = $context->findInBlock('pagingcontentid');
        if (is_callable($blockFunction)) {
            $buffer .= call_user_func($blockFunction, $context);
        } else {
            $buffer .= 'paging-content-';
            $value = $this->resolveValue($context->find('uniqid'), $context);
            $buffer .= call_user_func($this->mustache->getEscape(), $value);
        }
        $buffer .= '" data-region="paging-content">
';
        // 'pages' section
        $value = $context->find('pages');
        $buffer .= $this->section52c671a2ebe8b38cb041e947ecde0774($context, $indent, $value);
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section52c671a2ebe8b38cb041e947ecde0774(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        {{$paging-content-item}}
            {{> block_myoverview/paging-content-item }}
        {{/paging-content-item}}
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
                
                $blockFunction = $context->findInBlock('paging-content-item');
                if (is_callable($blockFunction)) {
                    $buffer .= call_user_func($blockFunction, $context);
                } else {
                    if ($partial = $this->mustache->loadPartial('block_myoverview/paging-content-item')) {
                        $buffer .= $partial->renderInternal($context, $indent . '            ');
                    }
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
