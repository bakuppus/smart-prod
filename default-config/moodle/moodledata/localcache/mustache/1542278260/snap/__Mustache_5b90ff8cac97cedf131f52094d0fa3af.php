<?php

class __Mustache_5b90ff8cac97cedf131f52094d0fa3af extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<div id="available-view-';
        $value = $this->resolveValue($context->find('uniqid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" data-region="available-view">
';
        // 'availableview.courses' section
        $value = $context->findDot('availableview.courses');
        $buffer .= $this->section52f13ebe2875fc37381396b238181225($context, $indent, $value);
        // 'availableview.courses' inverted section
        $value = $context->findDot('availableview.courses');
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
            $buffer .= $this->section2d910c667fe8242cc14586fd033af0a7($context, $indent, $value);
            $buffer .= '"
';
            $buffer .= $indent . '                role="presentation">
';
            $buffer .= $indent . '            <p class="text-muted m-t-1">';
            // 'str' section
            $value = $context->find('str');
            $buffer .= $this->section2d910c667fe8242cc14586fd033af0a7($context, $indent, $value);
            $buffer .= '</p>
';
            $buffer .= $indent . '        </div>
';
        }
        $buffer .= $indent . '</div>
';
        // 'js' section
        $value = $context->find('js');
        $buffer .= $this->sectionDaeec9e590cc1fed0784c01596335a72($context, $indent, $value);

        return $buffer;
    }

    private function section52f13ebe2875fc37381396b238181225(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <div class="tab-content">
            <div class="tab-pane active fade in" id="mycourses_available_view">
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
                $buffer .= $indent . '            <div class="tab-pane active fade in" id="mycourses_available_view">
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

    private function section2d910c667fe8242cc14586fd033af0a7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' noavailable, block_mycourses ';
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
                
                $buffer .= ' noavailable, block_mycourses ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionDaeec9e590cc1fed0784c01596335a72(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
require([\'jquery\', \'core/custom_interaction_events\'], function($, customEvents) {
    var root = $(\'#available-view-{{uniqid}}\');
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
                $buffer .= $indent . '    var root = $(\'#available-view-';
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
