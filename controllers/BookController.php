<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use app\models\UserBook;

class BookController extends Controller
{
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $model = new UserBook();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Книга успешно добавлена!');
            return $this->redirect(['my-books']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionMyBooks()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $books = UserBook::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy(['created_at' => SORT_DESC])
            ->all();

        return $this->render('my-books', [
            'books' => $books,
        ]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Книга обновлена!');
            return $this->redirect(['my-books']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        Yii::$app->session->setFlash('success', 'Книга удалена!');
        return $this->redirect(['my-books']);
    }
    protected function findModel($id)
    {
        $model = UserBook::findOne($id);

        if (!$model || $model->user_id != Yii::$app->user->id) {
            throw new NotFoundHttpException('Книга не найдена.');
        }

        return $model;
    }
    public function actionAll()
    {
        $books = UserBook::getAvailableBooks();

        return $this->render('all', [
            'books' => $books,
        ]);
    }
}