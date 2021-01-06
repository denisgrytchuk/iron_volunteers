<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 03.01.2018
 * Time: 19:41
 */

namespace app\modules\admin\controllers;

use Yii;
use app\models\ContactForm;
use app\models\Admin;




class FeedbackController extends AppAdminController
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

        return $this->render(
            'index'
        );
    }

    public function actionView($id)
    {
        //var_dump($id);exit();
        $messages = ContactForm::find()->where(['id'=>$id])->one();
        return $this->render('view',
            [
                'messages' => $messages
            ]
        );
    }

    public function actionDelete($id)
    {

        $messages = ContactForm::find()->where(['id'=>$id])->one();
        $messages->delete();
        header('Location: /admin/feedback/');
        exit();
    }
}