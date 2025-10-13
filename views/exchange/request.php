<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Запрос на обмен';
?>
<div class="exchange-request">
    <h1>Попросить книгу у <?= Html::encode($toUser->username) ?></h1>
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'book_title')->textInput(['placeholder' => 'Название книги']) ?>
    <?= $form->field($model, 'book_author')->textInput(['placeholder' => 'Автор книги']) ?>
    <?= $form->field($model, 'message')->textarea(['placeholder' => 'Что можете предложить в обмен?']) ?>
    <div class="form-group">
        <?= Html::submitButton('Отправить запрос', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>