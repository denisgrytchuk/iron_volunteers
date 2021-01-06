<?php

namespace app\controllers;


use app\models\Etap;
use app\models\EtapUser;
use app\models\Event;
use app\models\PacketEvent;
use app\models\Participation;
use app\models\User;
use PHPMailer\PHPMailer\PHPMailer;
use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Controller;
use app\models\Article;
use app\models\Category;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $main = Article::find()->where(['main'=>1])->one();
        $dates = Article::find()->orderBy(['date'=>SORT_DESC])->where(['access'=>1])->limit(5)->all();
        $category = Category::find()->all();
        $list = $this->createList($category);

        //var_dump($info->idMainArticle);exit();
        return $this->render('index',
            [
                'dates'=>$dates,
                'category'=> $category,
                'list'=> $list,
                'main'=>$main
            ]);
    }

    public function actionNews()
    {
        $category = Category::find()->all();
        $list = $this->createList($category);

        ////////////////////////////доробити
        $pages = new Pagination(
            ['totalCount' => 20,
                'pageSize' => 4
            ]);
        $news = Article::find()->
        select(['title','id','photo'])->
        orderBy(['date'=>SORT_DESC])->
            where(['access'=>1])->offset($pages->offset)
        ->limit($pages->limit)->
        all();


        return $this->render('news',
            [
                'category'=> $category,
                'list'=> $list,
                'news'=>$news,
                'pages'=>$pages
            ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegistration()
    {

        $model = new User;
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

            switch ($_POST['User']['sex']){
                case 0:
                    $model->sex = 'Чоловік';
                    break;
                case 1:
                    $model->sex = 'Жінка';
                    break;
            }

            $model->telephone = $_POST['User']['telephone'];
            $model->city = htmlspecialchars($_POST['User']['city']);
            $model->study = htmlspecialchars($_POST['User']['study']);
            $model->password = $_POST['User']['password'];
            $model->password_repeat = $_POST['User']['password_repeat'];

            // Проверка данных
            if($model->validate())
            {
                // Сохранить полученные данные
                // false нужен для того, чтобы не производить повторную проверку
                $model->save(false);

                $this->redirect('login');
            }

        }

        return $this->render('registration',
            [
                'model'=> $model
            ]);
    }

    public function actionEvents()
    {
        $event = Event::find()->orderBy(['id'=>SORT_DESC])->where(['status'=>1])->all();
        return $this->render('events',
            [
                'event'=> $event
            ]
        );
    }

    public function actionEvent($id)
    {
        $status = Event::find()->where(['id'=>$id])->one();
        if($status->status) {
            $participation = Participation::find()->where(['idUser' => Yii::$app->user->id])->all();

            $packets = PacketEvent::find()
                ->select('packet.name, packet.photo' )
                ->leftJoin('packet', 'packet.id = packet_event.idPacket')
                ->where(['idEvent'=>$id])
                ->asArray()->all();

            $etap = Etap::find()->where(['idEvent'=>$id])->all();

            $method = $_SERVER['REQUEST_METHOD'];
            if ($method == 'POST') {
                $part = new Participation;
                $part->idEvent = $_POST['idEvent'];
                $part->idUser = $_POST['idUser'];
                $part->first_role = $_POST['role'];
                $part->second_role = $_POST['alt_role'];
				$part->date_event = date("Y-m-d H:i:s");
                $part->save();




                if (array_key_exists('id', $_POST)) {
                    $idEtap = $_POST['id'];
                    $time = $_POST['text'];
                    for($i=0;$i<count($idEtap);$i++){
                        if($time[$i]==""){}else{
                            $etap = new EtapUser;
                            $etap->idUser = Yii::$app->user->id;
                            $etap->idEtap = $idEtap[$i];
                            $etap->time = htmlspecialchars($time[$i]);
                            $etap->save();
                        }
                    }
                }
                $user = User::find()->where(['id'=>Yii::$app->user->id])->one();
                $event = Event::find()->where(['id'=>$id])->one();
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
                //var_dump($user->email);
                $m->addAddress($user->email);
                $m->AddReplyTo("iron.volunteers@gmail.com", "Iron Volunteers Ukraine");
                $m->Subject =$event->title;
                $m->Body= 'Дякуєм за реєстрацію, з вами скоро зв\'яжуться';
                $m->AltBody = 'Дякуєм за реєстрацію, з вами скоро зв\'яжуться';
                $m->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );
                $m->send();

            }

            if (\Yii::$app->request->isAjax) {
                return 'Запит прийнятий!';
            }

            $event = Event::find()->where(['id' => $id])->one();

            return $this->render('event', [
                'event' => $event,
                'participation' => $participation,
                'packets'=>$packets,
                'etap'=>$etap
            ]);
        }
        else{
            header('Location: /');
            exit();
        }
    }


        /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        /*$model->name = 'Автор';
        $model->email = 'mail@mail.com';
        $model->text = 'Текст повідомлення';
        $model->save();*/


        if($model->load(Yii::$app->request->post()))
        {
            //var_dump($_POST);exit();
            if($model->save())
            {
                Yii::$app->session->setFlash('success','Дані прийняті');
                return $this->refresh();
            }
            else
            {
                Yii::$app->session->setFlash('error','Помилка');
            }
        }

        return $this->render('contact',compact('model'));


    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function createList($category){
        $list=[];
        $i=0;
        foreach ($category as $cat){
            $list[$i] = Article::find()->
            select(['title','id'])->
            where(['idCategory'=>$cat->id,'access'=>1])->
            orderBy(['date'=>SORT_DESC])->
            all();
            $i++;
        }
        return $list;
    }


    /*public function actionSend($id)
    {
        $user = User::find()->where(['id'=>Yii::$app->user->id])->one();
        $event = Event::find()->where(['id'=>$id])->one();
        $m = new PHPMailer();
        $m->isSMTP();
        $m->SMTPAuth = true;
        $m->SMTPDebug = 2;
        $m->Host = 'smtp.gmail.com';
        $m->Username = 'dykyjhutsul@gmail.com';
        $m->Password = 'sdfyfylhsq97';
        $m->SMTPSecure = 'tls';
        $m->Port = 587;
        $m->From = 'dykyjhutsul@gmail.com';
        $m->FromName = 'Iron Volunteers Ukraine';
        //var_dump($user->email);
        $m->addAddress($user->email);
        $m->AddReplyTo("dykyjhutsul@gmail.com", "Iron Volunteers Ukraine");
        $m->Subject =$event->title;
        $m->Body= 'Дякуєм за реєстрацію, з вами скоро зв\'яжуться';
        $m->AltBody = 'Дякуєм за реєстрацію, з вами скоро зв\'яжуться';
        $m->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );
        var_dump($m->send());
    }*/

}
