<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 09.02.2018
 * Time: 17:00
 */

namespace app\modules\admin\controllers;


use app\models\EtapUser;
use app\models\Participation;
use app\models\User;
use app\models\Admin;
use Yii;

class VolunteersController extends AppAdminController
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
	
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {

            $check = User::find()->where(['id'=>$_POST['idUser']])->one();
            //var_dump($_POST['black']);
            if($_POST['black']){
                //var_dump('black');
                if($check->black){
                    $check->black = 0;
                }else{
                    $check->black = 1;

                }
            }else{
                //var_dump('ringer');
                if($check->ringer){
                    $check->ringer = 0;
                }else{
                    $check->ringer = 1;

                }
            }
            var_dump($check->save(false));
        }

        if (\Yii::$app->request->isAjax) {
            return 'Запит прийнятий!';
        }

        $users = User::find()->select([
            'id','username','surname','sex','email','telephone','birthday','t_shirt','city','study','black','ringer'
        ])->all();

        return $this->render('index',['users'=>$users]);
    }

    public function actionEvents($id)
    {

        $event = Participation::find()
            ->select('participation.first_role, 
            participation.second_role, 
			participation.active, 
            participation.status_of_call, 
            participation.status_of_event,
            event.title,
			participation.date_event')
            ->leftJoin('event', 'event.id = participation.idEvent')
            ->where(['idUser'=>$id])
            ->asArray()
            ->all();
        $etap = EtapUser::find()
            ->select('etap.name, 
            etap_user.status,
			etap_user.active,
            event.title')
            ->where(['idUser'=>$id])
            ->leftJoin('etap', 'etap.id = etap_user.idEtap')
            ->leftJoin('event', 'event.id = etap.idEvent')
            ->asArray()
            ->all();
        $user = User::find()->where(['id'=>$id])->one();
        return $this->render('events',['events'=>$event,'user'=>$user,'etap'=>$etap]);
    }
}