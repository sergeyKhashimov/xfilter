<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 7/8/17
 * Time: 10:06 PM
 * @var $config \app\modules\fl\xfilter\behaviors\XFilterBehavior
 * @var $action string
 */

use app\xfilter\widget\XFWidgetAsset;

$this->registerAssetBundle(XFWidgetAsset::className());

?>

<div class="xf_wrapper">
    <form id="xf_form" method="post" action="<?= $action ?>" data-parsley-validate="">
        <div class=" col-lg-8">
            <input name="_csrf-frontend" value="<?php echo Yii::$app->request->getCsrfToken() ?>" type="hidden">
            <?php foreach ($config as $item => $value): ?>
                <div class="xf_row">
                    <div class="col-sm-3 field-name">
                        <?= $value->getLabel(); ?>
                    </div>
                    <div class="col-sm-4">
                        <label>
                            <select data-field-name="<?= $value->getFieldName() ?>"
                                    name="<?= $value->getFieldName() ?>[operator]" class="operator ">
                                <?php foreach ($value->behaviors as $i): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label>

                            <input data-field-name="<?= $value->getFieldName() ?>" type="text"
                                   name="<?= $value->getFieldName() ?>[value]"
                                   class="value form-control" data-parsley-trigger="change">
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>
            <input type="submit" value="сохранить" class="btn btn-primary no-radius" style="float: left">
        </div>
    </form>
</div>

<p style="display: none" id="xf_rules"><?= $rules ?></p>
