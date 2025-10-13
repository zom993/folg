<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Добавить книгу для обмена';
?>
<div class="book-create text-center">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title"><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($model, 'title')->textInput([
                        'placeholder' => 'Например: Война и мир',
                        'autofocus' => true
                    ]) ?>

                    <?= $form->field($model, 'author')->textInput([
                        'placeholder' => 'Например: Лев Толстой'
                    ]) ?>

                    <?= $form->field($model, 'description')->textarea([
                        'rows' => 4,
                        'placeholder' => 'Опишите состояние книги, год издания, особенности...'
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Добавить книгу', [
                            'class' => 'btn btn-gray btn-lg btn-block'
                        ]) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <div class="text-center">
                        <?= Html::a('Вернуться к моим книгам', ['my-books'], [
                            'class' => 'btn btn-gray-link btn-block'
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .book-create {
        text-align: center;
    }
    .panel-body {
        text-align: center;
    }
    .btn-gray {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }
    .btn-gray:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: white;
    }
    .btn-gray-link {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 4px;
    }
    .btn-gray-link:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: white;
        text-decoration: none;
    }
</style>