<?php
use yii\helpers\Html;
$this->title = 'Все пользователи';
?>
<div class="site-users text-center">
    <div class="page-header">
        <h1>Все пользователи</h1>
        <p class="lead">Выберите пользователя, чтобы предложить обмен книгами</p>
    </div>
    <div class="row">
        <?php foreach ($users as $user): ?>
            <div class="col-md-4">
                <div class="panel panel-default user-card text-center">
                    <div class="panel-body">
                        <div class="user-avatar">
                            <div class="avatar-circle">
                                <?= strtoupper(mb_substr($user->username, 0, 1)) ?>
                            </div>
                        </div>
                        <h3><?= Html::encode($user->username) ?></h3>
                        <div class="user-actions">
                            <?= Html::a('Попросить книгу', ['exchange/request', 'to_user_id' => $user->id], ['class' => 'btn btn-gray btn-block']) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<style>
    .site-users {
        text-align: center;
    }
    .page-header {
        margin-bottom: 40px;
    }
    .user-card {
        transition: all 0.3s ease;
        border-radius: 10px;
        margin-bottom: 30px;
        padding: 20px 0;
    }
    .user-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .user-avatar {
        margin-bottom: 15px;
    }
    .avatar-circle {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ffffff 0%, #6c757d 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: white;
        font-size: 28px;
        font-weight: bold;
    }
    .user-actions {
        margin-top: 20px;
    }
    .btn-gray {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        border-radius: 20px;
        padding: 10px 20px;
        font-weight: 500;
    }
    .btn-gray:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .panel-body {
        padding: 30px 20px;
    }
    h3 {
        margin: 15px 0;
        color: #333;
        font-weight: 600;
    }
    .alert {
        border-radius: 10px;
        border: none;
        padding: 30px;
    }
</style>