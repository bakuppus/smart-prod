<?php

class __Mustache_cb5a6c842dc49e38f554b0abdc1d0f31 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<div id="inprogress-view-';
        $value = $this->resolveValue($context->find('uniqid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" data-region="inprogress-view">
';
        // 'inprogressview.courses' section
        $value = $context->findDot('inprogressview.courses');
        $buffer .= $this->sectionA6fa1e064eae9832322c686191e7ff23($context, $indent, $value);
        // 'inprogressview.courses' inverted section
        $value = $context->findDot('inprogressview.courses');
        if (empty($value)) {
            
            $buffer .= $indent . '        <div class="text-xs-center text-center m-t-3">
';
            $buffer .= $indent . '            <img class="empty-placeholder-image-lg"
';
            $buffer .= $indent . '                src="';
            $value = $this->resolveValue($context->find('nocourses'), $context);
            $buffer .= call_user_func($this->mustache->getEscape(), $value);
            $buffer .= '"
';
            $buffer .= $indent . '                alt="';
            // 'str' section
            $value = $context->find('str');
            $buffer .= $this->section3a0b264e90059775b10b35433dc03533($context, $indent, $value);
            $buffer .= '"
';
            $buffer .= $indent . '                role="presentation">
';
            $buffer .= $indent . '            <p class="text-muted m-t-1">';
            // 'str' section
            $value = $context->find('str');
            $buffer .= $this->section3a0b264e90059775b10b35433dc03533($context, $indent, $value);
            $buffer .= '</p>
';
            $buffer .= $indent . '        </div>
';
        }
        $buffer .= $indent . '</div>
';
        // 'js' section
        $value = $context->find('js');
        $buffer .= $this->sectionD9a28778cdc0e7fdb267fe13dbd2de28($context, $indent, $value);

        return $buffer;
    }

    private function sectionA6fa1e064eae9832322c686191e7ff23(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <div class="tab-content">
            <div class="tab-pane active fade in" id="mycourses_inprogress_view">
                    <div class="mycourselisting">
                        <div class="courseimage">
                            <a href="{{ url }}"><img class="imgresponsive" src="{{ image }}" class="courseimage"></a>
                        </div>
                        <div class="mycoursedetails">
                            <div class="mycourseheading">
                                <h4 class="title">
                                    <a href="{{ url }}">{{ fullname }}</a>
                                </h4>
                            </div>
                            <div class="mycoursesummary">
                                {{ summary}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
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
                
                $buffer .= $indent . '        <div class="tab-content">
';
                $buffer .= $indent . '            <div class="tab-pane active fade in" id="mycourses_inprogress_view">
';
                $buffer .= $indent . '                    <div class="mycourselisting">
';
                $buffer .= $indent . '                        <div class="courseimage">
';
                $buffer .= $indent . '                            <a href="';
                $value = $this->resolveValue($context->find('url'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '"><img class="imgresponsive" src="';
                $value = $this->resolveValue($context->find('image'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" class="courseimage"></a>
';
                $buffer .= $indent . '                        </div>
';
                $buffer .= $indent . '                        <div class="mycoursedetails">
';
                $buffer .= $indent . '                            <div class="mycourseheading">
';
                $buffer .= $indent . '                                <h4 class="title">
';
                $buffer .= $indent . '                                    <a href="';
                $value = $this->resolveValue($context->find('url'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">';
                $value = $this->resolveValue($context->find('fullname'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</a>
';
                $buffer .= $indent . '                                </h4>
';
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                            <div class="mycoursesummary">
';
                $buffer .= $indent . '                                ';
                $value = $this->resolveValue($context->find('summary'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '
';
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                        </div>
';
                $buffer .= $indent . '                    </div>
';
                $buffer .= $indent . '            </div>
';
                $buffer .= $indent . '        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section3a0b264e90059775b10b35433dc03533(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' noinprogress, block_mycourses ';
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
                
                $buffer .= ' noinprogress, block_mycourses ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD9a28778cdc0e7fdb267fe13dbd2de28(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
require([\'jquery\', \'core/custom_interaction_events\'], function($, customEvents) {
    var root = $(\'#inprogress-view-{{uniqid}}\');
    customEvents.define(root, [customEvents.events.activate]);
    root.on(customEvents.events.activate, \'[data-toggle="btns"] > .btn\', function() {
        root.find(\'.btn.active\').removeClass(\'active\');
    });
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
                
                $buffer .= $indent . 'require([\'jquery\', \'core/custom_interaction_events\'], function($, customEvents) {
';
                $buffer .= $indent . '    var root = $(\'#inprogress-view-';
                $value = $this->resolveValue($context->find('uniqid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '\');
';
                $buffer .= $indent . '    customEvents.define(root, [customEvents.events.activate]);
';
                $buffer .= $indent . '    root.on(customEvents.events.activate, \'[data-toggle="btns"] > .btn\', function() {
';
                $buffer .= $indent . '        root.find(\'.btn.active\').removeClass(\'active\');
';
                $buffer .= $indent . '    });
';
                $buffer .= $indent . '});
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
