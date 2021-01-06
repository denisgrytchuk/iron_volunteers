<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 09.02.2018
 * Time: 14:14
 */

namespace app\controllers;


use app\models\Admin;
use app\models\Article;
use app\models\EtapUser;
use app\models\Event;
use app\models\Participation;
use app\models\User;
use Yii;
use yii\web\Controller;

class RingController extends Controller
{


    public function actionIndex()
    {
        $admin = Admin::find(['admin'])->where(['id'=>Yii::$app->user->id])->one();
        $user = User::find(['ringer'])->where(['id'=>Yii::$app->user->id])->one();
        if(!$admin->admin && !$user->ringer){
            header('Location: /');
            exit();
        }
        $event = Event::find()->select(['title','id'])->all();
        return $this->render('index',['event'=>$event]);
    }

    public function actionView($id)
    {
        $admin = Admin::find(['admin'])->where(['id'=>Yii::$app->user->id])->one();
        $user = User::find(['ringer'])->where(['id'=>Yii::$app->user->id])->one();
        if(!$admin->admin && !$user->ringer){
            header('Location: /');
            exit();
        }
		
		$method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
			if (array_key_exists('user', $_POST)) {
				if (array_key_exists('participation_call', $_POST)) {
					$part = Participation::find()->where(['idUser'=>$_POST['user'],'idEvent'=>$id])->one();
					$part->status_of_call = $_POST['participation_call'];
					var_dump($part->save());
				}
				if (array_key_exists('participation_event', $_POST)) {
					$part = Participation::find()->where(['idUser'=>$_POST['user'],'idEvent'=>$id])->one();
					$part->status_of_event = $_POST['participation_event'];
					$part->save(false);
				}				
			}
			if (array_key_exists('etap', $_POST)) {
				if (array_key_exists('etap_status', $_POST)) {
						$event = EtapUser::find()
						->leftJoin('etap', 'etap.id = etap_user.idEtap')
						->where(['etap_user.id'=>$_POST['etap'],'etap.idEvent'=>$id])->one();
						$event->status = $_POST['etap_status'];
						$event->save(false);
				}
			}
        }

        if (\Yii::$app->request->isAjax) {
            return 'Запит прийнятий!';
        }		
		
        $participation =Participation::find()
            ->select('participation.first_role, 
            participation.second_role, 
            participation.prepare_etap,
            participation.status_of_call, 
            participation.status_of_event,
			user.id,
            user.username,
            user.surname,
            user.telephone, 
			user.black,
            user.city')
            ->leftJoin('user', 'user.id = participation.idUser')
            ->where(['participation.idEvent' => $id,
			'participation.active'=>1])->asArray()
            ->all();
		$etap =EtapUser::find()
            ->select('
			etap_user.idUser,
			etap_user.id,
             user.username,
             user.surname,
             user.telephone, 
             etap_user.time,
             etap_user.status,
             etap.name            
             ')
            ->leftJoin('user', 'user.id = etap_user.idUser')
            ->leftJoin('etap', 'etap.id = etap_user.idEtap')
            ->where(['etap.idEvent' => $id,
			'etap_user.active'=>1])->asArray()
            ->all();
        $event = Event::find()->select('title, id')->where(['id'=>$id])->one();
        return $this->render('view',[
		'participation'=>$participation,
		'event'=>$event,
		'etap' =>$etap,
		]);
    }

    public function actionAcept($id)
    {
        $admin = Admin::find(['admin'])->where(['id'=>Yii::$app->user->id])->one();
        if(!$admin->admin){
            header('Location: /ring');
            exit();
        }
		
		$method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
			if (array_key_exists('part', $_POST)) {
				if (array_key_exists('ended_role', $_POST)) {
					$part = Participation::find()->where(['id'=>$_POST['part']])->one();
					$part->ended_role = $_POST['ended_role'];
					var_dump($part->save());
				}
			}
        }

        if (\Yii::$app->request->isAjax) {
            return 'Запит прийнятий!';
        }		
		
		
		
		$participation =Participation::find()
            ->select('participation.first_role, 
            participation.second_role, 
			participation.ended_role,
            participation.prepare_etap,
            participation.status_of_call, 
            participation.status_of_event,
			participation.id,
            user.username,
			user.black,
            user.surname,')
            ->leftJoin('user', 'user.id = participation.idUser')
            ->where(['participation.idEvent' => $id,
			'participation.active'=>1])->asArray()
            ->all();
		$event = Event::find()->select('role, title, id')->where(['id'=>$id])->one();
        return $this->render('acept',
		['participation'=>$participation,
		'event'=>$event,
		]);
    }
}