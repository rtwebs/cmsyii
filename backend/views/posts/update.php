<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = 'Editar Post';
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
    ?>

    <?php 
    
    echo $form->field($model, 'post_content')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]);
    
    echo $form->field($model, 'post_category')->dropDownList(ArrayHelper::map(Category::find()->all(),'cid','c_name'), 
    ['prompt' => ' -- Selecciona la categoria --']);
    
    echo $form->field( $model, 'post_tags');
    
    echo $form->field($model, 'post_status')->dropDownList(['1' => 'Publicado', '0' => 'No publicado'],['prompt'=>'Seleccione el estado del post:']);
    
    echo $form->field($model, 'post_author')->hiddenInput(['value'=> $userId])->label(false);
    
    

    ?>
    

</div>
<div class="form-group">
        <div class=" col-lg-11">
            <?= Html::submitButton('Guardar cambios', ['class' => 'btn btn-success']) ?>
        </div>
</div>
    <?php ActiveForm::end() ?>