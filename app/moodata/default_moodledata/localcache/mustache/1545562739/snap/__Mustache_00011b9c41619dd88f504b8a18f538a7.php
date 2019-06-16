<?php

class __Mustache_00011b9c41619dd88f504b8a18f538a7 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<ol id="chapters" class="chapters ';
        $value = $this->resolveValue($context->find('listlarge'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" start="0">
';
        // 'chapters' section
        $value = $context->find('chapters');
        $buffer .= $this->sectionEcd45b0794ff8e5845ac665a8b0c0f6d($context, $indent, $value);
        $buffer .= $indent . '</ol>
';

        return $buffer;
    }

    private function section0dbb0b5f58bf249221a5914d82cc3977(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <a class="chapter-title" href="{{url}}">{{{title}}}</a>
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
                
                $buffer .= $indent . '            <a class="chapter-title" href="';
                $value = $this->resolveValue($context->find('url'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= $value;
                $buffer .= '</a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section51ca031484bd84ad14ccccc985b7330f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'current, theme_snap';
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
                
                $buffer .= 'current, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section06bdaf9e532b811d8fb284aed8d3cb8f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <span class="text text-success">
                <small>{{#str}}current, theme_snap{{/str}}</small>
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
                
                $buffer .= $indent . '            <span class="text text-success">
';
                $buffer .= $indent . '                <small>';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section51ca031484bd84ad14ccccc985b7330f($context, $indent, $value);
                $buffer .= '</small>
';
                $buffer .= $indent . '            </span>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionFcc7e108e74d4b188d7053215ac1b844(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <span class="text {{availabilityclass}}">
                <small class="published-status">{{availabilitystatus}}</small>
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
                
                $buffer .= $indent . '            <span class="text ';
                $value = $this->resolveValue($context->find('availabilityclass'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                $buffer .= $indent . '                <small class="published-status">';
                $value = $this->resolveValue($context->find('availabilitystatus'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</small>
';
                $buffer .= $indent . '            </span>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionEcd45b0794ff8e5845ac665a8b0c0f6d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <li class="{{classes}}">
        {{#outputlink}}
            <a class="chapter-title" href="{{url}}">{{{title}}}</a>
        {{/outputlink}}
        {{^outputlink}}
            <span class="chapter-title">{{title}}</span>
        {{/outputlink}}
        {{#iscurrent}}
            <span class="text text-success">
                <small>{{#str}}current, theme_snap{{/str}}</small>
            </span>
        {{/iscurrent}}
        {{#availabilitystatus}}
            <span class="text {{availabilityclass}}">
                <small class="published-status">{{availabilitystatus}}</small>
            </span>
        {{/availabilitystatus}}
        {{> theme_snap/course_toc_progress }}
    </li>
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
                
                $buffer .= $indent . '    <li class="';
                $value = $this->resolveValue($context->find('classes'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                // 'outputlink' section
                $value = $context->find('outputlink');
                $buffer .= $this->section0dbb0b5f58bf249221a5914d82cc3977($context, $indent, $value);
                // 'outputlink' inverted section
                $value = $context->find('outputlink');
                if (empty($value)) {
                    
                    $buffer .= $indent . '            <span class="chapter-title">';
                    $value = $this->resolveValue($context->find('title'), $context);
                    $buffer .= call_user_func($this->mustache->getEscape(), $value);
                    $buffer .= '</span>
';
                }
                // 'iscurrent' section
                $value = $context->find('iscurrent');
                $buffer .= $this->section06bdaf9e532b811d8fb284aed8d3cb8f($context, $indent, $value);
                // 'availabilitystatus' section
                $value = $context->find('availabilitystatus');
                $buffer .= $this->sectionFcc7e108e74d4b188d7053215ac1b844($context, $indent, $value);
                if ($partial = $this->mustache->loadPartial('theme_snap/course_toc_progress')) {
                    $buffer .= $partial->renderInternal($context, $indent . '        ');
                }
                $buffer .= $indent . '    </li>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
