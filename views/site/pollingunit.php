<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Polling Unit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'lga_id')->dropDownList(
                        ArrayHelper::map($category, 'lga_id', 'lga_name')
                ) ?>
                    <?= $form->field($model, 'polling_unit_number')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'polling_unit_name')->textInput(['autofocus' => true])  ?>

                    <?= $form->field($model, 'polling_unit_description')->textInput(['autofocus' => true]) ?>
                    
                  
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

</div>
