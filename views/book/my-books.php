<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Мои книги для обмена';
?>
<div class="book-my-books text-center">
    <div class="page-header">
        <p class="lead">Управляйте вашей коллекцией книг для обмена</p>
        <?= Html::a('Добавить книгу', ['create'], [
            'class' => 'btn btn-dark btn-lg'
        ]) ?>
    </div>

    <?php if (empty($books)): ?>
        <div class="alert alert-dark empty-state">
            <h4>У вас пока нет книг для обмена</h4>
            <p>Добавьте книги, которые вы готовы обменять с другими пользователями.</p>
            <?= Html::a('Добавить первую книгу', ['create'], [
                'class' => 'btn btn-gray'
            ]) ?>
        </div>
    <?php else: ?>
        <div class="books-stats">
            <div class="stat-card">
                <div class="stat-number"><?= count($books) ?></div>
                <div class="stat-label">Всего книг</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count(array_filter($books, function($b) { return $b->status == 'available'; })) ?></div>
                <div class="stat-label">Доступно</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count(array_filter($books, function($b) { return $b->status == 'exchanged'; })) ?></div>
                <div class="stat-label">Обменяно</div>
            </div>
        </div>

        <div class="row books-grid">
            <?php foreach ($books as $book): ?>
                <div class="col-md-4">
                    <div class="book-card status-<?= $book->status ?>">
                        <div class="book-header">
                            <div class="book-status">
                                <span class="status-badge status-<?= $book->status ?>">
                                    <?= $book->status == 'available' ? 'Доступна' : 'Обменяна' ?>
                                </span>
                            </div>
                            <h3 class="book-title">"<?= Html::encode($book->title) ?>"</h3>
                        </div>
                        <div class="book-body">
                            <div class="book-author">
                                <strong>Автор:</strong> <?= Html::encode($book->author) ?>
                            </div>

                            <?php if ($book->description): ?>
                                <div class="book-description">
                                    <strong>Описание:</strong>
                                    <p><?= nl2br(Html::encode($book->description)) ?></p>
                                </div>
                            <?php endif; ?>

                            <div class="book-meta">
                                <span class="book-date"><?= date('d.m.Y', strtotime($book->created_at)) ?></span>
                            </div>

                            <div class="book-actions">
                                <?= Html::a('Редактировать', ['update', 'id' => $book->id], [
                                    'class' => 'btn btn-gray btn-sm'
                                ]) ?>
                                <?= Html::a('Удалить', ['delete', 'id' => $book->id], [
                                    'class' => 'btn btn-dark btn-sm',
                                    'data' => [
                                        'confirm' => 'Вы уверены, что хотите удалить эту книгу?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
    .book-my-books {
        text-align: center;
        padding: 20px;
        color: #333;
    }
    .page-header {
        margin-bottom: 40px;
    }
    .page-header h1 {
        color: #333;
        margin-bottom: 20px;
    }
    .btn-dark {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #ffffff;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 500;
    }
    .btn-dark:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .btn-gray {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #ffffff;
        border-radius: 20px;
        padding: 10px 20px;
    }
    .btn-gray:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: #ffffff;
    }
    .btn-sm {
        padding: 8px 16px;
        font-size: 14px;
    }
    .alert-dark {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #333;
        border-radius: 15px;
        padding: 40px;
    }
    .empty-state .empty-icon {
        font-size: 64px;
        margin-bottom: 20px;
    }
    .books-stats {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 30px 0;
        flex-wrap: wrap;
    }
    .stat-card {
        background: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        min-width: 120px;
    }
    .stat-number {
        font-size: 32px;
        font-weight: bold;
        color: #333;
    }
    .stat-label {
        font-size: 14px;
        color: #6c757d;
        margin-top: 5px;
    }
    .books-grid {
        justify-content: center;
        margin: 0 -10px;
    }
    .book-card {
        background: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 15px;
        padding: 0;
        margin: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        height: 100%;
        text-align: left;
    }
    .book-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        border-color: #adb5bd;
    }
    .book-header {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 15px 15px 0 0;
        border-bottom: 1px solid #dee2e6;
    }
    .book-title {
        color: #333;
        margin: 10px 0 0 0;
        font-size: 18px;
        font-weight: 600;
    }
    .status-badge {
        padding: 6px 12px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
        display: inline-block;
    }
    .status-badge.status-available {
        background: #e9ecef;
        color: #495057;
    }
    .status-badge.status-exchanged {
        background: #e9ecef;
        color: #495057;
    }
    .book-body {
        padding: 20px;
    }
    .book-author {
        color: #333;
        margin-bottom: 15px;
    }
    .book-description {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin: 15px 0;
        border-left: 3px solid #dee2e6;
    }
    .book-description p {
        margin: 8px 0 0 0;
        color: #6c757d;
        font-size: 14px;
    }
    .book-meta {
        margin: 15px 0;
        padding-top: 15px;
        border-top: 1px solid #dee2e6;
    }
    .book-date {
        color: #6c757d;
        font-size: 12px;
    }
    .book-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
    }
    .book-actions .btn {
        flex: 1;
    }
    .lead {
        color: #6c757d;
        margin-bottom: 20px;
    }
</style>