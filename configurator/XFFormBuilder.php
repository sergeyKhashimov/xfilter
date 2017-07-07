<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 11:33
 */

namespace sergey_h\xfilter\configurator;


use sergey_h\xfilter\behaviors\input\XFInpInstance;
use yii\helpers\ArrayHelper;

class XFFormBuilder
{
    /**
     * @var
     */
    protected $params;
    /**
     * @var
     */
    protected $inpNames;
    /**
     * @var array
     */
    protected $paramsArray = [];


    /**
     * XFFormBuilder constructor.
     *
     * @param $params
     */
    public function __construct($params)
    {
        $this->params = $params;
        if(!empty($params)){
            $this->defineInpNames();
            $this->crateArrayOfValidFields();
        }
    }

    /**
     *
     */
    protected function defineInpNames(){
        $this->inpNames = ArrayHelper::getColumn($this->params, function($i, $v){
            return $v;
        });
    }

    /**
     *
     */
    public function crateArrayOfValidFields()
    {
        foreach ($this->params as $name => $val){
            if(!isset($val['operator']) || !isset($val['value'])){
                unset($this->params[$name]);
                continue;
            }
            $options = [
              'name'  => XFFormHelper::trimName($name),
                'operator' => $val['operator'],
                'value' => $val['value'],
            ];
            $this->paramsArray[] = new XFInpInstance($options);
        }
    }

    /**
     * @return mixed
     */
    public function getInpNames()
    {
        return $this->inpNames;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function getParamsArray()
    {
        return $this->paramsArray;
    }

}