<?php

namespace sergey_h\xfilter\widget;

use sergey_h\xfilter\configurator\XFilterDomain;
use sergey_h\xfilter\configurator\XFQueryBuilder;
use yii\base\Widget;


/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 7/8/17
 * Time: 9:59 PM
 */
class XFWidget extends Widget
{
    /**
     * @var XFilterDomain
     */
    public $model;
    public $action;


    private $_rules;
    private $_config;

    public function init()
    {
        parent::init();
        if ($this->model === null) {
            return;
        }
        $this->_config = $this->model->configure();
        if ($this->action === null) {
            $this->action = '#';
        }

        foreach (XFQueryBuilder::$rules as $item => $rule){
            $this->_rules[$item] = trim($rule,'/');
        }
    }


    public function run()
    {
        return $this->render(
            'xf_view', [
                         'config' => $this->_config,
                         'action' => $this->action,
                         'rules'  => json_encode($this->_rules),
                     ]
        );
    }
}