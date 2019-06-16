<?php

class __Mustache_729ab0af88d6cecb0db87496e63120b2 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<a class="js-only pull-right btn btn-link iconhelp" data-toggle="collapse" href="#snap-collapse-help" aria-expanded="false"
';
        $buffer .= $indent . 'aria-controls="snap-collapse-help">';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section2ff95bd097ee2ac609895954971e3e3b($context, $indent, $value);
        // 'pix' section
        $value = $context->find('pix');
        $buffer .= $this->section9068408c51c0bf987e6eb893e20da51e($context, $indent, $value);
        $buffer .= '</a>
';
        $buffer .= $indent . '<div class="collapse row" id="snap-collapse-help">
';
        $buffer .= $indent . '        <div class="col-md-4">
';
        $buffer .= $indent . '            <h3>';
        $value = $this->resolveValue($context->find('modtitle'), $context);
        $buffer .= $value;
        $buffer .= ' ';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section2ff95bd097ee2ac609895954971e3e3b($context, $indent, $value);
        $buffer .= '</h3>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div class="col-md-8">
';
        $buffer .= $indent . '            ';
        $value = $this->resolveValue($context->find('helptext'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section2ff95bd097ee2ac609895954971e3e3b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'help';
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
                
                $buffer .= 'help';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section9068408c51c0bf987e6eb893e20da51e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'help, theme_snap, {{#str}}help{{/str}}';
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
                
                $buffer .= 'help, theme_snap, ';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section2ff95bd097ee2ac609895954971e3e3b($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
