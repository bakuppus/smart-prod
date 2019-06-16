<?php

class __Mustache_2c4a8393123d1c4e7553032e7107124d extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '
';
        // 'currentcourselist' section
        $value = $context->find('currentcourselist');
        $buffer .= $this->section5102d2a74a6e4433065994de514d7970($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        // 'currentcourselist' inverted section
        $value = $context->find('currentcourselist');
        if (empty($value)) {
            
            $buffer .= $indent . '    <div id="snap-pm-courses-current" class="tab-pane clearfix active" role="tabpanel" aria-labelledby="snap-pm-tab-current">
';
            $buffer .= $indent . '        <h2>';
            // 'str' section
            $value = $context->find('str');
            $buffer .= $this->sectionF870cf92426deaef3e90c68f33111c89($context, $indent, $value);
            $buffer .= '</h2>
';
            $buffer .= $indent . '        <p>';
            // 'str' section
            $value = $context->find('str');
            $buffer .= $this->sectionE84428cefe37a090a336094be5064d59($context, $indent, $value);
            $buffer .= '</p>
';
            $buffer .= $indent . '    </div>
';
        }

        return $buffer;
    }

    private function section351e07a924acf71e9933d086008d7b7d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    {{> theme_snap/course_cards }}
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
                
                if ($partial = $this->mustache->loadPartial('theme_snap/course_cards')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                    ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD0d21f55ea83087fdcbc2e9ce73fb0f4(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <div id="snap-pm-courses-current-cards" class="clearfix">
                {{#courses}}
                    {{> theme_snap/course_cards }}
                {{/courses}}
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
                
                $buffer .= $indent . '            <div id="snap-pm-courses-current-cards" class="clearfix">
';
                // 'courses' section
                $value = $context->find('courses');
                $buffer .= $this->section351e07a924acf71e9933d086008d7b7d($context, $indent, $value);
                $buffer .= $indent . '            </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionCf5a7fff2a6a8a8f8e2c996c4d173573(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'state-visible';
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
                
                $buffer .= 'state-visible';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section3b2eabb614f9f0194a27407b645842a7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'hiddencoursestoggle, theme_snap';
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
                
                $buffer .= 'hiddencoursestoggle, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section3bf78fb28b69c9b17a062cc5cd8bd4ce(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                {{#courses}}
                    {{> theme_snap/course_cards }}
                {{/courses}}
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
                
                // 'courses' section
                $value = $context->find('courses');
                $buffer .= $this->section351e07a924acf71e9933d086008d7b7d($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5102d2a74a6e4433065994de514d7970(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div id="snap-pm-courses-current" class="tab-pane active" role="tabpanel" aria-labelledby="snap-pm-tab-current">
        {{#published}}
            <div id="snap-pm-courses-current-cards" class="clearfix">
                {{#courses}}
                    {{> theme_snap/course_cards }}
                {{/courses}}
            </div>
        {{/published}}

        <!-- Hidden courses area -->
        <div id="snap-pm-courses-hidden" class="clearfix {{#hidden.count}}state-visible{{/hidden.count}}">
            <h2><br><a data-toggle="collapse" href="#snap-pm-courses-hidden-cards" aria-expanded="false" aria-controls="snap-pm-courses-hidden-cards">{{#str}}hiddencoursestoggle, theme_snap{{/str}}</a></h2>
            <div class="collapse clearfix" id="snap-pm-courses-hidden-cards">
            {{#hidden}}
                {{#courses}}
                    {{> theme_snap/course_cards }}
                {{/courses}}
            {{/hidden}}
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
                
                $buffer .= $indent . '    <div id="snap-pm-courses-current" class="tab-pane active" role="tabpanel" aria-labelledby="snap-pm-tab-current">
';
                // 'published' section
                $value = $context->find('published');
                $buffer .= $this->sectionD0d21f55ea83087fdcbc2e9ce73fb0f4($context, $indent, $value);
                $buffer .= $indent . '
';
                $buffer .= $indent . '        <!-- Hidden courses area -->
';
                $buffer .= $indent . '        <div id="snap-pm-courses-hidden" class="clearfix ';
                // 'hidden.count' section
                $value = $context->findDot('hidden.count');
                $buffer .= $this->sectionCf5a7fff2a6a8a8f8e2c996c4d173573($context, $indent, $value);
                $buffer .= '">
';
                $buffer .= $indent . '            <h2><br><a data-toggle="collapse" href="#snap-pm-courses-hidden-cards" aria-expanded="false" aria-controls="snap-pm-courses-hidden-cards">';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section3b2eabb614f9f0194a27407b645842a7($context, $indent, $value);
                $buffer .= '</a></h2>
';
                $buffer .= $indent . '            <div class="collapse clearfix" id="snap-pm-courses-hidden-cards">
';
                // 'hidden' section
                $value = $context->find('hidden');
                $buffer .= $this->section3bf78fb28b69c9b17a062cc5cd8bd4ce($context, $indent, $value);
                $buffer .= $indent . '            </div>
';
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '
';
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionF870cf92426deaef3e90c68f33111c89(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'courses';
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
                
                $buffer .= 'courses';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionE84428cefe37a090a336094be5064d59(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'coursefixydefaulttext, theme_snap';
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
                
                $buffer .= 'coursefixydefaulttext, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
