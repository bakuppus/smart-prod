<?php

class __Mustache_f75ad980dca835f25c341f279fa49122 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<div id="snap-coverimagecontrol">
';
        $buffer .= $indent . '    <label class="btn btn-sm btn-file btn-solid state-visible" for="snap-coverfiles"><span>';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section9e28db84f3c37e2aa8e634b114954092($context, $indent, $value);
        $buffer .= '</span>
';
        $buffer .= $indent . '       <input id="snap-coverfiles" name="snap-coverfiles[]" type="file" accept="';
        $value = $this->resolveValue($context->find('accepttypes'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '"/>
';
        $buffer .= $indent . '    </label>
';
        $buffer .= $indent . '    <div id="snap-changecoverimageconfirmation">
';
        $buffer .= $indent . '        <button class="btn btn-sm btn-success ok">';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section85013410d02573b6024cadd85ef4af88($context, $indent, $value);
        $buffer .= '</button>
';
        $buffer .= $indent . '        <button class="btn btn-sm btn-danger cancel">';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section41daf2a5bd82b6e0ae970791683f4776($context, $indent, $value);
        $buffer .= '</button>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section9e28db84f3c37e2aa8e634b114954092(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'changecoverimage, theme_snap';
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
                
                $buffer .= 'changecoverimage, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section85013410d02573b6024cadd85ef4af88(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'save, admin';
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
                
                $buffer .= 'save, admin';
                $context->pop();
            }
        }
    
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
