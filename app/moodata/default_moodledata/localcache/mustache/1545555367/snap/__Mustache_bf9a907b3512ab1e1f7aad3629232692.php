<?php

class __Mustache_bf9a907b3512ab1e1f7aad3629232692 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        // 'formatsupportstoc' section
        $value = $context->find('formatsupportstoc');
        $buffer .= $this->section564c3265a824f97102248787d060fad4($context, $indent, $value);

        return $buffer;
    }

    private function section524c4b822c23d889ad317ab0b43fd811(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'contents, theme_snap';
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
                
                $buffer .= 'contents, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD1fa73036f0543a3b79d5f3bce2eb2dd(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        {{> theme_snap/course_toc_chapters }}
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
                
                if ($partial = $this->mustache->loadPartial('theme_snap/course_toc_chapters')) {
                    $buffer .= $partial->renderInternal($context, $indent . '        ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionA4fc94735f65a144c9398d6a998d88aa(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        {{> theme_snap/course_toc_footer }}
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
                
                if ($partial = $this->mustache->loadPartial('theme_snap/course_toc_footer')) {
                    $buffer .= $partial->renderInternal($context, $indent . '        ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section564c3265a824f97102248787d060fad4(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
<nav id="course-toc" class="js-only">
    <div>
        <h2 id="toc-desktop-menu-heading">
             {{#str}}contents, theme_snap{{/str}}
        </h2>
        {{> theme_snap/course_toc_module_search}}
        <a id="toc-mobile-menu-toggle" href="#course-toc"><small class="sr-only"><br>{{#str}}contents, theme_snap{{/str}}"</small></a>
    </div>

    {{#chapters}}
        {{> theme_snap/course_toc_chapters }}
    {{/chapters}}

    {{#footer}}
        {{> theme_snap/course_toc_footer }}
    {{/footer}}
</nav>
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
                
                $buffer .= $indent . '<nav id="course-toc" class="js-only">
';
                $buffer .= $indent . '    <div>
';
                $buffer .= $indent . '        <h2 id="toc-desktop-menu-heading">
';
                $buffer .= $indent . '             ';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section524c4b822c23d889ad317ab0b43fd811($context, $indent, $value);
                $buffer .= '
';
                $buffer .= $indent . '        </h2>
';
                if ($partial = $this->mustache->loadPartial('theme_snap/course_toc_module_search')) {
                    $buffer .= $partial->renderInternal($context, $indent . '        ');
                }
                $buffer .= $indent . '        <a id="toc-mobile-menu-toggle" href="#course-toc"><small class="sr-only"><br>';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section524c4b822c23d889ad317ab0b43fd811($context, $indent, $value);
                $buffer .= '"</small></a>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '
';
                // 'chapters' section
                $value = $context->find('chapters');
                $buffer .= $this->sectionD1fa73036f0543a3b79d5f3bce2eb2dd($context, $indent, $value);
                $buffer .= $indent . '
';
                // 'footer' section
                $value = $context->find('footer');
                $buffer .= $this->sectionA4fc94735f65a144c9398d6a998d88aa($context, $indent, $value);
                $buffer .= $indent . '</nav>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
