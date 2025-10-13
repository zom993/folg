<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Редактировать книгу';
?>
<div class="book-update">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Редактировать книгу</h1>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'title')->textInput([
                        'placeholder' => 'Название книги'
                    ]) ?>

                    <?= $form->field($model, 'author')->textInput([
                        'placeholder' => 'Автор книги'
                    ]) ?>

                    <?= $form->field($model, 'description')->textarea([
                        'rows' => 4,
                        'placeholder' => 'Описание книги'
                    ]) ?>

                    <?= $form->field($model, 'status')->dropDownList([
                        'available' => 'Доступна для обмена',
                        'exchanged' => 'Уже обменяна'
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить изменения', [
                            'class' => 'btn btn-success'
                        ]) ?>
                        <?= Html::a('Отмена', ['my-books'], [
                            'class' => 'btn btn-default'
                        ]) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>