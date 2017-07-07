<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 9:18
 */

namespace sergey_h\xfilter;


use sergey_h\xfilter\configurator\XFilterDomain;
use sergey_h\xfilter\configurator\XFRequetDistributor;

class XFLoader
{

    protected $model;
    protected $request_dist;


    public function __construct(XFilterDomain $model)
    {
        $this->model = $model;
        $this->request_dist = new XFRequetDistributor($this);
    }

    public function filter($request)
    {
           return $this->request_dist->getValidate($request);
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

}