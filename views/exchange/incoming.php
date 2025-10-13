<?php
use yii\helpers\Html;
$this->title = 'Входящие запросы';
?>
<div class="exchange-incoming">
    <h1>Запросы на обмен</h1>

    <?php foreach ($requests as $request): ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <h4><?= Html::encode($request->fromUser->username) ?> хочет получить:</h4>
                <p><strong>Книга:</strong> "<?= Html::encode($request->book_title) ?>"</p>
                <p><strong>Автор:</strong> <?= Html::encode($request->book_author) ?></p>
                <?php if ($request->message): ?>
                    <p><strong>Сообщение:</strong> <?= Html::encode($request->message) ?></p>
                <?php endif; ?>

                <div class="btn-group">
                    <?= Html::a('Принять', ['accept', 'id' => $request->id], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('Отклонить', ['reject', 'id' => $request->id], ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>