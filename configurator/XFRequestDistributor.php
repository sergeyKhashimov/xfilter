<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 9:21
 */

namespace sergey_h\xfilter\configurator;


use sergey_h\xfilter\behaviors\input\XFInpInstance;
use sergey_h\xfilter\behaviors\XFilterBehavior;
use sergey_h\xfilter\exception\InputException;
use sergey_h\xfilter\XFLoader;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;


/**
 * Class XFRequetDistributor
 * @package app\modules\fl\xfilter\configurator
 */
class XFRequestDistributor
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
     * @param $data
     *
     * @return XFInpInstance[]
     * @throws HttpException
     * @internal param $request
     */
    public function getValidate($data)
    {
        /** @var XFilterBehavior[] $xf_config */
        $xf_config = $this->xf_model->configure();
        $registered_fields = ArrayHelper::getColumn(
            $xf_config, function ($item) {
            /** @var XFilterBehavior $item */
            return $item->getFieldName();
        }
        );

        $builder = new XFFormBuilder($data);
        $inputs = $builder->getParamsArray();
        $this->findErrors($inputs, $registered_fields);
        $this->loader->setXfConfig($xf_config);
        return $inputs;
    }

    /**
     *
     */
    public function setXFConfig()
    {

    }

    /**
     * @param $inputs
     * @param $registered_fields
     *
     * @throws HttpException
     * @throws InputException
     */
    public function findErrors($inputs, $registered_fields)
    {
        foreach ($inputs as $input) {
            /** @var XFInpInstance $input */
            if (!in_array($input->getName(), $registered_fields)) {
                throw new HttpException(400, "Undefined field " . $input->getName());
            }
            if (!array_key_exists($input->getOperator(), XFQueryBuilder::$comparators)){
                throw new HttpException(400, "Undefined operator " . $input->getOperator());
            }
            if (!preg_match(XFQueryBuilder::$rules[$input->getOperator()],$input->getValue())){
                throw new InputException(400, "Field " . $input->getName() . 'can not be ' . $input->getValue());
            }
        }
    }

    /**
     * @return XFLoader
     */
    public function getLoader()
    {
        return $this->loader;
    }
}