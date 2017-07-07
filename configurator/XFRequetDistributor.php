<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 9:21
 */

namespace sergey_h\xfilter\configurator;


use sergey_h\xfilter\behaviors\XFilterBehavior;
use sergey_h\xfilter\XFLoader;
use yii\helpers\ArrayHelper;


class XFRequetDistributor
{

    /**
     * @var XFLoader
     */
    protected $loader;
    /**
     * @var XFilterDomain
     */
    protected $xf_model;

    /**
     * XFRequetDistributor constructor.
     *
     * @param XFLoader $loader
     */
    public function __construct(XFLoader $loader)
    {
        $this->loader = $loader;
        $this->xf_model = $this->loader->getModel();
    }

    /**
     * @param $request
     */
    public function getValidate($request)
    {
        /** @var XFilterBehavior[] $xf_config */
        $xf_config = $this->xf_model->configure();
        $registered_fields = ArrayHelper::getColumn($xf_config, function($item){
            return $item->fieldName;
        });
        return $registered_fields;

    }

    /**
     * @return XFLoader
     */
    public function getLoader()
    {
        return $this->loader;
    }
}