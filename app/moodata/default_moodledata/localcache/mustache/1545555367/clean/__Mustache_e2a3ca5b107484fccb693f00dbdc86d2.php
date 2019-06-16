<?php

class __Mustache_e2a3ca5b107484fccb693f00dbdc86d2 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        
        $blocksContext['content'] = array($this, 'blockD1b6267201114d51452958282b5201f9');
        
        if ($parent = $this->mustache->loadPartial('block_myoverview/paging-content-item')) {
            $context->pushBlockContext($blocksContext);
            $buffer .= $parent->renderInternal($context, $indent);
            $context->popBlockContext();
        }

        return $buffer;
    }

    private function sectionF5d344fc13a98c43558a57109e675a7a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            {{> block_myoverview/courses-view-course-item }}
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
                
                if ($partial = $this->mustache->loadPartial('block_myoverview/courses-view-course-item')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    public function blockD1b6267201114d51452958282b5201f9($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        // 'courses' section
        $value = $context->find('courses');
        $buffer .= $this->sectionF5d344fc13a98c43558a57109e675a7a($context, $indent, $value);
    
        return $buffer;
    }
}
