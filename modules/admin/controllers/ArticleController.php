<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.01.2018
 * Time: 16:51
 */

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\ImageUpload;
use app\models\Info;
use Yii;
use app\models\Event;
use app\models\Article;
use app\models\Admin;
use yii\web\UploadedFile;
use app\models\ArticleSearch;


class ArticleController extends AppAdminController
{
    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
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
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',['searchModel'=>$searchModel,'dataProvider'=>$dataProvider]);
    }

    public function actionView($id)
    {

        $article = Article::find()->where(['id'=>$id])->one();
        return $this->render('view',
            [
                'article'=>$article,
            ]);
    }

    public function actionAdd()
    {

        $model = new Article();
        $modelCategory = Category::find()->orderBy('name ASC')->all();
        foreach ($modelCategory as $value){
            $arrCategory[$value->id] = $value->name;
        }
        $img = new ImageUpload;
        if ($model->load(Yii::$app->request->post())&& $model->validate()) {
            //var_dump($_POST);
            $file = UploadedFile::getInstance($model,'photo');
            //var_dump($file);exit();
            $name_file = $img->uploadFile($file);
            if($name_file) {
                $full_name = "/web/uploads/" . $name_file;
            }
            else{
                $full_name = "";
            }
            //exit();
            $model->idCategory = $_POST['Article']['idCategory'];
            $model->title = htmlspecialchars($_POST['Article']['title']);
            $model->content = $_POST['Article']['content'];
            $model->date = $_POST['Article']['date'];
            $model->photo = $full_name;
            $model->save();
        }
        return $this->render('add',
            [
                'model'=> $model,
                'modelCategory'=> $modelCategory,
                'arrCategory'=>$arrCategory,
            ]
        );
    }

    public function actionUpdate($id)
    {

        $article = Article::find()->where(['id'=>$id])->one();
        $modelCategory = Category::find()->orderBy('name ASC')->all();
        foreach ($modelCategory as $value){
            $arrCategory[$value->id] = $value->name;
        }
        $img = new ImageUpload;
        if ($article->load(Yii::$app->request->post())&& $article->validate()) {
            //var_dump($_POST);
            if($_POST['Article']['change_photo']){
                $file = UploadedFile::getInstance($article,'photo');
                $name_file = $img->uploadFile($file);
                if($name_file) {
                    $full_name = "/web/uploads/" . $name_file;
                }
                else{
                    $full_name = "";
                }
                $delete_name = str_replace('/web/','',$article->photo);
                //var_dump($full_name);exit();
                if(file_exists($delete_name)) {
					$event = Event::find()->where(['photo'=>$delete_name])->one();
					if($event){
					}else{
						$img->deleteFile($delete_name);
					}
                    
                }
                $article->photo = $full_name;
            }
            $article->idCategory = $_POST['Article']['idCategory'];
            $article->title = htmlspecialchars($_POST['Article']['title']);
            $article->content = $_POST['Article']['content'];
            $article->date = $_POST['Article']['date'];
            $article->access = $_POST['Article']['access'];
            if($_POST['Article']['main']){
                $ex_main = Article::find()->where(['main'=>1])->one();
                $ex_main->main = 0;
                $ex_main->save();
                $article->main = $_POST['Article']['main'];
            }
            $article->save();
        }
        return $this->render('update',
            [
                'article'=>$article,
                'modelCategory'=> $modelCategory,
                'arrCategory'=>$arrCategory,
            ]
        );
    }

    public function actionDelete($id)
    {

        $article = Article::find()->where(['id'=>$id])->one();
        $delete_name = str_replace('/web/', '', $article->photo);
        if(file_exists($delete_name)) {
            $event = Event::find()->where(['photo'=>$delete_name])->one();
			if($event){
			}else{
			unlink($delete_name);
			}
        }
        $article->delete();
        header('Location: /admin/article/');
        exit();
    }


}

