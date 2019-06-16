<?php

class __Mustache_9806dcd34744caf68c05fd5a997e5cdf extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<li class="list-group-item well well-small">
';
        $buffer .= $indent . '<div data-region="course-events-container" id="course-events-container-';
        $value = $this->resolveValue($context->find('id'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" data-course-id="';
        $value = $this->resolveValue($context->find('id'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '">
';
        $buffer .= $indent . '    <div class="row-fluid">
';
        $buffer .= $indent . '        <div class="span3">
';
        if ($partial = $this->mustache->loadPartial('block_myoverview/course-summary')) {
            $buffer .= $partial->renderInternal($context, $indent . '            ');
        }
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div class="span9">
';
        $buffer .= $indent . '            ';
        
        $blocksContext['limit'] = array($this, 'block559f7db53a40c1c3f9936d92e79ff2b8');
        $blocksContext['offset'] = array($this, 'blockE13f09ec51e6aa10c3789885dab1c67f');
        $blocksContext['courseid'] = array($this, 'blockF7bac88deaf761986dad4497b2c710d6');
        
        if ($parent = $this->mustache->loadPartial('block_myoverview/course-event-list')) {
            $context->pushBlockContext($blocksContext);
            $buffer .= $parent->renderInternal($context, $indent);
            $context->popBlockContext();
        }
        $buffer .= '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '</li>
';

        return $buffer;
    }


    public function block559f7db53a40c1c3f9936d92e79ff2b8($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= '10';
    
        return $buffer;
    }

    public function blockE13f09ec51e6aa10c3789885dab1c67f($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= '0';
    
        return $buffer;
    }

    public function blockF7bac88deaf761986dad4497b2c710d6($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $value = $this->resolveValue($context->find('id'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
    
        return $buffer;
    }
}
