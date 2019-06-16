<?php

class __Mustache_da275f4f8b67b4e27f6c5e5f6525f9bb extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<nav class="section_footer">
';
        // 'previous' section
        $value = $context->find('previous');
        $buffer .= $this->section67bbb65121761539b0a39b3977ec94d9($context, $indent, $value);
        // 'next' section
        $value = $context->find('next');
        $buffer .= $this->sectionBa01b0bdd079a6bade2d6f701c359815($context, $indent, $value);
        $buffer .= $indent . '</nav>
';

        return $buffer;
    }

    private function sectionBf20dcc0ab9509c23a04cd0a689e9dde(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'previoussection, theme_snap';
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
                
                $buffer .= 'previoussection, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section67bbb65121761539b0a39b3977ec94d9(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <a class="previous_section {{classes}}" href="#section-{{section}}">
        <div class="nav_icon"><i class="icon-arrow-left"></i></div>
        <span class="text"><span class="nav_guide">{{#str}}previoussection, theme_snap{{/str}}</span><br>{{{title}}}</span>
    </a>
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
                
                $buffer .= $indent . '    <a class="previous_section ';
                $value = $this->resolveValue($context->find('classes'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" href="#section-';
                $value = $this->resolveValue($context->find('section'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                $buffer .= $indent . '        <div class="nav_icon"><i class="icon-arrow-left"></i></div>
';
                $buffer .= $indent . '        <span class="text"><span class="nav_guide">';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->sectionBf20dcc0ab9509c23a04cd0a689e9dde($context, $indent, $value);
                $buffer .= '</span><br>';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= $value;
                $buffer .= '</span>
';
                $buffer .= $indent . '    </a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section33dfbe9154c2c9bc90b1e9b9a9944fb3(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'nextsection, theme_snap';
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
                
                $buffer .= 'nextsection, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionBa01b0bdd079a6bade2d6f701c359815(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <a class="next_section {{classes}}" href="#section-{{section}}">
        <div class="nav_icon"><i class="icon-arrow-right"></i></div>
        <span class="text"><span class="nav_guide">{{#str}}nextsection, theme_snap{{/str}}</span><br>{{{title}}}</span>
    </a>
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
                
                $buffer .= $indent . '    <a class="next_section ';
                $value = $this->resolveValue($context->find('classes'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" href="#section-';
                $value = $this->resolveValue($context->find('section'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                $buffer .= $indent . '        <div class="nav_icon"><i class="icon-arrow-right"></i></div>
';
                $buffer .= $indent . '        <span class="text"><span class="nav_guide">';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section33dfbe9154c2c9bc90b1e9b9a9944fb3($context, $indent, $value);
                $buffer .= '</span><br>';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= $value;
                $buffer .= '</span>
';
                $buffer .= $indent . '    </a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
