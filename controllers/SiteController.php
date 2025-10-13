<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionSignup()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $user = new User();
        if (Yii::$app->request->post()) {
            $user->username = Yii::$app->request->post('username');
            $user->password = Yii::$app->request->post('password');

            if ($user->save()) {
                // Автоматически входим после регистрации
                Yii::$app->user->login($user);
                return $this->goHome();
            }
        }
        return $this->render('signup', [
            'user' => $user,
        ]);
    }
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $error = '';
        if (Yii::$app->request->post()) {
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('password');

            $user = User::findByUsername($username);

            if ($user && $user->validatePassword($password)) {
                Yii::$app->user->login($user);
                return $this->goHome();
            } else {
                $error = 'Неверное имя пользователя или пароль';
            }
        }
        return $this->render('login', [
            'error' => $error,
        ]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
    public function actionUsers()
    {
        $users = User::find()->where(['not', ['id' => Yii::$app->user->id]])->all();

        return $this->render('users', [
            'users' => $users,
        ]);
    }
}