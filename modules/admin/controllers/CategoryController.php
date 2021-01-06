<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 02.12.2017
 * Time: 22:38
 */

namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;
use app\models\Admin;
use app\models\Category;



/**
 * Default controller for the `admin` module
 */
class CategoryController extends AppAdminController
{
    /**
     * Renders the index view for the module
     * @return string
     */
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
        //$sql = 'SELECT admin FROM user where id=1';
        
        $model = new Category;
        if ($model->load(Yii::$app->request->post())&& $model->validate()) {
            if($_POST['Category']['name']) {
                $model->name = $_POST['Category']['name'];
                $model->insert();
                $this->refresh();
            }
        }


        return $this->render('index',
            [
                'model' => $model
            ]
        );
    }

    public function actionView($id)
    {
        $category = Category::find()->where(['id'=>$id])->one();
        return $this->render('view',
            [
                'category' => $category
            ]
        );
    }

    public function actionDelete($id)
    {
        $category = Category::find()->where(['id'=>$id])->one();
        $category->delete();
        header('Location: /admin/category/');
        exit();
    }

    public function actionUpdate($id)
    {
        $model = new Category;
        $method = $_SERVER['REQUEST_METHOD'];
        $up_model= Category::find()->where(['id'=>$id])->one();
        if ( $method == 'POST' ) {
            $name_up  = $_POST['name'];
            $up_model->name=$name_up;
            $up_model->save();
            header('Location: /admin/category/');
            exit();
            /*return $this->render('index',
                [
                    'model' => $model
                ]
            );*/
        }
        $category = Category::find()->where(['id'=>$id])->one();
        return $this->render('update',
            [
                'category' => $category,
                'model' => $model
            ]
        );
    }
}
