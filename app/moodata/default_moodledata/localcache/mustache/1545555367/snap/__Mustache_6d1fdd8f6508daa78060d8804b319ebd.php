<?php

class __Mustache_6d1fdd8f6508daa78060d8804b319ebd extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        // 'progress' section
        $value = $context->find('progress');
        $buffer .= $this->section019efc14fe766c5ab37817ddcac81b40($context, $indent, $value);
        $buffer .= $indent . '
';

        return $buffer;
    }

    private function sectionF0c3cd370929743306d05c2fd8071571(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'completed, completion';
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
                
                $buffer .= 'completed, completion';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB6ca6d9067c8f6c5fd7bad4445c49673(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <img class="snap-section-complete" src="{{pixcompleted}}" alt="{{#str}}completed, completion{{/str}}" />
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
                
                $buffer .= $indent . '        <img class="snap-section-complete" src="';
                $value = $this->resolveValue($context->find('pixcompleted'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" alt="';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->sectionF0c3cd370929743306d05c2fd8071571($context, $indent, $value);
                $buffer .= '" />
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionE41c48cfae31444530bac0efded47723(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' progresstotal, completion, { "complete":  {{progress.complete}}, "total": {{progress.total}} } ';
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
                
                $buffer .= ' progresstotal, completion, { "complete":  ';
                $value = $this->resolveValue($context->findDot('progress.complete'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ', "total": ';
                $value = $this->resolveValue($context->findDot('progress.total'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ' } ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionCbbda122867e44748bac846fd1d61951(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <span class="text completionstatus outoftotal">
        {{#completed}}
        <img class="snap-section-complete" src="{{pixcompleted}}" alt="{{#str}}completed, completion{{/str}}" />
        {{/completed}}
        {{^completed}}
          <img class="snap-section-complete" src="{{pixnotcompleted}}">

		{{/completed}}

        <small>
            {{#str}} progresstotal, completion, { "complete":  {{progress.complete}}, "total": {{progress.total}} } {{/str}}
        </small>
    </span>
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
                
                $buffer .= $indent . '    <span class="text completionstatus outoftotal">
';
                // 'completed' section
                $value = $context->find('completed');
                $buffer .= $this->sectionB6ca6d9067c8f6c5fd7bad4445c49673($context, $indent, $value);
                // 'completed' inverted section
                $value = $context->find('completed');
                if (empty($value)) {
                    
                    $buffer .= $indent . '          <img class="snap-section-complete" src="';
                    $value = $this->resolveValue($context->find('pixnotcompleted'), $context);
                    $buffer .= call_user_func($this->mustache->getEscape(), $value);
                    $buffer .= '">
';
                    $buffer .= $indent . '
';
                }
                $buffer .= $indent . '
';
                $buffer .= $indent . '        <small>
';
                $buffer .= $indent . '            ';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->sectionE41c48cfae31444530bac0efded47723($context, $indent, $value);
                $buffer .= '
';
                $buffer .= $indent . '        </small>
';
                $buffer .= $indent . '    </span>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section019efc14fe766c5ab37817ddcac81b40(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#progress.total}}
    <span class="text completionstatus outoftotal">
        {{#completed}}
        <img class="snap-section-complete" src="{{pixcompleted}}" alt="{{#str}}completed, completion{{/str}}" />
        {{/completed}}
        {{^completed}}
          <img class="snap-section-complete" src="{{pixnotcompleted}}">

		{{/completed}}

        <small>
            {{#str}} progresstotal, completion, { "complete":  {{progress.complete}}, "total": {{progress.total}} } {{/str}}
        </small>
    </span>
{{/progress.total}}';
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
                
                // 'progress.total' section
                $value = $context->findDot('progress.total');
                $buffer .= $this->sectionCbbda122867e44748bac846fd1d61951($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
