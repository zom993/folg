<?php
use yii\helpers\Html;
?>
<div class="site-index">
    <div class="jumbotron">
        <h1>BookExchange</h1>
        <p class="lead">Обменивайтесь книгами с другими читателями</p>
    </div>
    <?php if (Yii::$app->user->isGuest): ?>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Новый пользователь?</h3>
                    </div>
                    <div class="panel-body text-center">
                        <p>Присоединяйтесь к нашему сообществу книголюбов</p>
                        <?= Html::a('Зарегистрироваться', ['site/signup'], [
                            'class' => 'btn btn-success btn-lg'
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel-body text-center">
                    <p>Войдите в свой аккаунт</p>
                    <?= Html::a('Войти', ['site/login'], [
                        'class' => 'btn btn-primary btn-lg'
                    ]) ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Все книги</h3>
                    </div>
                    <div class="panel-body text-center">
                        <p>Посмотрите все доступные книги для обмена</p>
                        <?= Html::a('Все книги', ['book/all'], [
                            'class' => 'btn btn-primary btn-block'
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Пользователи</h3>
                    </div>
                    <div class="panel-body text-center">
                        <p>Найдите книги у других пользователей</p>
                        <?= Html::a('Все пользователи', ['site/users'], [
                            'class' => 'btn btn-info btn-block'
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <h3 class="panel-title">Обмены</h3>
                    </div>
                    <div class="panel-body text-center">
                        <p>Управление запросами на обмен</p>
                        <?= Html::a('Мои запросы', ['exchange/my-requests'], [
                            'class' => 'btn btn-warning btn-block'
                        ]) ?>
                        <?= Html::a('Входящие', ['exchange/incoming'], [
                            'class' => 'btn btn-danger btn-block'
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<style>
    .site-index {
        text-align: center;
    }
    .jumbotron {
        text-align: center;
    }
    .row {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }
    .panel {
        margin: 0 auto;
        float: none;
    }
    .col-md-3 {
        float: none;
        display: inline-block;
    }
    .col-md-6 {
        float: none;
        display: inline-block;
    }
    .panel-body.text-center {
        text-align: center;
    }
    .btn-primary,
    .btn-success,
    .btn-info,
    .btn-warning,
    .btn-danger {
        background-color: #6c757d !important;
        border-color: #6c757d !important;
        color: white !important;
    }
    .btn-primary:hover,
    .btn-success:hover,
    .btn-info:hover,
    .btn-warning:hover,
    .btn-danger:hover {
        background-color: #5a6268 !important;
        border-color: #545b62 !important;
    }
    .btn-sm {
        background-color: #6c757d !important;
        border-color: #6c757d !important;
        color: white !important;
    }
    .btn-sm:hover {
        background-color: #5a6268 !important;
        border-color: #545b62 !important;
    }
</style>