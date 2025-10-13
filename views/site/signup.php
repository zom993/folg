<?php
use yii\helpers\Html;
$this->title = 'Регистрация';
?>
<div class="site-signup text-center">
    <div class="signup-container">
        <h1>Регистрация</h1>
        <form method="post" class="signup-form">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->csrfToken ?>">

            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Имя пользователя" required>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Пароль" required>
            </div>

            <button type="submit" class="btn btn-dark btn-block">Зарегистрироваться</button>
        </form>

        <div class="signup-links">
            <p>Уже есть аккаунт? <?= Html::a('Войти', ['login'], ['class' => 'link-dark']) ?></p>
        </div>
    </div>
</div>
<style>
    .site-signup {
        padding: 40px 20px;
        color: #333;
    }
    .signup-container {
        max-width: 400px;
        margin: 0 auto;
        padding: 40px 30px;
        border: 2px solid #333;
        border-radius: 15px;
        background: #fff;
    }
    .signup-container h1 {
        color: #333;
        margin-bottom: 30px;
        font-weight: 600;
    }
    .signup-form {
        margin-bottom: 20px;
    }
    .form-control {
        background: #f8f9fa;
        border: 2px solid #333;
        border-radius: 10px;
        padding: 12px 15px;
        margin-bottom: 20px;
        color: #333;
        font-size: 16px;
    }
    .form-control:focus {
        border-color: #666;
        box-shadow: 0 0 0 0.2rem rgba(51, 51, 51, 0.25);
        background: #fff;
    }
    .form-control::placeholder {
        color: #666;
    }
    .btn-dark {
        background-color: #333;
        border-color: #333;
        color: #fff;
        border-radius: 10px;
        padding: 12px;
        font-size: 16px;
        font-weight: 500;
        margin-top: 10px;
    }
    .btn-dark:hover {
        background-color: #555;
        border-color: #555;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .signup-links {
        margin-top: 20px;
    }
    .link-dark {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        border-bottom: 1px solid #333;
    }
    .link-dark:hover {
        color: #555;
        border-bottom-color: #555;
    }
</style>