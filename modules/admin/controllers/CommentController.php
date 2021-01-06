<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 08.02.2018
 * Time: 11:57
 */

namespace app\modules\admin\controllers;


use app\models\Comment;
use app\models\Admin;
use Yii;

class CommentController extends AppAdminController
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
        return $this->render('index',[]);
    }

    public function actionUpdate($id)
    {
        $comment = Comment::find()->where(['id'=>$id])->one();
        //var_dump($comment);exit();
        if($comment->public){
            $comment->public = 0;
        }
        else{
            $comment->public = 1;
        }
        $comment->save();
        header('Location: /admin/comment/');
        exit();
    }

    public function actionDelete($id)
    {
        $comment = Comment::find()->where(['id'=>$id])->one();
        $comment->delete();
        header('Location: /admin/comment/');
        exit();

    }
}