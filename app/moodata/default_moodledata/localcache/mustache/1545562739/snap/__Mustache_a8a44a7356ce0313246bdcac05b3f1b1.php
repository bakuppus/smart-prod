<?php

class __Mustache_a8a44a7356ce0313246bdcac05b3f1b1 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';
        $blocksContext = array();

        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- Modal -->
';
        $buffer .= $indent . '<div data-section="0" class="modal fade" id="snap-modchooser-modal" tabindex="-1" role="dialog" aria-labelledby="snap-modchooser-title" aria-hidden="true">
';
        $buffer .= $indent . '    <div class="modal-dialog modal-lg" role="document">
';
        $buffer .= $indent . '        <div class="modal-content">
';
        $buffer .= $indent . '            <div class="modal-header">
';
        $buffer .= $indent . '                <button type="button" class="close" data-dismiss="modal" aria-label="';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->section7a20f6a0c1e5f01649c33230170638b5($context, $indent, $value);
        $buffer .= '">
';
        $buffer .= $indent . '                    <span aria-hidden="true">&times;</span>
';
        $buffer .= $indent . '                </button>
';
        $buffer .= $indent . '                <h6 class="modal-title" id="snap-modchooser-title">';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->sectionDed9b286fd7871ed8863bb0ea8f45c02($context, $indent, $value);
        $buffer .= '</h6>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <!-- Nav tabs -->
';
        $buffer .= $indent . '            <ul class="nav nav-tabs" role="tablist">
';
        $buffer .= $indent . '                <li class="nav-item">
';
        $buffer .= $indent . '                    <a class="nav-link active" data-toggle="tab" href="#activites" role="tab">Components</a>
';
        $buffer .= $indent . '                </li>
';
        $buffer .= $indent . '           
';
        $buffer .= $indent . '                <li class="nav-item pull-right" id="snap-modchooser-help-tab">
';
        $buffer .= $indent . '                    <a class="nav-link iconhelp" data-toggle="tab" href="#help" role="tab">';
        // 'str' section
        $value = $context->find('str');
        $buffer .= $this->sectionDf7498e076f73038f95f4383341a05f7($context, $indent, $value);
        $buffer .= ' ';
        // 'pix' section
        $value = $context->find('pix');
        $buffer .= $this->section70d0b77085e3a582721f6e82dc936607($context, $indent, $value);
        $buffer .= '</a>
';
        $buffer .= $indent . '                </li>
';
        $buffer .= $indent . '            </ul>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            <!-- Tab panes -->
';
        $buffer .= $indent . '            <div class="tab-content snap-modchooser-tabs">
';
        $buffer .= $indent . '            <br>
';
        // 'tabs' section
        $value = $context->find('tabs');
        $buffer .= $this->section25a2924751300d5a1b3ab39d84314195($context, $indent, $value);
        $buffer .= $indent . '            <br>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
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

    private function sectionDed9b286fd7871ed8863bb0ea8f45c02(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'addresourceoractivity, theme_snap';
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
                
                $buffer .= 'addresourceoractivity, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionDf7498e076f73038f95f4383341a05f7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'helpguide, theme_snap';
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
                
                $buffer .= 'helpguide, theme_snap';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section70d0b77085e3a582721f6e82dc936607(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'help, theme_snap, {{#str}}helpguide, theme_snap{{/str}}';
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
                
                $buffer .= 'help, theme_snap, ';
                // 'str' section
                $value = $context->find('str');
                $buffer .= $this->sectionDf7498e076f73038f95f4383341a05f7($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section1387fe06f1ec5bec1239885d1043145b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div class="col-xs-3 snap-modchooser-activity">
                            <a class="snap-modchooser-addlink" href="{{{link}}}"><img src="{{icon}}" class="svg-icon" alt="" role="presentation"><br>{{title}}</a>
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
                
                $buffer .= $indent . '                        <div class="col-xs-3 snap-modchooser-activity">
';
                $buffer .= $indent . '                            <a class="snap-modchooser-addlink" href="';
                $value = $this->resolveValue($context->find('link'), $context);
                $buffer .= $value;
                $buffer .= '"><img src="';
                $value = $this->resolveValue($context->find('icon'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" class="svg-icon" alt="" role="presentation"><br>';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</a>
';
                $buffer .= $indent . '                        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section8d9097be976d3baa6fc29e1b42dac1ba(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div class="col-xs-3 snap-modchooser-resource">
                            <a class="snap-modchooser-addlink" href="{{{link}}}"><img src="{{icon}}" class="svg-icon" alt="" role="presentation"><br>{{title}}</a>
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
                
                $buffer .= $indent . '                        <div class="col-xs-3 snap-modchooser-resource">
';
                $buffer .= $indent . '                            <a class="snap-modchooser-addlink" href="';
                $value = $this->resolveValue($context->find('link'), $context);
                $buffer .= $value;
                $buffer .= '"><img src="';
                $value = $this->resolveValue($context->find('icon'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" class="svg-icon" alt="" role="presentation"><br>';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</a>
';
                $buffer .= $indent . '                        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section553feecd27dcbbec4bef0b1fd540fcb0(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div class="col-xs-3 snap-modchooser-activity" id="snap-modchooser_{{name}}">
                            <a class="snap-modchooser-addlink" href="{{{link}}}"><img src="{{icon}}" class="svg-icon" alt="" role="presentation"><br>{{title}}</a>
                        </div>
                        <div class="col-xs-8 snap-modchooser-help">
                            {{{help}}}
                        </div>
                        <div class="col-xs-12"><hr></div>
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
                
                $buffer .= $indent . '                        <div class="col-xs-3 snap-modchooser-activity" id="snap-modchooser_';
                $value = $this->resolveValue($context->find('name'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                $buffer .= $indent . '                            <a class="snap-modchooser-addlink" href="';
                $value = $this->resolveValue($context->find('link'), $context);
                $buffer .= $value;
                $buffer .= '"><img src="';
                $value = $this->resolveValue($context->find('icon'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" class="svg-icon" alt="" role="presentation"><br>';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</a>
';
                $buffer .= $indent . '                        </div>
';
                $buffer .= $indent . '                        <div class="col-xs-8 snap-modchooser-help">
';
                $buffer .= $indent . '                            ';
                $value = $this->resolveValue($context->find('help'), $context);
                $buffer .= $value;
                $buffer .= '
';
                $buffer .= $indent . '                        </div>
';
                $buffer .= $indent . '                        <div class="col-xs-12"><hr></div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC7f9390afe1d54054bcffb9e9eff5d10(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div class="col-xs-3 snap-modchooser-resource" id="snap-modchooser_{{name}}">
                            <a class="snap-modchooser-addlink" href="{{{link}}}"><img src="{{icon}}" class="svg-icon" alt="" role="presentation"><br>{{title}}</a>
                        </div>
                        <div class="col-xs-8 snap-modchooser-help">
                            {{{help}}}
                        </div>
                        <div class="col-xs-12"><hr></div>
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
                
                $buffer .= $indent . '                        <div class="col-xs-3 snap-modchooser-resource" id="snap-modchooser_';
                $value = $this->resolveValue($context->find('name'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '">
';
                $buffer .= $indent . '                            <a class="snap-modchooser-addlink" href="';
                $value = $this->resolveValue($context->find('link'), $context);
                $buffer .= $value;
                $buffer .= '"><img src="';
                $value = $this->resolveValue($context->find('icon'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '" class="svg-icon" alt="" role="presentation"><br>';
                $value = $this->resolveValue($context->find('title'), $context);
                $buffer .= call_user_func($this->mustache->getEscape(), $value);
                $buffer .= '</a>
';
                $buffer .= $indent . '                        </div>
';
                $buffer .= $indent . '                        <div class="col-xs-8 snap-modchooser-help">
';
                $buffer .= $indent . '                            ';
                $value = $this->resolveValue($context->find('help'), $context);
                $buffer .= $value;
                $buffer .= '
';
                $buffer .= $indent . '                        </div>
';
                $buffer .= $indent . '                        <div class="col-xs-12"><hr></div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section25a2924751300d5a1b3ab39d84314195(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
        $blocksContext = array();
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                <div class="tab-pane row text-center active" id="activites" role="tabpanel">
                    {{#activities}}
                        <div class="col-xs-3 snap-modchooser-activity">
                            <a class="snap-modchooser-addlink" href="{{{link}}}"><img src="{{icon}}" class="svg-icon" alt="" role="presentation"><br>{{title}}</a>
                        </div>
                    {{/activities}}

                    {{#resources}}
                        <div class="col-xs-3 snap-modchooser-resource">
                            <a class="snap-modchooser-addlink" href="{{{link}}}"><img src="{{icon}}" class="svg-icon" alt="" role="presentation"><br>{{title}}</a>
                        </div>
                    {{/resources}}
                </div>
              
                <div class="tab-pane row text-center" id="help" role="tabpanel">
                    {{#activities}}
                        <div class="col-xs-3 snap-modchooser-activity" id="snap-modchooser_{{name}}">
                            <a class="snap-modchooser-addlink" href="{{{link}}}"><img src="{{icon}}" class="svg-icon" alt="" role="presentation"><br>{{title}}</a>
                        </div>
                        <div class="col-xs-8 snap-modchooser-help">
                            {{{help}}}
                        </div>
                        <div class="col-xs-12"><hr></div>
                    {{/activities}}
                    {{#resources}}
                        <div class="col-xs-3 snap-modchooser-resource" id="snap-modchooser_{{name}}">
                            <a class="snap-modchooser-addlink" href="{{{link}}}"><img src="{{icon}}" class="svg-icon" alt="" role="presentation"><br>{{title}}</a>
                        </div>
                        <div class="col-xs-8 snap-modchooser-help">
                            {{{help}}}
                        </div>
                        <div class="col-xs-12"><hr></div>
                    {{/resources}}
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
                
                $buffer .= $indent . '                <div class="tab-pane row text-center active" id="activites" role="tabpanel">
';
                // 'activities' section
                $value = $context->find('activities');
                $buffer .= $this->section1387fe06f1ec5bec1239885d1043145b($context, $indent, $value);
                $buffer .= $indent . '
';
                // 'resources' section
                $value = $context->find('resources');
                $buffer .= $this->section8d9097be976d3baa6fc29e1b42dac1ba($context, $indent, $value);
                $buffer .= $indent . '                </div>
';
                $buffer .= $indent . '              
';
                $buffer .= $indent . '                <div class="tab-pane row text-center" id="help" role="tabpanel">
';
                // 'activities' section
                $value = $context->find('activities');
                $buffer .= $this->section553feecd27dcbbec4bef0b1fd540fcb0($context, $indent, $value);
                // 'resources' section
                $value = $context->find('resources');
                $buffer .= $this->sectionC7f9390afe1d54054bcffb9e9eff5d10($context, $indent, $value);
                $buffer .= $indent . '                </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
