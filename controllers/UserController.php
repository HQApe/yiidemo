<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\MUser;
use  app\models\MLoginForm;


class UserController extends Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['login']);
        }
        return $this->render('index');
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['list']);
        }

        $model = new MLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['list']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionList() {
        $query = MUser::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd()
    {
        $model = new MUser();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'userId' => $model->userId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('add', [
            'model' => $model,
        ]);
    }

    public function actionView($userId) {
        return $this->render('view', [
            'model' => MUser::findByUserId($userId),
        ]);
    }

    public function actionUpdate($userId) {

        $model = MUser::findByUserId($userId);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'userId' => $model->userId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($userId) {
        MUser::findByUserId($userId)->delete();
        return $this->redirect(['list']);
    }
}