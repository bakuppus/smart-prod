<?php

class __Mustache_3671a92e444e20ba6952b11043d0b0b8 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '
';
        $buffer .= $indent . '<nav id="snap-pm" tabindex="-1">
';
        $buffer .= $indent . '    <div id="snap-pm-inner">
';
        $buffer .= $indent . '        <!-- Header -->
';
        $buffer .= $indent . '        <header id="snap-pm-header" class="clearfix">
';
        $buffer .= $indent . '            <div class="pull-right">
';
        $buffer .= $indent . '                <a id="snap-pm-close" class="js-snap-pm-trigger snap-action-icon snap-icon-close" href="#">
';
        $buffer .= $indent . '                        <small>';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section7a20f6a0c1e5f01649c33230170638b5($context, $indent, $value);
        $buffer .= '</small>
';
        $buffer .= $indent . '                </a>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <!-- User details -->
';
        $buffer .= $indent . '            <div class="snap-pm-user">
';
        $buffer .= $indent . '                ';
        $value = $this->resolveValue($context->find('userpicture'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '                ';
        $value = $this->resolveValue($context->find('fullnamelink'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '                ';
        $value = $this->resolveValue($context->find('realfullnamelink'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '                <div id="snap-pm-header-quicklinks">
';
        // 'quicklinks' section
        $value = $context->find('quicklinks');
        $buffer .= $this->section04c6f0f816f1edc7f35088fdd74edf17($context, $indent, $value);
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        </header>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        <!-- Content -->
';
        $buffer .= $indent . '        <div id="snap-pm-content" class="row">
';
        $buffer .= $indent . '            <!-- Courses -->
';
        $buffer .= $indent . '            <section id="snap-pm-courses" class="col-lg-9">
';
        $buffer .= $indent . '                <h2 class="sr-only">';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->sectionF870cf92426deaef3e90c68f33111c89($context, $indent, $value);
        $buffer .= '</h2>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        // 'coursenav' section
        $value = $context->find('coursenav');
        $buffer .= $this->section0d7587e0210a43f1224ae07c2dae4cf8($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        // 'coursenav' inverted section
        $value = $context->find('coursenav');
        if (empty($value)) {
            
            $buffer .= $indent . '                <!-- Current courses -->
';
            if ($partial = $this->mustache->loadPartial('theme_snap/personal_menu_current_courses')) {
                $buffer .= $partial->renderInternal($context, $indent . '                ');
            }
        }
        $buffer .= $indent . '
';
        $buffer .= $indent . '                ';
        $value = $this->resolveValue($context->find('browseallcourses'), $context);
        $buffer .= $value;
        $buffer .= '
';
        $buffer .= $indent . '            </section>
';
        $buffer .= $indent . '            <!-- Updates -->
';
        $buffer .= $indent . '            <div id="snap-pm-updates" class="col-lg-3">
';
        // 'updates' section
        $value = $context->find('updates');
        $buffer .= $this->section450002aac357e011491821400d97710b($context, $indent, $value);
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        // 'updates' section
        $value = $context->find('updates');
        $buffer .= $this->section42f6731b98eb7864bc8f2480e2b44f45($context, $indent, $value);
        $buffer .= $indent . '        <!-- // End Content -->
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</nav>
';

        return $buffer;
    }

    private function section7a20f6a0c1e5f01649c33230170638b5(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'closebuttontitle';
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
                
                $buffer .= 'closebuttontitle';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section4a375bbe02857f79686bedc29137f585(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'id="{{.}}" ';
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
                
                $buffer .= 'id="';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section04c6f0f816f1edc7f35088fdd74edf17(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <a {{#id}}id="{{.}}" {{/id}}href="{{link}}">{{title}}</a>
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
                
                $buffer .= $indent . '                    <a ';
                // 'id' section
                $value = $context->find('id');
                $buffer .= $this->section4a375bbe02857f79686bedc29137f585($context, $indent, $value);
                $buffer .= 'href="';
                $value = $this->resolveValue($context->find('link'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</a>
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

    private function section4af3a8b40e340b2a1510df84953c33dd(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                <li class="nav-item">
                                    <a class="nav-link" href="#snap-pm-courses-{{year}}" aria-controls="snap-pm-courses-{{year}}" id="snap-pm-tab-{{year}}" role="tab" data-toggle="tab">{{year}}</a>
                                </li>
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
                
                $buffer .= $indent . '                                <li class="nav-item">
';
                $buffer .= $indent . '                                    <a class="nav-link" href="#snap-pm-courses-';
                $value = $this->resolveValue($context->find('year'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" aria-controls="snap-pm-courses-';
                $value = $this->resolveValue($context->find('year'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" id="snap-pm-tab-';
                $value = $this->resolveValue($context->find('year'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" role="tab" data-toggle="tab">';
                $value = $this->resolveValue($context->find('year'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</a>
';
                $buffer .= $indent . '                                </li>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5c51173961fb0075c4f704ad88c8e0cb(Mustache_Context $context, $indent, $value)
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
                    $buffer .= $partial->renderInternal($context, $indent . '                                    ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section83255bd0dd96c3a4f921b12739bcc274(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                            <div id="snap-pm-courses-{{year}}" class="tab-pane clearfix" role="tabpanel" aria-labelledby="hsnap-pm-tab-{{year}}">
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
                
                $buffer .= $indent . '                            <div id="snap-pm-courses-';
                $value = $this->resolveValue($context->find('year'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" class="tab-pane clearfix" role="tabpanel" aria-labelledby="hsnap-pm-tab-';
                $value = $this->resolveValue($context->find('year'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                // 'courses' section
                $value = $context->find('courses');
                $buffer .= $this->section5c51173961fb0075c4f704ad88c8e0cb($context, $indent, $value);
                $buffer .= $indent . '                            </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0d7587e0210a43f1224ae07c2dae4cf8(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" id="snap-pm-courses-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-expanded="true" aria-controls="snap-pm-courses-current" href="#snap-pm-courses-current" id="snap-pm-tab-current" role="tab" data-toggle="tab">{{#str}}courses{{/str}}</a>
                            </li>
                            {{#pastcourselist}}
                                <li class="nav-item">
                                    <a class="nav-link" href="#snap-pm-courses-{{year}}" aria-controls="snap-pm-courses-{{year}}" id="snap-pm-tab-{{year}}" role="tab" data-toggle="tab">{{year}}</a>
                                </li>
                            {{/pastcourselist}}
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content" id="snap-pm-courses-content">
                        <!-- Current courses -->
                        {{> theme_snap/personal_menu_current_courses }}

                        <!-- Past courses by year -->
                        {{#pastcourselist}}
                            <div id="snap-pm-courses-{{year}}" class="tab-pane clearfix" role="tabpanel" aria-labelledby="hsnap-pm-tab-{{year}}">
                                {{#courses}}
                                    {{> theme_snap/course_cards }}
                                {{/courses}}
                            </div>
                        {{/pastcourselist}}
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
                
                $buffer .= $indent . '                    <!-- Nav tabs -->
';
                $buffer .= $indent . '                    <ul class="nav nav-tabs" role="tablist" id="snap-pm-courses-nav">
';
                $buffer .= $indent . '                            <li class="nav-item">
';
                $buffer .= $indent . '                                <a class="nav-link active" aria-expanded="true" aria-controls="snap-pm-courses-current" href="#snap-pm-courses-current" id="snap-pm-tab-current" role="tab" data-toggle="tab">';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->sectionF870cf92426deaef3e90c68f33111c89($context, $indent, $value);
                $buffer .= '</a>
';
                $buffer .= $indent . '                            </li>
';
                // 'pastcourselist' section
                $value = $context->find('pastcourselist');
                $buffer .= $this->section4af3a8b40e340b2a1510df84953c33dd($context, $indent, $value);
                $buffer .= $indent . '                    </ul>
';
                $buffer .= $indent . '
';
                $buffer .= $indent . '                    <!-- Tab panes -->
';
                $buffer .= $indent . '                    <div class="tab-content" id="snap-pm-courses-content">
';
                $buffer .= $indent . '                        <!-- Current courses -->
';
                if ($partial = $this->mustache->loadPartial('theme_snap/personal_menu_current_courses')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                        ');
                }
                $buffer .= $indent . '
';
                $buffer .= $indent . '                        <!-- Past courses by year -->
';
                // 'pastcourselist' section
                $value = $context->find('pastcourselist');
                $buffer .= $this->section83255bd0dd96c3a4f921b12739bcc274($context, $indent, $value);
                $buffer .= $indent . '                    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionDae5723dd1e9ff09f1df1c7990a4d1ae(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <section>{{{.}}}</section>
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
                
                $buffer .= $indent . '                        <section>';
                $value = $this->resolveValue($context->last(), $context);
                $buffer .= $value;
                $buffer .= '</section>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section450002aac357e011491821400d97710b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    {{#update}}
                        <section>{{{.}}}</section>
                    {{/update}}
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
                
                // 'update' section
                $value = $context->find('update');
                $buffer .= $this->sectionDae5723dd1e9ff09f1df1c7990a4d1ae($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section42f6731b98eb7864bc8f2480e2b44f45(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            {{{mobilemenu}}}
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
                
                $buffer .= $indent . '            ';
                $value = $this->resolveValue($context->find('mobilemenu'), $context);
                $buffer .= $value;
                $buffer .= '
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
