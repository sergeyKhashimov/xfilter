<?php
/**
 * Created by PhpStorm.
 * User: serega
 * Date: 07.07.17
 * Time: 9:18
 */

namespace sergey_h\xfilter;


use sergey_h\xfilter\behaviors\input\XFInpInstance;
use sergey_h\xfilter\behaviors\XFilterBehavior;
use sergey_h\xfilter\configurator\XFilterDomain;
use sergey_h\xfilter\configurator\XFQueryBuilder;
use sergey_h\xfilter\configurator\XFRequestDistributor;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\HttpException;

class XFLoader
{

    /**
     * @var
     */
    protected $xfConfig;
    /**
     * @var XFilterDomain
     */
    protected $model;
    /**
     * @var XFRequestDistributor
     */
    protected $request_dist;


    /**
     * @var array
     */
    private $select;
    /**
     * @var bool
     */
    private $count;


    /**
     * XFLoader constructor.
     *
     * @param XFilterDomain $model
     * @param array $select
     * @param bool $count
     */
    public function __construct(XFilterDomain $model, $select = [], $count = false)
    {
        $this->model = $model;
        $this->validateModel();
        $this->request_dist = new XFRequestDistributor($this);
        $this->select = $select;
        $this->count = $count;
    }

    /**
     * @param $request
     *
     * @return array|int|string|ActiveRecord[]
     */
    public function filter($request)
    {
        $inputs = $this->request_dist->getValidate($request);
        $config = $this->xfConfig;
        $query = $this->prepareQuery($this->addConfig($inputs, $config));
        return $this->execute($query);
    }

    /**
     * @param $data
     *
     * @return ActiveQuery
     */
    public function prepareQuery($data)
    {
        /** @var ActiveRecord $activeRecord */
        $activeRecord = $this->model->className();
        /** @var ActiveQuery $query */
        $query = $activeRecord::find()->alias($activeRecord::tableName());
        $distinct = $this->select || $this->count ? $this->model->distinctField() : '';
        $query->distinct($distinct);
        $query = XFQueryBuilder::build(XFQueryBuilder::joinTables($query, $this->xfConfig), $data);
        $query->addSelect($this->select);
        return $query;
    }

    /**
     * @param ActiveQuery $query
     *
     * @return array|int|string|ActiveRecord[]
     */
    public function execute(ActiveQuery $query)
    {
        if ($this->count) {
            return $query->count();
        }
        if (count($this->select) == 1) {
            $needle = explode('as ', $this->select[0])[1];
            return ArrayHelper::getColumn(
                $query->asArray()->all(), function ($e) use ($needle) {
                return $e[ $needle ];
            }
            );
        }
        return $query->asArray()->all();
    }

    /**
     * @param $inputs
     * @param $config
     *
     * @return mixed
     */
    public function addConfig($inputs, $config)
    {
        /** @var XFInpInstance[] $inputs */
        foreach ($inputs as $input) {
            /** @var XFilterBehavior[] $config */
            foreach ($config as $item) {
                if ($input->getName() == $item->getFieldName()) {
                    $input->setConfig($item);
                    continue;
                }
                continue;
            }
        }
        return $inputs;
    }

    /**
     * @throws HttpException
     */
    public function validateModel()
    {
        if (!method_exists($this->model, 'find')) {
            $message = $this->model->className() .
                ' must contain find() method. Please create ' .
                $this->model->className() . 'Query model and define relations';
            throw new HttpException(400, "$message");
        }
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

    /**
     * @param mixed $xfConfig
     */
    public function setXfConfig(array $xfConfig)
    {
        $this->xfConfig = $xfConfig;
    }

}