<?php

class __Mustache_0070da6c56ffa74f731722abb4879b6c extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        // 'url' section
        $value = $context->find('url');
        $buffer .= $this->section9e78167a1ad86af64a452b294264b33c($context, $indent, $value);

        return $buffer;
    }

    private function section9e78167a1ad86af64a452b294264b33c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
<a title="{{{title}}}" class="{{class}}" href="{{{url}}}" role="button" {{{ariapressed}}}></a>
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
                
                $buffer .= $indent . '<a title="';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= $value;
                $buffer .= '" class="';
                $value = $this->resolveValue($context->find('class'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" href="';
                $value = $this->resolveValue($context->find('url'), $context);
                $buffer .= $value;
                $buffer .= '" role="button" ';
                $value = $this->resolveValue($context->find('ariapressed'), $context);
                $buffer .= $value;
                $buffer .= '></a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
