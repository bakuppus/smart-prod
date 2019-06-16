<?php

class __Mustache_c645c4bf4f3753eeae67d791f7d18c00 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<div id="completed-view-';
        $value = $this->resolveValue($context->find('uniqid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" data-region="completed-view">
';
        // 'completedview.courses' section
        $value = $context->findDot('completedview.courses');
        $buffer .= $this->section5deb0a720a176fbb161e3f99b199db42($context, $indent, $value);
        // 'completedview.courses' inverted section
        $value = $context->findDot('completedview.courses');
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
            $buffer .= $this->sectionC4db55fdc4fb8a20db82a63cabfbe4ad($context, $indent, $value);
            $buffer .= '"
';
            $buffer .= $indent . '                role="presentation">
';
            $buffer .= $indent . '            <p class="text-muted m-t-1">';
            // 'str' section
            $value = $context->find('str');
            $buffer .= $this->sectionC4db55fdc4fb8a20db82a63cabfbe4ad($context, $indent, $value);
            $buffer .= '</p>
';
            $buffer .= $indent . '        </div>
';
        }
        $buffer .= $indent . '</div>
';
        // 'js' section
        $value = $context->find('js');
        $buffer .= $this->sectionC9515a7feca505e3a2df46d644f43c94($context, $indent, $value);

        return $buffer;
    }

    private function sectionEae39f17d64506abc0f4582948261e60(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' timecompleted, local_report_completion ';
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
                
                $buffer .= ' timecompleted, local_report_completion ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionCa85987b166d5da16d93dabc90548bf6(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' timeexpires, local_report_completion ';
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
                
                $buffer .= ' timeexpires, local_report_completion ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0219005862006185721ede695a7f2955(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                        <span class="finaltimeexpires">
                                            ({{#str}} timeexpires, local_report_completion {{/str}} {{ timeexpires }})
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
                
                $buffer .= $indent . '                                        <span class="finaltimeexpires">
';
                $buffer .= $indent . '                                            (';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->sectionCa85987b166d5da16d93dabc90548bf6($context, $indent, $value);
                $buffer .= ' ';
                $value = $this->resolveValue($context->find('timeexpires'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ')
';
                $buffer .= $indent . '                                        </span>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section93f020664ed5c87e8857b3d54aa96ac6(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' finalscore, block_mycourses,  {{ finalscore }} ';
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
                
                $buffer .= ' finalscore, block_mycourses,  ';
                $value = $this->resolveValue($context->find('finalscore'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ' ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section6192089b1d39fda80cf4015d5cf235ac(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' downloadcert, block_mycourses ';
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
                
                $buffer .= ' downloadcert, block_mycourses ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD927491b2b56b9ef59dfd54909bacc64(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                        <span class="finalcertificate">
                                            <a class="btn btn-info" href="{{ certificate }}">{{#str}} downloadcert, block_mycourses {{/str}}</a>
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
                
                $buffer .= $indent . '                                        <span class="finalcertificate">
';
                $buffer .= $indent . '                                            <a class="btn btn-info" href="';
                $value = $this->resolveValue($context->find('certificate'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section6192089b1d39fda80cf4015d5cf235ac($context, $indent, $value);
                $buffer .= '</a>
';
                $buffer .= $indent . '                                        </span>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section1b18d8ada0e8aae0862d700f2f330d43(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' nocerttodownload, block_mycourses ';
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
                
                $buffer .= ' nocerttodownload, block_mycourses ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5deb0a720a176fbb161e3f99b199db42(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <div class="tab-content">
            <div class="tab-pane active fade in" id="mycourses_completed_view">
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
                            <div class="finalresults">
                                <p>
                                    <span class="finaltimecompleted">
                                        {{#str}} timecompleted, local_report_completion {{/str}} {{ timecompleted }}
                                    </span>
                                    {{#timeexpires}}
                                        <span class="finaltimeexpires">
                                            ({{#str}} timeexpires, local_report_completion {{/str}} {{ timeexpires }})
                                        </span>
                                    {{/timeexpires}}
                                </p>
                                <p>
                                    <span class="finalscore">
                                        {{#str}} finalscore, block_mycourses,  {{ finalscore }} {{/str}}
                                    </span>
                                    {{#certificate}}
                                        <span class="finalcertificate">
                                            <a class="btn btn-info" href="{{ certificate }}">{{#str}} downloadcert, block_mycourses {{/str}}</a>
                                        </span>
                                    {{/certificate}}
                                    {{^certificate}}
                                        <span class="finalcertificate">
                                            {{#str}} nocerttodownload, block_mycourses {{/str}}
                                        </span>
                                    {{/certificate}}
                                </p>
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
                $buffer .= $indent . '            <div class="tab-pane active fade in" id="mycourses_completed_view">
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
                $buffer .= $indent . '                            <div class="finalresults">
';
                $buffer .= $indent . '                                <p>
';
                $buffer .= $indent . '                                    <span class="finaltimecompleted">
';
                $buffer .= $indent . '                                        ';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->sectionEae39f17d64506abc0f4582948261e60($context, $indent, $value);
                $buffer .= ' ';
                $value = $this->resolveValue($context->find('timecompleted'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '
';
                $buffer .= $indent . '                                    </span>
';
                // 'timeexpires' section
                $value = $context->find('timeexpires');
                $buffer .= $this->section0219005862006185721ede695a7f2955($context, $indent, $value);
                $buffer .= $indent . '                                </p>
';
                $buffer .= $indent . '                                <p>
';
                $buffer .= $indent . '                                    <span class="finalscore">
';
                $buffer .= $indent . '                                        ';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section93f020664ed5c87e8857b3d54aa96ac6($context, $indent, $value);
                $buffer .= '
';
                $buffer .= $indent . '                                    </span>
';
                // 'certificate' section
                $value = $context->find('certificate');
                $buffer .= $this->sectionD927491b2b56b9ef59dfd54909bacc64($context, $indent, $value);
                // 'certificate' inverted section
                $value = $context->find('certificate');
                if (empty($value)) {
                    
                    $buffer .= $indent . '                                        <span class="finalcertificate">
';
                    $buffer .= $indent . '                                            ';
                    // 'str' section
                    $value = $context->find('str');
                    $buffer .= $this->section1b18d8ada0e8aae0862d700f2f330d43($context, $indent, $value);
                    $buffer .= '
';
                    $buffer .= $indent . '                                        </span>
';
                }
                $buffer .= $indent . '                                </p>
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

    private function sectionC4db55fdc4fb8a20db82a63cabfbe4ad(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' nocompleted, block_mycourses ';
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
                
                $buffer .= ' nocompleted, block_mycourses ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC9515a7feca505e3a2df46d644f43c94(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
require([\'jquery\', \'core/custom_interaction_events\'], function($, customEvents) {
    var root = $(\'#completed-view-{{uniqid}}\');
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
                $buffer .= $indent . '    var root = $(\'#completed-view-';
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
