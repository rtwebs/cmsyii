<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = 'Crear Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


use yii\widgets\ActiveForm;

use dosamigos\ckeditor\CKEditor;

$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
]);

$userId = \Yii::$app->user->identity->id
?>
<div class="posts-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php
    echo $form->field( $model, 'post_title');
    
    echo $form->field($model, 'post_content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]);
    
    
    echo $form->field($model, 'post_category')->dropDownList(ArrayHelper::map(Category::find()->all(),'cid','c_name'), 
    ['prompt' => ' -- Selecciona la categoria --']);
    
    
    echo $form->field( $model, 'post_tags', ['template' => "{label} <span class=\"label label-info\">Los tags se ingresan separados por \",\". Ejm: alan, php, yii2 </span> \n\n{input}"]);
    //echo Html::tag('span', 'Los tags se ingresan separados por ",". Ejm: alan, php, yii2 ', ['class'=>'label label-info']);
    
    
    echo $form->field($model, 'post_status')->dropDownList(['1' => 'Publicado', '0' => 'No publicado'],['prompt'=>'Seleccione el estado del post:']);
    
    echo $form->field($model, 'post_author')->hiddenInput(['value'=> $userId])->label(false);

    ?>
    

</div>
<div class="form-group">
        <div class=" col-lg-11">
            <?= Html::submitButton('Crear post', ['class' => 'btn btn-success']) ?>
        </div>
</div>
    <?php ActiveForm::end() ?>