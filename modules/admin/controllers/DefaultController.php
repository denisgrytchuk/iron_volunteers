<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;
use app\models\Admin;
use app\models\User;



/**
 * Default controller for the `admin` module
 */
class DefaultController extends AppAdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //$sql = 'SELECT admin FROM user where id=1';
        $admin = Admin::find(['admin'])->where(['id'=>Yii::$app->user->id])->one();
        //var_dump($admin->admin);exit();
        //return $admin->admin;

        if(!$admin->admin){
            header('Location: /');
            exit();
        }
        return $this->render('index');
    }


}
