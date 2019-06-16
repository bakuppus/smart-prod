<?php

class __Mustache_fd80cabe3e4fc465d3f6a1e374701b97 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<div data-hidden="';
        // 'published' inverted section
        $value = $context->find('published');
        if (empty($value)) {
            
            $buffer .= 'true';
        }
        // 'published' section
        $value = $context->find('published');
        $buffer .= $this->section3d743337d1ee557b470226701b73da47($context, $indent, $value);
        $buffer .= '" data-courseid="';
        $value = $this->resolveValue($context->find('courseid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" data-category="';
        $value = $this->resolveValue($context->find('category'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" data-model="';
        $value = $this->resolveValue($context->find('model'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" data-href="';
        $value = $this->resolveValue($context->find('url'), $context);
        $buffer .= $value;
        $buffer .= '" data-shortname="';
        $value = $this->resolveValue($context->find('shortname'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" class="coursecard';
        // 'favorited' section
        $value = $context->find('favorited');
        $buffer .= $this->section015a6522272385d19c46b15b1a5b54fd($context, $indent, $value);
        $buffer .= '" style="';
        $value = $this->resolveValue($context->find('imagecss'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" tabindex="-1"';
        // 'lazyloadimageurl' section
        $value = $context->find('lazyloadimageurl');
        $buffer .= $this->section89d9a98ff139221ef839a2c1758b3564($context, $indent, $value);
        $buffer .= '>
';
        // 'archived' inverted section
        $value = $context->find('archived');
        if (empty($value)) {
            
            $buffer .= $indent . '    <button class="snap-icon-toggle favoritetoggle" title="';
            $value = $this->resolveValue($context->find('toggletitle'), $context);
            $buffer .= call_user_func($this->mustache->getEscape(), $value);
            $buffer .= '" aria-pressed="';
            // 'favorited' section
            $value = $context->find('favorited');
            $buffer .= $this->section03a2cb78adf693fb240638cbbc7ea15e($context, $indent, $value);
            // 'favorited' inverted section
            $value = $context->find('favorited');
            if (empty($value)) {
                
                $buffer .= 'false';
            }
            $buffer .= '"></button>
';
        }
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div id="coursedesc" style="font-size:13px; color: white; padding-right: 30px; padding-left: 10px; padding-top: 10px; transition: all 0.3s ease-in-out; background: rgba(58, 58, 58, 0.75); height: 175px; display:none;">';
        $value = $this->resolveValue($context->find('coursedesc'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '</div>
';
        // 'js' section
        $value = $context->find('js');
        $buffer .= $this->sectionDe5940e782a9013983bff57f5a69303e($context, $indent, $value);
        $buffer .= $indent . '    <div class="coursecard-body">
';
        $buffer .= $indent . '        <h3><a class="coursecard-coursename" href="';
        $value = $this->resolveValue($context->find('url'), $context);
        $buffer .= $value;
        $buffer .= '">';
        $value = $this->resolveValue($context->find('fullname'), $context);
        $buffer .= $value;
        $buffer .= '</a></h3>
';
        $buffer .= $indent . '        <div class="coursecard-dynamicinfo">
';
        // 'feedback.coursegrade.value' section
        $value = $context->findDot('feedback.coursegrade.value');
        $buffer .= $this->sectionA0eafb9b42c92470a86db81ca579eb88($context, $indent, $value);
        // 'completion.render' section
        $value = $context->findDot('completion.render');
        $buffer .= $this->section00b22e18d2cbc909eaa68a29f1e15816($context, $indent, $value);
        $buffer .= $indent . '        </div>
';
        // 'published' inverted section
        $value = $context->find('published');
        if (empty($value)) {
            
            $buffer .= $indent . '        <small class="published-status text-warning">
';
            $buffer .= $indent . '            ';
            // 'str' section
            $value = $context->find('str');
            $buffer .= $this->section759a0269035456c18566dea7c956e088($context, $indent, $value);
            $buffer .= '
';
            $buffer .= $indent . '        </small>
';
        }
        $buffer .= $indent . '        <div class="coursecard-contacts">
';
        $buffer .= $indent . '            <h4 class="sr-only">';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section5ca723261027deddee9952896e35581a($context, $indent, $value);
        $buffer .= '</h4>
';
        // 'visibleavatars' section
        $value = $context->find('visibleavatars');
        $buffer .= $this->section0253d556d2b5f462a0d3c72c9addea75($context, $indent, $value);
        // 'showextralink' section
        $value = $context->find('showextralink');
        $buffer .= $this->section319daed58c239d9db4ad137dfe3c59cd($context, $indent, $value);
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';

        return $buffer;
    }

    private function section3d743337d1ee557b470226701b73da47(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'false';
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
                
                $buffer .= 'false';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section015a6522272385d19c46b15b1a5b54fd(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' favorited';
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
                
                $buffer .= ' favorited';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section89d9a98ff139221ef839a2c1758b3564(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' data-image-url="{{.}}"';
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
                
                $buffer .= ' data-image-url="';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '"';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section03a2cb78adf693fb240638cbbc7ea15e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'true';
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
                
                $buffer .= 'true';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionDe5940e782a9013983bff57f5a69303e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
require([\'jquery\'], function($) {
$( ".coursecard" ).hover(
  function() {
    $(this).find(\'#coursedesc\').css(\'display\',\'block\');
  }, function() {
    $(this).find(\'#coursedesc\').css(\'display\',\'none\');
  }
);
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
                
                $buffer .= $indent . 'require([\'jquery\'], function($) {
';
                $buffer .= $indent . '$( ".coursecard" ).hover(
';
                $buffer .= $indent . '  function() {
';
                $buffer .= $indent . '    $(this).find(\'#coursedesc\').css(\'display\',\'block\');
';
                $buffer .= $indent . '  }, function() {
';
                $buffer .= $indent . '    $(this).find(\'#coursedesc\').css(\'display\',\'none\');
';
                $buffer .= $indent . '  }
';
                $buffer .= $indent . ');
';
                $buffer .= $indent . '});
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section696023629135650808fafa3e96c5da4c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'coursegrade, theme_snap';
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
                
                $buffer .= 'coursegrade, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionA0eafb9b42c92470a86db81ca579eb88(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <div class="coursegrade">{{#str}}coursegrade, theme_snap{{/str}} <a href="{{feedbackurl}}">{{feedback.coursegrade.value}}</a></div>
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
                
                $buffer .= $indent . '                    <div class="coursegrade">';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section696023629135650808fafa3e96c5da4c($context, $indent, $value);
                $buffer .= ' <a href="';
                $value = $this->resolveValue($context->find('feedbackurl'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">';
                $value = $this->resolveValue($context->findDot('feedback.coursegrade.value'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</a></div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section86d11d803a2b1259649be475ba084a16(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'progresstotal, completion, {"complete":{{completion.complete}},"total":{{completion.total}} }';
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
                
                $buffer .= 'progresstotal, completion, {"complete":';
                $value = $this->resolveValue($context->findDot('completion.complete'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ',"total":';
                $value = $this->resolveValue($context->findDot('completion.total'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= ' }';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section00b22e18d2cbc909eaa68a29f1e15816(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <div class="completionstatus outoftotal">{{#str}}progresstotal, completion, {"complete":{{completion.complete}},"total":{{completion.total}} }{{/str}}<span class="pull-right">{{completion.progress}}%</span></div>
            <div class="completion-line" style="width:{{completion.progress}}%"></div>
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
                
                $buffer .= $indent . '            <div class="completionstatus outoftotal">';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section86d11d803a2b1259649be475ba084a16($context, $indent, $value);
                $buffer .= '<span class="pull-right">';
                $value = $this->resolveValue($context->findDot('completion.progress'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '%</span></div>
';
                $buffer .= $indent . '            <div class="completion-line" style="width:';
                $value = $this->resolveValue($context->findDot('completion.progress'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '%"></div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section759a0269035456c18566dea7c956e088(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' notpublished, theme_snap ';
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
                
                $buffer .= ' notpublished, theme_snap ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5ca723261027deddee9952896e35581a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'coursecontacts, theme_snap';
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
                
                $buffer .= 'coursecontacts, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0253d556d2b5f462a0d3c72c9addea75(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                {{{.}}}
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
                
                $buffer .= $indent . '                ';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= $value;
                $buffer .= '
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD064472cb93547a2887e45300b9accd7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'more, theme_snap';
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
                
                $buffer .= 'more, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionE349517325fed03b112ff4f6c17b94b5(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                            {{{.}}}
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
                
                $buffer .= $indent . '                            ';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= $value;
                $buffer .= '
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section319daed58c239d9db4ad137dfe3c59cd(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                <a data-toggle="collapse" class="coursecard-contacts-more" aria-expanded="false" href="#coursecard-contacts-{{courseid}}"  aria-controls="coursecard-contacts-{{courseid}}" href="#">{{hiddenavatarcount}}<span class="sr-only"> {{#str}}more, theme_snap{{/str}}</span></a>
                    <div class="collapse" id="coursecard-contacts-{{courseid}}">
                        {{#hiddenavatars}}
                            {{{.}}}
                        {{/hiddenavatars}}
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
                
                $buffer .= $indent . '                <a data-toggle="collapse" class="coursecard-contacts-more" aria-expanded="false" href="#coursecard-contacts-';
                $value = $this->resolveValue($context->find('courseid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '"  aria-controls="coursecard-contacts-';
                $value = $this->resolveValue($context->find('courseid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" href="#">';
                $value = $this->resolveValue($context->find('hiddenavatarcount'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '<span class="sr-only"> ';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->sectionD064472cb93547a2887e45300b9accd7($context, $indent, $value);
                $buffer .= '</span></a>
';
                $buffer .= $indent . '                    <div class="collapse" id="coursecard-contacts-';
                $value = $this->resolveValue($context->find('courseid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                // 'hiddenavatars' section
                $value = $context->find('hiddenavatars');
                $buffer .= $this->sectionE349517325fed03b112ff4f6c17b94b5($context, $indent, $value);
                $buffer .= $indent . '                    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
