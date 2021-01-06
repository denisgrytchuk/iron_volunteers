<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 11.02.2018
 * Time: 21:18
 */

namespace app\modules\admin\controllers;


use app\models\Admin;
use app\models\Etap;
use app\models\Event;
use Yii;

class EtapController extends AppAdminController
{
    public function beforeAction($action) {
		if(Yii::$app->user->isGuest){header('Location: /site/login'); exit();}
		$admin = Admin::find(['admin'])->where(['id'=>Yii::$app->user->id])->one();
        if(!$admin->admin){
            header('Location: /');
            exit();
        }
        return parent::beforeAction($action);
    }
	
    public function actionIndex()
    {

        $model = new Etap;
        $modelEvent = Event::find()->orderBy('title ASC')->all();
        foreach ($modelEvent as $value){
            $arrEvent[$value->id] = $value->title;
        }
        if ($model->load(Yii::$app->request->post())&& $model->validate()) {
            if($_POST['Etap']['name']) {
                $model->name = $_POST['Etap']['name'];
                $model->idEvent = $_POST['Etap']['idEvent'];
                $model->save();
                $this->refresh();
            }
        }


        return $this->render('index',[
            'model'=>$model,
            'arrEvent'=>$arrEvent
        ]);
    }

    public function actionDelete($id)
    {

        $packet = Etap::find()->where(['id'=>$id])->one();
        $packet->delete();
        header('Location: /admin/etap/');
        exit();
    }

    public function actionUpdate($id)
    {

        $model =  Etap::find()->where(['id'=>$id])->one();
        $modelEvent = Event::find()->orderBy('title ASC')->all();
        foreach ($modelEvent as $value){
            $arrEvent[$value->id] = $value->title;
        }
        if ($model->load(Yii::$app->request->post())&& $model->validate()) {
            if($_POST['Etap']['name']) {
                $model->name = $_POST['Etap']['name'];
                $model->idEvent = $_POST['Etap']['idEvent'];
                $model->save();
                $this->refresh();
            }
        }
        $model = Etap::find()->where(['id'=>$id])->one();
        return $this->render('update',
            [
                'model' => $model,
                'arrEvent'=>$arrEvent
            ]
        );
    }
}