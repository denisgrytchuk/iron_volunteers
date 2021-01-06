<?php

namespace app\controllers;


use yii\web\Controller;
use app\models\Admin;
use app\models\EtapUser;
use app\models\Participation;
use app\models\User;
use PHPMailer\PHPMailer\PHPMailer;
use Yii;

class CabinetController extends Controller
{
	public function actionIndex()
    {
		$method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {
			if (array_key_exists('idParticipation', $_POST)) {
				$part = Participation::find()
				->where(['id'=>$_POST['idParticipation']])
				->one();
				$part->active = 0;
				var_dump($part->save(false));
			}
			if (array_key_exists('idEtap', $_POST)) {
				$etap = EtapUser::find()
				->where(['id'=>$_POST['idEtap']])
				->one();
				$etap->active = 0;
				var_dump($etap->save(false));
			}
		}
		if (\Yii::$app->request->isAjax) {
            return 'Запит прийнятий!';
        }	
		
        $user = User::find()->where(['id'=>Yii::$app->user->id])->one();
        $events = Participation::find()
            ->select('participation.ended_role, 
            event.title,
			participation.id,
            event.status')
            ->leftJoin('event', 'event.id = participation.idEvent')
            ->where(['idUser'=>Yii::$app->user->id,'participation.active'=>1])
            ->asArray()
            ->all();
        $etap = EtapUser::find()
            ->select('etap.name, 
            event.title,
            event.status,
			etap_user.id')            
            ->leftJoin('etap', 'etap.id = etap_user.idEtap')
            ->leftJoin('event', 'event.id = etap.idEvent')
			->where(['idUser'=>Yii::$app->user->id,'etap_user.active'=>1])
            ->asArray()
            ->all();

        return $this->render('index',[
            'user' => $user,
            'events' => $events,
            'etap' => $etap

        ]);
    }
	
	public function actionSetting()
    {
        $model = User::find()->where(['id'=>Yii::$app->user->id])->one();
        if(isset($_POST['User'])){
            //var_dump($_POST);exit();
            $model->username = htmlspecialchars($_POST['User']['username']);
            $model->surname = htmlspecialchars($_POST['User']['surname']);
            $model->email = $_POST['User']['email'];
            $model->birthday = $_POST['User']['birthday'];
            switch ($_POST['User']['t_shirt']){
                case 0:
                    $model->t_shirt = 'XS';
                    break;
                case 1:
                    $model->t_shirt = 'S';
                    break;
                case 2:
                    $model->t_shirt = 'M';
                    break;
                case 3:
                    $model->t_shirt = 'L';
                    break;
                case 4:
                    $model->t_shirt = 'XL';
                    break;
                case 5:
                    $model->t_shirt = 'XXL';
                    break;
            }
            $model->telephone = $_POST['User']['telephone'];
            $model->city = htmlspecialchars($_POST['User']['city']);
            $model->study = htmlspecialchars($_POST['User']['study']);
            if($model->validate())
            {
                // Сохранить полученные данные
                // false нужен для того, чтобы не производить повторную проверку
                $model->save(false);

                return $this->refresh();
            }
            


        }

        return $this->render('setting',['model'=>$model]);
    }

    public function actionPassword()
    {
        $model = new Admin;
        $model1 = new User;
        if(isset($_POST['Admin'])) {
            if ($_POST['Admin']['password']) {
                $check = User::find()->where(['id' => Yii::$app->user->id])->one();
                if (\Yii::$app->security->validatePassword($_POST['Admin']['password'], $check->password)) {
                    $check->password = Yii::$app->getSecurity()->generatePasswordHash($_POST['User']['password']);
                    var_dump($check->save(false));
                    Yii::$app->user->logout();
                    return $this->goHome();
                }
            }else{
                Yii::$app->session->setFlash('problem','Введіть старий пароль');
                return $this->refresh();
            }
        }

        return $this->render('password',['model'=>$model,'model1'=>$model1]);
    }

    public function actionForget()
    {
        $user = new User;
        if(isset($_POST['User'])) {
            $is_user = User::find()->where(['email'=>$_POST['User']['email']])->one();
            if($is_user){
                $hash = $this->create_hash();
                $is_user->forget_password = $hash;
                $is_user->save(false);
                $m = new PHPMailer();
                $m->CharSet = 'UTF-8';
                $m->isSMTP();
                $m->SMTPAuth = true;
                $m->Host = 'smtp.gmail.com';
                $m->Username = 'iron.volunteers@gmail.com';
                $m->Password = 'volunteer18';
                $m->SMTPSecure = 'ssl';
                $m->Port = 465;
                $m->From = 'iron.volunteers@gmail.com';
                $m->FromName = 'Iron Volunteers Ukraine';
                $m->addAddress($_POST['User']['email']);
                $m->AddReplyTo("iron.volunteers@gmail.com", "Iron Volunteers Ukraine");
                //$text =iconv("UTF-8", "WINDOWS-1251", 'Відновлення пароля');
                $m->Subject ='Відновлення пароля';
                $m->Body= "Для того, щоб змінити пароль перейдіть за посиланям <a href='ironvolunteers.org/cabinet/forgetpassword?value=$hash'>Оновити пароль</a>";
                $m->AltBody ="Для того, щоб змінити пароль перейдіть за посиланям <a href='ironvolunteers.org/cabinet/forgetpassword?value=$hash'>Оновити пароль</a>";
				//$m->Body= "Для того, щоб змінити пароль перейдіть за посиланям <a href='yii2/cabinet/forgetpassword?value=$hash'>Оновити пароль</a>";
                //$m->AltBody ="Для того, щоб змінити пароль перейдіть за посиланям <a href='yii2/cabinet/forgetpassword?value=$hash'>Оновити пароль</a>";
                $m->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );
               $m->send();
				//var_dump($m->ErrorInfo);
		
                Yii::$app->session->setFlash('email','Повідомлення надіслано вам на пошту');
                return $this->refresh();
            }else{
                Yii::$app->session->setFlash('error','Користувач із такою поштою незареєстрований');
                return $this->refresh();
            }


        }
        return $this->render('forget',
            ['user'=>$user]);
    }

    public function actionForgetpassword($value)
    {
        $user = User::find()->where(['forget_password'=>$value])->one();
        if($user){
            if(isset($_POST['User'])){
                $user->password = Yii::$app->getSecurity()->generatePasswordHash($_POST['User']['password']);
                $user->save(false);
                return $this->goHome();
            }
            $model = new User;
            return $this->render('forgetpassword',['model'=>$model]);
        }else{
            return $this->goHome();
        }

    }

    public function create_hash()
    {
        $str = '';
        for($i=0;$i<10;$i++){
            //$str=$str.random_int(0,9);
			$str=$str.mt_rand(0,9);
        }
        $str = $str . time();
        $str = md5($str);
       return $str;
    }
	
	
}