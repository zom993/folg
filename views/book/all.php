<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Все книги для обмена';
?>
<div class="book-all">
    <div class="page-header text-center">
        <h1>Все книги для обмена</h1>
        <p class="lead">Найдите интересующие вас книги среди предложений других пользователей</p>
    </div>

    <div class="row text-center">
        <div class="col-md-12">
            <?= Html::a('Мои книги', ['my-books'], ['class' => 'btn btn-gray']) ?>
            <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-gray']) ?>
            <?= Html::a('Все пользователи', ['site/users'], ['class' => 'btn btn-gray']) ?>
        </div>
    </div>
    <hr>
    <?php if (empty($books)): ?>
        <div class="alert alert-warning text-center">
            <h4>Нет доступных книг для обмена</h4>
            <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-gray btn-lg']) ?>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($books as $book): ?>
                <div class="col-md-4">
                    <div class="panel panel-default book-card text-center">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <strong>"<?= Html::encode($book->title) ?>"</strong>
                            </h4>
                        </div>
                        <div class="panel-body">
                            <p><strong>Автор:</strong> <?= Html::encode($book->author) ?></p>

                            <p><strong>Владелец:</strong>
                                <?= Html::encode($book->user->username) ?>
                            </p>

                            <?php if ($book->description): ?>
                                <div class="book-description">
                                    <strong>Описание:</strong>
                                    <p><?= nl2br(Html::encode($book->description)) ?></p>
                                </div>
                            <?php endif; ?>

                            <p class="text-muted small">
                                <strong>Добавлена:</strong>
                                <?= date('d.m.Y', strtotime($book->created_at)) ?>
                            </p>

                            <?= Html::a('Предложить обмен',
                                ['exchange/request', 'to_user_id' => $book->user_id, 'book_title' => $book->title, 'book_author' => $book->author],
                                ['class' => 'btn btn-gray btn-block']
                            ) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
    .book-all {
        text-align: center;
    }
    .book-card {
        transition: all 0.3s ease;
        height: 100%;
        margin-bottom: 20px;
        text-align: center;
    }
    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .book-description {
        background: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        margin: 10px 0;
        text-align: left;
    }
    .book-description p {
        margin: 5px 0 0 0;
        font-size: 0.9em;
    }
    .book-actions {
        margin-top: 15px;
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
    .label-default {
        background-color: #6c757d;
    }
    .panel-default {
        border-color: #ddd;
    }
    .panel-default .panel-heading {
        background-color: #f8f9fa;
        border-color: #ddd;
    }
</style>