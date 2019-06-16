<?php

class __Mustache_56137bf39f81eed770bc6bdab4b12c11 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<form action="';
        $value = $this->resolveValue($context->find('actionurl'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" method="post" id="adminsettings">
';
        $buffer .= $indent . '    <div class="settingsform">
';
        // 'params' section
        $value = $context->find('params');
        $buffer .= $this->sectionD439dff29f5e8cacbed4e41d7326c83c($context, $indent, $value);
        $buffer .= $indent . '        <input type="hidden" name="sesskey" value="';
        $value = $this->resolveValue($context->find('sesskey'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '">
';
        $buffer .= $indent . '        <input type="hidden" name="return" value="';
        $value = $this->resolveValue($context->find('return'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '">
';
        // 'title' section
        $value = $context->find('title');
        $buffer .= $this->section900e2292b5786e60becac7a747079087($context, $indent, $value);
        $buffer .= $indent . '        ';
        $value = $this->resolveValue($context->find('settings'), $context);
        $buffer .= $value;
        $buffer .= '
';
        // 'showsave' section
        $value = $context->find('showsave');
        $buffer .= $this->section7f7635474387aa9f2fd4097e761eb8dd($context, $indent, $value);
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</form>
';

        return $buffer;
    }

    private function sectionD439dff29f5e8cacbed4e41d7326c83c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <input type="hidden" name="{{name}}" value="{{value}}">
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
                
                $buffer .= $indent . '            <input type="hidden" name="';
                $value = $this->resolveValue($context->find('name'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" value="';
                $value = $this->resolveValue($context->find('value'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section900e2292b5786e60becac7a747079087(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <h2>{{title}}</h2>
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
                
                $buffer .= $indent . '            <h2>';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</h2>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionE5479b5825bee73d37f8a0a91fe85548(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'savechanges, admin';
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
                
                $buffer .= 'savechanges, admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section7f7635474387aa9f2fd4097e761eb8dd(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <button type="submit" class="btn btn-primary">{{#str}}savechanges, admin{{/str}}</button>
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
                
                $buffer .= $indent . '            <button type="submit" class="btn btn-primary">';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->sectionE5479b5825bee73d37f8a0a91fe85548($context, $indent, $value);
                $buffer .= '</button>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
