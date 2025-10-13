<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\ExchangeRequest;
use app\models\User;

class ExchangeController extends Controller
{
    public function actionRequest($to_user_id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $toUser = User::findOne($to_user_id);
        $model = new ExchangeRequest();
        $get = Yii::$app->request->get();
        if (isset($get['book_title'])) {
            $model->book_title = $get['book_title'];
        }
        if (isset($get['book_author'])) {
            $model->book_author = $get['book_author'];
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->from_user_id = Yii::$app->user->id;
            $model->to_user_id = $to_user_id;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Запрос на обмен отправлен!');
                return $this->redirect(['my-requests']);
            }
        }
        return $this->render('request', [
            'model' => $model,
            'toUser' => $toUser,
        ]);
    }
    public function actionMyRequests()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $requests = ExchangeRequest::find()
            ->where(['from_user_id' => Yii::$app->user->id])
            ->with('toUser')
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        return $this->render('my-requests', [
            'requests' => $requests,
        ]);
    }
    public function actionIncoming()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $requests = ExchangeRequest::find()
            ->where(['to_user_id' => Yii::$app->user->id, 'status' => 'pending'])
            ->with('fromUser')
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        return $this->render('incoming', [
            'requests' => $requests,
        ]);
    }
    public function actionAccept($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $request = ExchangeRequest::findOne($id);

        if ($request && $request->to_user_id == Yii::$app->user->id) {
            $request->status = 'accepted';
            $request->save();
            Yii::$app->session->setFlash('success', 'Вы приняли запрос на обмен!');
        }
        return $this->redirect(['incoming']);
    }
    public function actionReject($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $request = ExchangeRequest::findOne($id);
        if ($request && $request->to_user_id == Yii::$app->user->id) {
            $request->status = 'rejected';
            $request->save();
            Yii::$app->session->setFlash('info', 'Вы отклонили запрос на обмен');
        }
        return $this->redirect(['incoming']);
    }
    public function actionHistory()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        $sentRequests = ExchangeRequest::find()
            ->where(['from_user_id' => Yii::$app->user->id])
            ->andWhere(['not', ['status' => 'pending']])
            ->with('toUser')
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        $receivedRequests = ExchangeRequest::find()
            ->where(['to_user_id' => Yii::$app->user->id])
            ->andWhere(['not', ['status' => 'pending']])
            ->with('fromUser')
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        return $this->render('history', [
            'sentRequests' => $sentRequests,
            'receivedRequests' => $receivedRequests,
        ]);
    }
}