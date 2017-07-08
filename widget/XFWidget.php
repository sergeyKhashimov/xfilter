<?php

namespace sergey_h\xfilter\widget;

use sergey_h\xfilter\configurator\XFilterDomain;
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
    protected $config;

    public function init()
    {
        parent::init();
        if ($this->model === null){
            return;
        }
        $this->config = $this->model->configure();
    }


    public function run()
    {
        return $this->render('xf_view',['config' => $this->config]);
    }
}