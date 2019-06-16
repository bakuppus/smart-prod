<?php

class __Mustache_cec896c5c11520e5ac04b6c0238c4012 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '<div id="courses-view-';
        $value = $this->resolveValue($context->find('uniqid'), $context);
        $buffer .= call_user_func($this->mustache->getEscape(), $value);
        $buffer .= '" data-region="courses-view">
';
        // 'hascourses' section
        $value = $context->find('hascourses');
        $buffer .= $this->section53ce87e6c5cab8d6c2f4397124a50866($context, $indent, $value);
        // 'hascourses' inverted section
        $value = $context->find('hascourses');
        if (empty($value)) {
            
            $buffer .= $indent . '    <div class="text-xs-center text-center m-t-3">
';
            $buffer .= $indent . '        <img class="empty-placeholder-image-lg"
';
            $buffer .= $indent . '             src="';
            $value = $this->resolveValue($context->findDot('urls.nocourses'), $context);
            $buffer .= call_user_func($this->mustache->getEscape(), $value);
            $buffer .= '"
';
            $buffer .= $indent . '             alt="';
            // 'str' section
            $value = $context->find('str');
            $buffer .= $this->section00b23060b98d8159a5e3cac91c6e9ae2($context, $indent, $value);
            $buffer .= '">
';
            $buffer .= $indent . '        <p class="text-muted m-t-1">';
            // 'str' section
            $value = $context->find('str');
            $buffer .= $this->section00b23060b98d8159a5e3cac91c6e9ae2($context, $indent, $value);
            $buffer .= '</p>
';
            $buffer .= $indent . '    </div>
';
        }
        $buffer .= $indent . '</div>
';
        // 'js' section
        $value = $context->find('js');
        $buffer .= $this->sectionDf812120ec13368f679a9f9834aa7459($context, $indent, $value);

        return $buffer;
    }

    private function section943672e65d749500a0e39a5c5732165b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' inprogress, block_myoverview ';
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
                
                $buffer .= ' inprogress, block_myoverview ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section73e2d31fbcff71568286bba0816b9728(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' future, block_myoverview ';
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
                
                $buffer .= ' future, block_myoverview ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section1e8dea46004e4fe5964bd9187fa70241(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' past, block_myoverview ';
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
                
                $buffer .= ' past, block_myoverview ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionEf850dfb58ba7c62d4b910a7ea7c1db1(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                {{< block_myoverview/courses-view-by-status }}
                    {{$id}}courses-view-in-progress{{/id}}
                    {{$status}}1{{/status}}
                    {{$pagingbarid}}pb-for-in-progress{{/pagingbarid}}
                    {{$pagingcontentid}}pc-for-in-progress{{/pagingcontentid}}
                {{/ block_myoverview/courses-view-by-status }}
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
                
        $blocksContext['id'] = array($this, 'blockE20a4d40c2f60a899ca77271b2c8e902');
        $blocksContext['status'] = array($this, 'blockE052079a625ca42b568ba24af19cc7eb');
        $blocksContext['pagingbarid'] = array($this, 'block95c1eda0d7da1f8f82c819f5b72fad1e');
        $blocksContext['pagingcontentid'] = array($this, 'block3ed4b265ed770e941024d7d46dc92e44');
                
                if ($parent = $this->mustache->loadPartial('block_myoverview/courses-view-by-status')) {
                    $context->pushBlockContext($blocksContext);
                    $buffer .= $parent->renderInternal($context, $indent);
                    $context->popBlockContext();
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionFbb484deb1c2186e4ba8d15d8bb40a75(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' nocoursesinprogress, block_myoverview ';
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
                
                $buffer .= ' nocoursesinprogress, block_myoverview ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section255b98538383267c9f8981a312f9502d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                {{< block_myoverview/courses-view-by-status }}
                    {{$id}}courses-view-future{{/id}}
                    {{$status}}2{{/status}}
                    {{$pagingbarid}}pb-for-future{{/pagingbarid}}
                    {{$pagingcontentid}}pc-for-in-progress{{/pagingcontentid}}
                {{/ block_myoverview/courses-view-by-status }}
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
                
        $blocksContext['id'] = array($this, 'blockAe77dd7b10cdfe288bafc1bdf99ae8ed');
        $blocksContext['status'] = array($this, 'blockDb26f8eee6e810a47b1b3e64803b37ba');
        $blocksContext['pagingbarid'] = array($this, 'block7a1c85d0c15aaa92cf350c1d53c58714');
        $blocksContext['pagingcontentid'] = array($this, 'block3ed4b265ed770e941024d7d46dc92e44');
                
                if ($parent = $this->mustache->loadPartial('block_myoverview/courses-view-by-status')) {
                    $context->pushBlockContext($blocksContext);
                    $buffer .= $parent->renderInternal($context, $indent);
                    $context->popBlockContext();
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section695957a69984835730aaf1323db773e4(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' nocoursesfuture, block_myoverview ';
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
                
                $buffer .= ' nocoursesfuture, block_myoverview ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionEf4d5c31f0241e238afbf5c775b228a9(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                {{< block_myoverview/courses-view-by-status }}
                    {{$id}}courses-view-past{{/id}}
                    {{$status}}0{{/status}}
                    {{$pagingbarid}}pb-for-past{{/pagingbarid}}
                    {{$pagingcontentid}}pc-for-in-progress{{/pagingcontentid}}
                {{/ block_myoverview/courses-view-by-status }}
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
                
        $blocksContext['id'] = array($this, 'block17fd8857dc43679097685c9313403dd0');
        $blocksContext['status'] = array($this, 'blockE13f09ec51e6aa10c3789885dab1c67f');
        $blocksContext['pagingbarid'] = array($this, 'blockB03c417d55222a96f5f09dbc3b94379c');
        $blocksContext['pagingcontentid'] = array($this, 'block3ed4b265ed770e941024d7d46dc92e44');
                
                if ($parent = $this->mustache->loadPartial('block_myoverview/courses-view-by-status')) {
                    $context->pushBlockContext($blocksContext);
                    $buffer .= $parent->renderInternal($context, $indent);
                    $context->popBlockContext();
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionEa44ef0f0312122da1bb3a4f0657de1f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' nocoursespast, block_myoverview ';
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
                
                $buffer .= ' nocoursespast, block_myoverview ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section53ce87e6c5cab8d6c2f4397124a50866(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
    <div class="row text-center">
        <div class="btn-group m-b-1" role="group" data-toggle="btns">
            <a class="btn btn-default active" href="#myoverview_courses_view_in_progress" data-toggle="tab">
                {{#str}} inprogress, block_myoverview {{/str}}
            </a>
            <a class="btn btn-default" href="#myoverview_courses_view_future" data-toggle="tab">
                {{#str}} future, block_myoverview {{/str}}
            </a>
            <a class="btn btn-default" href="#myoverview_courses_view_past" data-toggle="tab">
                {{#str}} past, block_myoverview {{/str}}
            </a>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane active fade in" id="myoverview_courses_view_in_progress">
            {{#inprogress}}
                {{< block_myoverview/courses-view-by-status }}
                    {{$id}}courses-view-in-progress{{/id}}
                    {{$status}}1{{/status}}
                    {{$pagingbarid}}pb-for-in-progress{{/pagingbarid}}
                    {{$pagingcontentid}}pc-for-in-progress{{/pagingcontentid}}
                {{/ block_myoverview/courses-view-by-status }}
            {{/inprogress}}
            {{^inprogress}}
                <div class="text-xs-center text-center m-t-3">
                    <img class="empty-placeholder-image-lg"
                         src="{{urls.nocourses}}"
                         alt="{{#str}} nocoursesinprogress, block_myoverview {{/str}}"
                         role="presentation">
                    <p class="text-muted m-t-1">{{#str}} nocoursesinprogress, block_myoverview {{/str}}</p>
                </div>
            {{/inprogress}}
        </div>
        <div class="tab-pane fade" id="myoverview_courses_view_future">
            {{#future}}
                {{< block_myoverview/courses-view-by-status }}
                    {{$id}}courses-view-future{{/id}}
                    {{$status}}2{{/status}}
                    {{$pagingbarid}}pb-for-future{{/pagingbarid}}
                    {{$pagingcontentid}}pc-for-in-progress{{/pagingcontentid}}
                {{/ block_myoverview/courses-view-by-status }}
            {{/future}}
            {{^future}}
                <div class="text-xs-center text-center m-t-3">
                    <img class="empty-placeholder-image-lg"
                         src="{{urls.nocourses}}"
                         alt="{{#str}} nocoursesfuture, block_myoverview {{/str}}"
                         role="presentation">
                    <p class="text-muted m-t-1">{{#str}} nocoursesfuture, block_myoverview {{/str}}</p>
                </div>
            {{/future}}
        </div>
        <div class="tab-pane fade" id="myoverview_courses_view_past">
            {{#past}}
                {{< block_myoverview/courses-view-by-status }}
                    {{$id}}courses-view-past{{/id}}
                    {{$status}}0{{/status}}
                    {{$pagingbarid}}pb-for-past{{/pagingbarid}}
                    {{$pagingcontentid}}pc-for-in-progress{{/pagingcontentid}}
                {{/ block_myoverview/courses-view-by-status }}
            {{/past}}
            {{^past}}
                <div class="text-xs-center text-center m-t-3">
                    <img class="empty-placeholder-image-lg"
                         src="{{urls.nocourses}}"
                         alt="{{#str}} nocoursespast, block_myoverview {{/str}}"
                         role="presentation">
                    <p class="text-muted m-t-1">{{#str}} nocoursespast, block_myoverview {{/str}}</p>
                </div>
            {{/past}}
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
                
                $buffer .= $indent . '    <div class="row text-center">
';
                $buffer .= $indent . '        <div class="btn-group m-b-1" role="group" data-toggle="btns">
';
                $buffer .= $indent . '            <a class="btn btn-default active" href="#myoverview_courses_view_in_progress" data-toggle="tab">
';
                $buffer .= $indent . '                ';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section943672e65d749500a0e39a5c5732165b($context, $indent, $value);
                $buffer .= '
';
                $buffer .= $indent . '            </a>
';
                $buffer .= $indent . '            <a class="btn btn-default" href="#myoverview_courses_view_future" data-toggle="tab">
';
                $buffer .= $indent . '                ';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section73e2d31fbcff71568286bba0816b9728($context, $indent, $value);
                $buffer .= '
';
                $buffer .= $indent . '            </a>
';
                $buffer .= $indent . '            <a class="btn btn-default" href="#myoverview_courses_view_past" data-toggle="tab">
';
                $buffer .= $indent . '                ';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->section1e8dea46004e4fe5964bd9187fa70241($context, $indent, $value);
                $buffer .= '
';
                $buffer .= $indent . '            </a>
';
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '    </div>
';
                $buffer .= $indent . '    <div class="tab-content">
';
                $buffer .= $indent . '        <div class="tab-pane active fade in" id="myoverview_courses_view_in_progress">
';
                // 'inprogress' section
                $value = $context->find('inprogress');
                $buffer .= $this->sectionEf850dfb58ba7c62d4b910a7ea7c1db1($context, $indent, $value);
                // 'inprogress' inverted section
                $value = $context->find('inprogress');
                if (empty($value)) {
                    
                    $buffer .= '                <div class="text-xs-center text-center m-t-3">
';
                    $buffer .= $indent . '                    <img class="empty-placeholder-image-lg"
';
                    $buffer .= $indent . '                         src="';
                    $value = $this->resolveValue($context->findDot('urls.nocourses'), $context);
                    $buffer .= call_user_func($this->mustache->getEscape(), $value);
                    $buffer .= '"
';
                    $buffer .= $indent . '                         alt="';
                    // 'str' section
                    $value = $context->find('str');
                    $buffer .= $this->sectionFbb484deb1c2186e4ba8d15d8bb40a75($context, $indent, $value);
                    $buffer .= '"
';
                    $buffer .= $indent . '                         role="presentation">
';
                    $buffer .= $indent . '                    <p class="text-muted m-t-1">';
                    // 'str' section
                    $value = $context->find('str');
                    $buffer .= $this->sectionFbb484deb1c2186e4ba8d15d8bb40a75($context, $indent, $value);
                    $buffer .= '</p>
';
                    $buffer .= $indent . '                </div>
';
                }
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '        <div class="tab-pane fade" id="myoverview_courses_view_future">
';
                // 'future' section
                $value = $context->find('future');
                $buffer .= $this->section255b98538383267c9f8981a312f9502d($context, $indent, $value);
                // 'future' inverted section
                $value = $context->find('future');
                if (empty($value)) {
                    
                    $buffer .= '                <div class="text-xs-center text-center m-t-3">
';
                    $buffer .= $indent . '                    <img class="empty-placeholder-image-lg"
';
                    $buffer .= $indent . '                         src="';
                    $value = $this->resolveValue($context->findDot('urls.nocourses'), $context);
                    $buffer .= call_user_func($this->mustache->getEscape(), $value);
                    $buffer .= '"
';
                    $buffer .= $indent . '                         alt="';
                    // 'str' section
                    $value = $context->find('str');
                    $buffer .= $this->section695957a69984835730aaf1323db773e4($context, $indent, $value);
                    $buffer .= '"
';
                    $buffer .= $indent . '                         role="presentation">
';
                    $buffer .= $indent . '                    <p class="text-muted m-t-1">';
                    // 'str' section
                    $value = $context->find('str');
                    $buffer .= $this->section695957a69984835730aaf1323db773e4($context, $indent, $value);
                    $buffer .= '</p>
';
                    $buffer .= $indent . '                </div>
';
                }
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '        <div class="tab-pane fade" id="myoverview_courses_view_past">
';
                // 'past' section
                $value = $context->find('past');
                $buffer .= $this->sectionEf4d5c31f0241e238afbf5c775b228a9($context, $indent, $value);
                // 'past' inverted section
                $value = $context->find('past');
                if (empty($value)) {
                    
                    $buffer .= '                <div class="text-xs-center text-center m-t-3">
';
                    $buffer .= $indent . '                    <img class="empty-placeholder-image-lg"
';
                    $buffer .= $indent . '                         src="';
                    $value = $this->resolveValue($context->findDot('urls.nocourses'), $context);
                    $buffer .= call_user_func($this->mustache->getEscape(), $value);
                    $buffer .= '"
';
                    $buffer .= $indent . '                         alt="';
                    // 'str' section
                    $value = $context->find('str');
                    $buffer .= $this->sectionEa44ef0f0312122da1bb3a4f0657de1f($context, $indent, $value);
                    $buffer .= '"
';
                    $buffer .= $indent . '                         role="presentation">
';
                    $buffer .= $indent . '                    <p class="text-muted m-t-1">';
                    // 'str' section
                    $value = $context->find('str');
                    $buffer .= $this->sectionEa44ef0f0312122da1bb3a4f0657de1f($context, $indent, $value);
                    $buffer .= '</p>
';
                    $buffer .= $indent . '                </div>
';
                }
                $buffer .= $indent . '        </div>
';
                $buffer .= $indent . '    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section00b23060b98d8159a5e3cac91c6e9ae2(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = ' nocourses, block_myoverview ';
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
                
                $buffer .= ' nocourses, block_myoverview ';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionDf812120ec13368f679a9f9834aa7459(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
require([\'jquery\', \'core/custom_interaction_events\'], function($, customEvents) {
    var root = $(\'#courses-view-{{uniqid}}\');
    customEvents.define(root, [customEvents.events.activate]);
    root.on(customEvents.events.activate, \'[data-toggle="btns"] > .btn\', function(e) {
        root.find(\'.btn.active\').removeClass(\'active\');
        $(e.target).closest(\'.btn\').addClass(\'active\');
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
                $buffer .= $indent . '    var root = $(\'#courses-view-';
                $value = $this->resolveValue($context->find('uniqid'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '\');
';
                $buffer .= $indent . '    customEvents.define(root, [customEvents.events.activate]);
';
                $buffer .= $indent . '    root.on(customEvents.events.activate, \'[data-toggle="btns"] > .btn\', function(e) {
';
                $buffer .= $indent . '        root.find(\'.btn.active\').removeClass(\'active\');
';
                $buffer .= $indent . '        $(e.target).closest(\'.btn\').addClass(\'active\');
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

    public function blockE20a4d40c2f60a899ca77271b2c8e902($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= 'courses-view-in-progress';
    
        return $buffer;
    }

    public function blockE052079a625ca42b568ba24af19cc7eb($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= '1';
    
        return $buffer;
    }

    public function block95c1eda0d7da1f8f82c819f5b72fad1e($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= 'pb-for-in-progress';
    
        return $buffer;
    }

    public function block3ed4b265ed770e941024d7d46dc92e44($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= 'pc-for-in-progress';
    
        return $buffer;
    }

    public function blockAe77dd7b10cdfe288bafc1bdf99ae8ed($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= 'courses-view-future';
    
        return $buffer;
    }

    public function blockDb26f8eee6e810a47b1b3e64803b37ba($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= '2';
    
        return $buffer;
    }

    public function block7a1c85d0c15aaa92cf350c1d53c58714($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= 'pb-for-future';
    
        return $buffer;
    }

    public function block17fd8857dc43679097685c9313403dd0($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= 'courses-view-past';
    
        return $buffer;
    }

    public function blockE13f09ec51e6aa10c3789885dab1c67f($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= '0';
    
        return $buffer;
    }

    public function blockB03c417d55222a96f5f09dbc3b94379c($context)
    {
        $indent = $buffer = '';
        $blocksContext = array();
        $buffer .= 'pb-for-past';
    
        return $buffer;
    }
}
