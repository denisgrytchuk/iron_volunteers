<?php


namespace app\modules\admin\controllers;

use app\models\ImageUpload;
use app\models\Packet;
use yii\web\Controller;
use Yii;
use app\models\Admin;
use app\models\User;
use yii\web\UploadedFile;


/**
 * Default controller for the `admin` module
 */
class PacketController extends AppAdminController
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

        $model = new Packet;
        if ($model->load(Yii::$app->request->post())&& $model->validate()) {
            if($_POST['Packet']['name']) {
                //var_dump($_POST['Packet']);exit();
                $img = new ImageUpload;
                if($_POST['Packet']['change_photo']){
                    $file = UploadedFile::getInstance($model,'photo');
                    $name_file = $img->uploadFile($file);
                    if($name_file) {
                        $full_name = "/web/uploads/" . $name_file;
                    }
                    else{
                        $full_name = "";
                    }
                    $delete_name = str_replace('/web/','',$model->photo);
                    if(file_exists($delete_name)) {
                        $img->deleteFile($delete_name);
                    }
                    $model->photo = $full_name;
                }
                $model->name = $_POST['Packet']['name'];
                $model->save();
                $this->refresh();
            }
        }


        return $this->render('index',[
            'model'=>$model
        ]);
    }

    public function actionDelete($id)
    {

        $packet = Packet::find()->where(['id'=>$id])->one();
        $packet->delete();
        header('Location: /admin/packet/');
        exit();
    }

    public function actionUpdate($id)
    {

        $model =  Packet::find()->where(['id'=>$id])->one();
        if ($model->load(Yii::$app->request->post())&& $model->validate()) {
                $img = new ImageUpload;
                if($_POST['Packet']['change_photo']){
                    $file = UploadedFile::getInstance($model,'photo');
                    $name_file = $img->uploadFile($file);
                    if($name_file) {
                        $full_name = "/web/uploads/" . $name_file;
                    }
                    else{
                        $full_name = "";
                    }
                    $delete_name = str_replace('/web/','',$model->photo);
                    if(file_exists($delete_name)) {
                        $img->deleteFile($delete_name);
                    }
                    $model->photo = $full_name;
                }
                $model->name = $_POST['Packet']['name'];
                $model->save();
                $this->refresh();
        }
        $model = Packet::find()->where(['id'=>$id])->one();
        return $this->render('update',
            [
                'model' => $model
            ]
        );
    }

}