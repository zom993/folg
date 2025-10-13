<?php
use yii\helpers\Html;
$this->title = 'Мои запросы';
?>
<div class="exchange-my-requests text-center">
    <div class="page-header">
        <h1>Мои запросы на обмен</h1>
        <p class="lead">Отслеживайте статус ваших запросов на обмен книгами</p>
    </div>
    <div class="action-bar">
        <?= Html::a('Найти пользователей', ['site/users'], ['class' => 'btn btn-gray']) ?>
        <?= Html::a('Все книги', ['book/all'], ['class' => 'btn btn-gray']) ?>
    </div>
    <?php if (empty($requests)): ?>
        <div class="alert alert-info empty-state">
            <h4>У вас пока нет отправленных запросов на обмен</h4>
            <p>Найдите пользователей или книги и предложите обмен!</p>
            <div class="empty-actions">
                <?= Html::a('Найти пользователей', ['site/users'], ['class' => 'btn btn-gray']) ?>
                <?= Html::a('Посмотреть все книги', ['book/all'], ['class' => 'btn btn-gray']) ?>
            </div>
        </div>
    <?php else: ?>
        <div class="requests-stats">
            <div class="stat-card">
                <div class="stat-number"><?= count($requests) ?></div>
                <div class="stat-label">Всего запросов</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count(array_filter($requests, function($r) { return $r->status == 'pending'; })) ?></div>
                <div class="stat-label">Ожидают ответа</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count(array_filter($requests, function($r) { return $r->status == 'accepted'; })) ?></div>
                <div class="stat-label">Принято</div>
            </div>
        </div>
        <div class="requests-list">
            <?php foreach ($requests as $request): ?>
                <div class="request-card status-<?= $request->status ?>">
                    <div class="request-header">
                        <div class="user-info">
                            <div class="user-avatar">
                                <?= strtoupper(mb_substr($request->toUser->username, 0, 1)) ?>
                            </div>
                            <div class="user-details">
                                <h4>Для: <?= Html::encode($request->toUser->username) ?></h4>
                                <span class="request-date"><?= date('d.m.Y H:i', strtotime($request->created_at)) ?></span>
                            </div>
                        </div>
                        <div class="request-status">
                            <span class="status-badge status-<?= $request->status ?>">
                                <?= $request->status == 'pending' ? 'Ожидает ответа' :
                                    ($request->status == 'accepted' ? 'Принят' : 'Отклонен') ?>
                            </span>
                        </div>
                    </div>
                    <div class="request-body">
                        <div class="book-info">
                            <div class="book-details">
                                <strong>"<?= Html::encode($request->book_title) ?>"</strong>
                                <br>
                                <span class="book-author"><?= Html::encode($request->book_author) ?></span>
                            </div>
                        </div>
                        <?php if ($request->message): ?>
                            <div class="request-message">
                                <strong>Моё предложение:</strong>
                                <p><?= nl2br(Html::encode($request->message)) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
    .exchange-my-requests {
        text-align: center;
    }
    .page-header {
        margin-bottom: 40px;
    }
    .action-bar {
        margin-bottom: 30px;
    }
    .btn-gray {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        border-radius: 20px;
        padding: 10px 20px;
        margin: 0 5px;
        font-weight: 500;
    }
    .btn-gray:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .empty-state {
        border-radius: 15px;
        border: none;
        padding: 50px 30px;
        margin: 40px 0;
    }

    .empty-actions {
        margin-top: 20px;
    }
    .requests-stats {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 30px 0;
        flex-wrap: wrap;
    }
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        min-width: 120px;
    }
    .stat-number {
        font-size: 32px;
        font-weight: bold;
        color: #2c3e50;
    }
    .stat-label {
        font-size: 14px;
        color: #7f8c8d;
        margin-top: 5px;
    }
    .requests-list {
        max-width: 800px;
        margin: 0 auto;
    }
    .request-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-left: 5px solid #6c757d;
        text-align: left;
    }
    .request-card.status-pending {
        border-left-color: #6c757d;
    }
    .request-card.status-accepted {
        border-left-color: #6c757d;
    }
    .request-card.status-rejected {
        border-left-color: rgba(0, 0, 0, 0.1);
    }
    .request-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }
    .user-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .user-avatar {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #7f8c8d 0%, #6c757d 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        font-weight: bold;
    }
    .user-details h4 {
        margin: 0;
        color: #2c3e50;
    }
    .request-date {
        color: #7f8c8d;
        font-size: 12px;
    }
    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    .status-badge.status-pending {
        background: #000000;
        color: #6c757d;
    }
    .status-badge.status-accepted {
        background: #000000;
        color: #6c757d;
    }
    .status-badge.status-rejected {
        background: #000000;
        color: #6c757d;
    }
    .request-body {
        text-align: left;
    }
    .book-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .book-details {
        flex: 1;
    }
    .book-details strong {
        font-size: 18px;
        color: #2c3e50;
    }
    .book-author {
        color: #7f8c8d;
        font-size: 14px;
    }
    .request-message {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        border-left: 3px solid #6c757d;
    }
    .request-message p {
        margin: 8px 0 0 0;
        color: #555;
    }
</style>