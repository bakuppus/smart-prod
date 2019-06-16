<?php

class __Mustache_48645908c115ccda52a74df2725aed46 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '
';
        $buffer .= $indent . '<div id="block-mycourses-';
        $value = $this->resolveValue($context->find('uniqid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" class="block-mycourses" data-region="mycourses">
';
        $buffer .= $indent . '    <ul id="block-mycourses-view-choices-';
        $value = $this->resolveValue($context->find('uniqid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" class="nav nav-tabs" role="tablist">
';
        $buffer .= $indent . '        <li class="nav-item">
';
        $buffer .= $indent . '            <a class="nav-link ';
        // 'viewingavailable' section
        $value = $context->find('viewingavailable');
        $buffer .= $this->section5749c750acb0d7477dd5257d00cc6d53($context, $indent, $value);
        $buffer .= '" href="#mycourses_available_view" role="tab" data-toggle="tab" data-tabname="available">
';
        $buffer .= $indent . '                ';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section601b46f20ad4e6bdf9483fb6e924326c($context, $indent, $value);
        $buffer .= '
';
        $buffer .= $indent . '            </a>
';
        $buffer .= $indent . '        </li>
';
        $buffer .= $indent . '        <li class="nav-item">
';
        $buffer .= $indent . '            <a class="nav-link ';
        // 'viewinginprogress' section
        $value = $context->find('viewinginprogress');
        $buffer .= $this->section5749c750acb0d7477dd5257d00cc6d53($context, $indent, $value);
        $buffer .= '" href="#mycourses_inprogress_view" role="tab" data-toggle="tab" data-tabname="inprogress">
';
        $buffer .= $indent . '                ';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->sectionB100fc002a36094af3cdb888313f2764($context, $indent, $value);
        $buffer .= '
';
        $buffer .= $indent . '            </a>
';
        $buffer .= $indent . '        </li>
';
        $buffer .= $indent . '        <li class="nav-item">
';
        $buffer .= $indent . '            <a class="nav-link ';
        // 'viewingcompleted' section
        $value = $context->find('viewingcompleted');
        $buffer .= $this->section5749c750acb0d7477dd5257d00cc6d53($context, $indent, $value);
        $buffer .= '" href="#mycourses_completed_view" role="tab" data-toggle="tab" data-tabname="completed">
';
        $buffer .= $indent . '                ';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section0810380b433941fb8cc4005bb73f9603($context, $indent, $value);
        $buffer .= '
';
        $buffer .= $indent . '            </a>
';
        $buffer .= $indent . '        </li>
';
        $buffer .= $indent . '    </ul>
';
        $buffer .= $indent . '    <div class="tab-content content-centred">
';
        $buffer .= $indent . '        <div role="tabpanel" class="tab-pane fade ';
        // 'viewingavailable' section
        $value = $context->find('viewingavailable');
        $buffer .= $this->sectionB0e8312871c146eeab1ac64ca5f7f422($context, $indent, $value);
        $buffer .= '" id="mycourses_available_view">
';
        if ($partial = $this->mustache->loadPartial('block_mycourses/available-view')) {
            $buffer .= $partial->renderInternal($context, $indent . '            ');
        }
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div role="tabpanel" class="tab-pane fade ';
        // 'viewinginprogress' section
        $value = $context->find('viewinginprogress');
        $buffer .= $this->sectionB0e8312871c146eeab1ac64ca5f7f422($context, $indent, $value);
        $buffer .= '" id="mycourses_inprogress_view">
';
        if ($partial = $this->mustache->loadPartial('block_mycourses/inprogress-view')) {
            $buffer .= $partial->renderInternal($context, $indent . '            ');
        }
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div role="tabpanel" class="tab-pane fade ';
        // 'viewingcompleted' section
        $value = $context->find('viewingcompleted');
        $buffer .= $this->sectionB0e8312871c146eeab1ac64ca5f7f422($context, $indent, $value);
        $buffer .= '" id="mycourses_completed_view">
';
        if ($partial = $this->mustache->loadPartial('block_mycourses/completed-view')) {
            $buffer .= $partial->renderInternal($context, $indent . '            ');
        }
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';
        // 'js' section
        $value = $context->find('js');
        $buffer .= $this->sectionC0328a3b1ccde64cc262fe0f5abbe845($context, $indent, $value);

        return $buffer;
    }

    private function section5749c750acb0d7477dd5257d00cc6d53(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'active';
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
                
                $buffer .= 'active';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section601b46f20ad4e6bdf9483fb6e924326c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' availableheader, block_mycourses ';
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
                
                $buffer .= ' availableheader, block_mycourses ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB100fc002a36094af3cdb888313f2764(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' inprogressheader, block_mycourses ';
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
                
                $buffer .= ' inprogressheader, block_mycourses ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0810380b433941fb8cc4005bb73f9603(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' completedheader, block_mycourses ';
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
                
                $buffer .= ' completedheader, block_mycourses ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB0e8312871c146eeab1ac64ca5f7f422(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'in active';
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
                
                $buffer .= 'in active';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC0328a3b1ccde64cc262fe0f5abbe845(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
require([\'jquery\', \'block_mycourses/tab_preferences\'], function($, TabPreferences) {
    var root = $(\'#block-mycourses-view-choices-{{uniqid}}\');
    TabPreferences.registerEventListeners(root);
});
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
                
                $buffer .= $indent . 'require([\'jquery\', \'block_mycourses/tab_preferences\'], function($, TabPreferences) {
';
                $buffer .= $indent . '    var root = $(\'#block-mycourses-view-choices-';
                $value = $this->resolveValue($context->find('uniqid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '\');
';
                $buffer .= $indent . '    TabPreferences.registerEventListeners(root);
';
                $buffer .= $indent . '});
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
