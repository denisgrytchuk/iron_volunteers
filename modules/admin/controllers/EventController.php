<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 19.01.2018
 * Time: 15:41
 */

namespace app\modules\admin\controllers;

use Yii;
use app\models\Admin;
use app\models\Etap;
use app\models\Article;
use app\models\EtapUser;
use app\models\Event;
use app\models\EventSearch;
use app\models\ImageUpload;
use app\models\Packet;
use app\models\PacketEvent;
use app\models\Participation;

use PHPExcel;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Fill;
use PHPExcel_Writer_Excel5;

use yii\db\Query;
use yii\web\UploadedFile;

class EventController extends AppAdminController
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
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',['searchModel'=>$searchModel,'dataProvider'=>$dataProvider]);
    }

    public function actionAdd()
    {
        $model = new Event();
        $img = new ImageUpload;
        if ($model->load(Yii::$app->request->post())&& $model->validate()) {



            $file = UploadedFile::getInstance($model,'photo');

            $name_file = $img->uploadFile($file);
            if($name_file) {
                $full_name = "/web/uploads/" . $name_file;
            }
            else{
                $full_name = "";
            }
            //exit();
            $model->title = htmlspecialchars($_POST['Event']['title']);
            $model->content = $_POST['Event']['content'];
            $model->date = $_POST['Event']['date'];
            $model->role = $_POST['Event']['role'];
			$model->place = $_POST['Event']['place'];
			$model->location = $_POST['Event']['location'];
            $model->xls = $_POST['Event']['xls'];
            $model->photo = $full_name;

            $model->save();


        }
        return $this->render('add',
            [
                'model'=> $model,
            ]
        );
    }

    public function actionUpdate($id)
    {
        $event = Event::find()->where(['id'=>$id])->one();
        $img = new ImageUpload;
        if ($event->load(Yii::$app->request->post())&& $event->validate()) {
            if($_POST['Event']['change_photo']){
                $file = UploadedFile::getInstance($event,'photo');
                $name_file = $img->uploadFile($file);
                if($name_file) {
                    $full_name = "/web/uploads/" . $name_file;
                }
                else{
                    $full_name = "";
                }
                $delete_name = str_replace('/web/','',$event->photo);
                //var_dump($full_name);exit();
                if(file_exists($delete_name)) {
					$article = Article::find()->where(['photo'=>$delete_name])->one();
					if($article){
					}else{
						$img->deleteFile($delete_name);
					}
                    
                }
                $event->photo = $full_name;
            }
            $event->title = $_POST['Event']['title'];
            $event->content = $_POST['Event']['content'];
            $event->date = $_POST['Event']['date'];
			$event->place = $_POST['Event']['place'];
			$event->location = $_POST['Event']['location'];
            $event->role = $_POST['Event']['role'];
            $event->status = $_POST['Event']['status'];
            $event->save();
        }
        return $this->render('update',
            [
                'event'=>$event,
                'id'=>$id
            ]
        );
    }

    public function actionView($id)
    {
        $event = Event::find()->where(['id'=>$id])->one();
        $packet = PacketEvent::find()
            ->select('
            packet.name,
            packet.photo')
            ->leftJoin('packet', 'packet.id = packet_event.idPacket')
            ->asArray()
            ->where(['idEvent'=>$id])->all();
        $etap = Etap::find()->where(['idEvent'=>$id])->all();
        return $this->render('view',
            [
                'event'=>$event,
                'packet'=>$packet,
                'etap'=>$etap
            ]);
    }

    public function actionDelete($id)
    {
        $event = Event::find()->where(['id'=>$id])->one();
        $delete_name = str_replace('/web/','',$event->photo);
        if(file_exists($delete_name)) {
            $article = Article::find()->where(['photo'=>$delete_name])->one();
			if($article){
			}else{
			unlink($delete_name);
			}
        }
        $event->delete();
        header('Location: /admin/event/');
        exit();
    }

	public function actionImg($id)
	{
		$event = Event::find()->where(['id'=>$id])->one();
        $img = new ImageUpload;
        if ($event->load(Yii::$app->request->post())&& $event->validate()) {
            if($_POST['Event']['change_photo']){
                $file = UploadedFile::getInstance($event,'img');
                $name_file = $img->uploadFile($file);
                if($name_file) {
                    $full_name = "/web/uploads/" . $name_file;
                }
                else{
                    $full_name = "";
                }
                $delete_name = str_replace('/web/','',$event->img);
                if(file_exists($delete_name)) {
					$article = Article::find()->where(['photo'=>$delete_name])->one();
					if($article){
					}else{
						$img->deleteFile($delete_name);
					}
                    
                }
                $event->img = $full_name;
            }
            $event->save();
        }
        return $this->render('img',
            [
                'event'=>$event,
                'id'=>$id
            ]
        );
	}
	
	
    public function actionDownload($id)
    {

        $event = Event::find(['xls'])->where(['id'=>$id])->one();
		$array_part = explode('/',$event->role);
		
		if (!in_array("", $array_part)) {
			array_push($array_part,'');
		}
		
		//var_dump($array_part);exit();
		$i=0;
		
		foreach($array_part as $arr){
			$xls = new PHPExcel();
			$xls->setActiveSheetIndex(0);
			$sheet = $xls->getActiveSheet();
			$sheet->setTitle($event->xls);
			$sheet->setCellValue("A1", 'Прізвище');
			$sheet->setCellValue("B1", 'Ім\'я');
			$sheet->setCellValue("C1", 'Телефон');
			$sheet->setCellValue("D1", 'Розмір футболки');
			$sheet->setCellValue("E1", 'Стать');
			$sheet->setCellValue("F1", 'Роль');
			$sheet->setCellValue("G1", 'Email');
			$sheet->setCellValue("H1", 'Дата народження');
			$sheet->setCellValue("I1", 'ВНЗ/школа');
			$sheet->setCellValue("J1", 'Місце проживання');
			$sheet->setCellValue("K1", 'Статус по дзвінку');
			$sheet->setCellValue("L1", 'Статус по заходу');
			$sheet->getColumnDimension('A')->setWidth(15);
			$sheet->getColumnDimension('B')->setWidth(18);
			$sheet->getColumnDimension('C')->setWidth(15);
			$sheet->getColumnDimension('D')->setWidth(6);
			$sheet->getColumnDimension('E')->setWidth(6);
			$sheet->getColumnDimension('F')->setWidth(30);
			$sheet->getColumnDimension('G')->setWidth(15);
			$sheet->getColumnDimension('H')->setWidth(15);
			$sheet->getColumnDimension('I')->setWidth(20);
			$sheet->getColumnDimension('J')->setWidth(15);
			$sheet->getColumnDimension('K')->setWidth(15);
			$sheet->getColumnDimension('L')->setWidth(25);

			
			$participation =Participation::find()
            ->select('participation.ended_role,
            participation.status_of_call, 
            participation.status_of_event,
            user.username,
             user.surname,
             user.sex,
             user.telephone, 
             user.email,
             user.t_shirt,
             user.birthday,
             user.city,
             user.study')
            ->leftJoin('user', 'user.id = participation.idUser')
            ->where(['participation.idEvent' => $id,'participation.ended_role'=>$arr,
			'participation.active'=> 1])
			->asArray()
            ->all();
			
			$j = 2;
			$next = 0;
			foreach($participation as $part){
				$next = $j;

				$sheet->setCellValueByColumnAndRow(0, $next, $part['username']);
				$sheet->setCellValueByColumnAndRow(1, $next, $part['surname']);
				$sheet->setCellValueByColumnAndRow(2, $next, $part['telephone']);
				$sheet->setCellValueByColumnAndRow(3, $next, $part['t_shirt']);
				$sheet->setCellValueByColumnAndRow(4, $next, $part['sex']);
				$sheet->setCellValueByColumnAndRow(5, $next, $part['ended_role']);
				$sheet->setCellValueByColumnAndRow(6, $next, $part['email']);
				$sheet->setCellValueByColumnAndRow(7, $next, $part['birthday']);
				$sheet->setCellValueByColumnAndRow(8, $next, $part['city']);
				$sheet->setCellValueByColumnAndRow(9, $next, $part['study']);
				$sheet->setCellValueByColumnAndRow(10, $next, $part['status_of_call']);
				$sheet->setCellValueByColumnAndRow(11, $next, $part['status_of_event']);

				$j++;
			};
			$objWriter = new PHPExcel_Writer_Excel5($xls);
			$objWriter->save(Yii::getAlias('@web').'event/'.$event->xls.'_'.$i.'.xls');
			$i++;
		}
		//
        $i=0;
		$etapy =Etap::find()
            ->select('
             etap.name            
             ')
            ->where(['etap.idEvent' => $id])->asArray()
            ->all();
		foreach($etapy as $arr){
			$xls = new PHPExcel();
			$xls->setActiveSheetIndex(0);
			$sheet = $xls->getActiveSheet();
			$sheet->setTitle($event->xls);
			$sheet->setCellValue("A1", 'Прізвище');
			$sheet->setCellValue("B1", 'Ім\'я');
			$sheet->setCellValue("C1", 'Телефон');
			$sheet->setCellValue("D1", 'Розмір футболки');
			$sheet->setCellValue("E1", 'Стать');
			$sheet->setCellValue("F1", 'Email');
			$sheet->setCellValue("G1", 'Дата народження');
			$sheet->setCellValue("H1", 'ВНЗ/школа');
			$sheet->setCellValue("I1", 'Місце проживання');
			$sheet->setCellValue("J1", 'Статус');
			$sheet->setCellValue("K1", 'Підготовчий етап');
			$sheet->setCellValue("L1", 'Час');

			$sheet->getColumnDimension('A')->setWidth(15);
			$sheet->getColumnDimension('B')->setWidth(18);
			$sheet->getColumnDimension('C')->setWidth(15);
			$sheet->getColumnDimension('D')->setWidth(6);
			$sheet->getColumnDimension('E')->setWidth(6);
			$sheet->getColumnDimension('F')->setWidth(18);
			$sheet->getColumnDimension('G')->setWidth(15);
			$sheet->getColumnDimension('H')->setWidth(15);
			$sheet->getColumnDimension('I')->setWidth(25);
			$sheet->getColumnDimension('J')->setWidth(25);

			$etap =EtapUser::find()
				->select('
				 user.username,
				 user.surname,
				 user.telephone, 
				 user.email,
				 user.sex,
				 user.t_shirt,
				 user.birthday,
				 user.city,
				 user.study,
				 etap_user.time,
				 etap_user.status,
				 etap.name
				 
				 ')
				->leftJoin('user', 'user.id = etap_user.idUser')
				->leftJoin('etap', 'etap.id = etap_user.idEtap')
				->where(['etap.idEvent' => $id,'etap.name'=>$arr,
				'etap_user.active'=> 1
				])->asArray()
				->all();
			$j = 2;
			$next = 0;
			foreach($etap as $part){
				$next = $j;

				$sheet->setCellValueByColumnAndRow(0, $next, $part['username']);
				$sheet->setCellValueByColumnAndRow(1, $next, $part['surname']);
				$sheet->setCellValueByColumnAndRow(2, $next, $part['telephone']);
				$sheet->setCellValueByColumnAndRow(3, $next, $part['t_shirt']);
				$sheet->setCellValueByColumnAndRow(4, $next, $part['sex']);
				$sheet->setCellValueByColumnAndRow(5, $next, $part['email']);
				$sheet->setCellValueByColumnAndRow(6, $next, $part['birthday']);
				$sheet->setCellValueByColumnAndRow(7, $next, $part['city']);
				$sheet->setCellValueByColumnAndRow(8, $next, $part['study']);
				$sheet->setCellValueByColumnAndRow(9, $next, $part['status']);
				$sheet->setCellValueByColumnAndRow(10, $next, $part['name']);
				$sheet->setCellValueByColumnAndRow(11, $next, $part['time']);

				$j++;
			};
			$objWriter = new PHPExcel_Writer_Excel5($xls);
			$objWriter->save(Yii::getAlias('@web').'event/'.$event->xls.'__'.$i.'.xls');
			$i++;
		}	
			
        return $this->render('download',['array_part'=>$array_part,'etapy'=>$etapy,'xls'=>$event->xls]);

	}
	
	public function actionGet($file)
	{
		return Yii::$app->response->sendFile('event/'.$file.'.xls');
	}

    public function actionPacket($id)
    {

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {

            $create_packet = PacketEvent::find()->where(['idEvent'=>$id,'idPacket'=>$_POST['idPacket']])->one();
            if($create_packet){
                $create_packet->delete();
            }else{
                $create_packet = new PacketEvent();
                $create_packet->idEvent = $id;
                $create_packet->idPacket = $_POST['idPacket'];
                $create_packet->save();
            }
        }

        if (\Yii::$app->request->isAjax) {
            return 'Запит прийнятий!';
        }
        $packet_event = PacketEvent::find()->where(['idEvent'=>$id])->all();
        $packet = Packet::find()->all();
        return $this->render('packet',['packet'=>$packet,'id'=>$id,'packet_event'=>$packet_event]);
    }

    public function actionEtap($id)
    {

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == 'POST') {

            $create_packet = PacketEvent::find()->where(['idEvent'=>$id,'idPacket'=>$_POST['idPacket']])->one();
            if($create_packet){
                $create_packet->delete();
            }else{
                $create_packet = new PacketEvent();
                $create_packet->idEvent = $id;
                $create_packet->idPacket = $_POST['idPacket'];
                $create_packet->save();
            }
        }

        if (\Yii::$app->request->isAjax) {
            return 'Запит прийнятий!';
        }
        $packet_event = PacketEvent::find()->where(['idEvent'=>$id])->all();
        $packet = Packet::find()->all();
        return $this->render('packet',['packet'=>$packet,'id'=>$id,'packet_event'=>$packet_event]);
    }

    /*public function actionDownloadetap($id)
	
    {

        $event = Event::find(['xls'])->where(['id'=>$id])->one();
        //var_dump(file_exists('event/'.$event->xls.'.xls'));
        //var_dump('   '.'event/'.$event->xls.'.xls');exit();


        $xls = new PHPExcel();
// Устанавливаем индекс активного листа
        $xls->setActiveSheetIndex(0);
// Получаем активный лист
        $sheet = $xls->getActiveSheet();
// Подписываем лист
        $sheet->setTitle($event->xls);
        $sheet->setCellValue("A1", 'Прізвище');
        $sheet->setCellValue("B1", 'Ім\'я');
        $sheet->setCellValue("C1", 'Телефон');
        $sheet->setCellValue("D1", 'Розмір футболки');
        $sheet->setCellValue("E1", 'Стать');
        $sheet->setCellValue("F1", 'Email');
        $sheet->setCellValue("G1", 'Дата народження');
        $sheet->setCellValue("H1", 'ВНЗ/школа');
        $sheet->setCellValue("I1", 'Місце проживання');
        $sheet->setCellValue("J1", 'Статус');
        $sheet->setCellValue("K1", 'Підготовчий етап');
        $sheet->setCellValue("L1", 'Час');

        $sheet->getColumnDimension('A')->setWidth(15);
        $sheet->getColumnDimension('B')->setWidth(18);
        $sheet->getColumnDimension('C')->setWidth(15);
        $sheet->getColumnDimension('D')->setWidth(6);
        $sheet->getColumnDimension('E')->setWidth(6);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(15);
        $sheet->getColumnDimension('H')->setWidth(15);
        $sheet->getColumnDimension('I')->setWidth(25);
        $sheet->getColumnDimension('J')->setWidth(25);

        $etap =EtapUser::find()
            ->select('
             user.username,
             user.surname,
             user.telephone, 
             user.email,
             user.sex,
             user.t_shirt,
             user.birthday,
             user.city,
             user.study,
             etap_user.time,
             etap_user.status,
             etap.name
             
             ')
            ->leftJoin('user', 'user.id = etap_user.idUser')
            ->leftJoin('etap', 'etap.id = etap_user.idEtap')
            ->where(['etap.idEvent' => $id])->asArray()
            ->all();


        $i = 2;
        $next = 0;
        foreach($etap as $part){
            $next = $i;

            $sheet->setCellValueByColumnAndRow(0, $next, $part['username']);
            $sheet->setCellValueByColumnAndRow(1, $next, $part['surname']);
            $sheet->setCellValueByColumnAndRow(2, $next, $part['telephone']);
            $sheet->setCellValueByColumnAndRow(3, $next, $part['t_shirt']);
            $sheet->setCellValueByColumnAndRow(4, $next, $part['sex']);
            $sheet->setCellValueByColumnAndRow(5, $next, $part['email']);
            $sheet->setCellValueByColumnAndRow(6, $next, $part['birthday']);
            $sheet->setCellValueByColumnAndRow(7, $next, $part['city']);
            $sheet->setCellValueByColumnAndRow(8, $next, $part['study']);
            $sheet->setCellValueByColumnAndRow(9, $next, $part['status']);
            $sheet->setCellValueByColumnAndRow(10, $next, $part['name']);
            $sheet->setCellValueByColumnAndRow(11, $next, $part['time']);

            $i++;
        };

        $objWriter = new PHPExcel_Writer_Excel5($xls);
        $objWriter->save(Yii::getAlias('@web').'event/'.$event->xls.'_etaps'.'.xls');

        return Yii::$app->response->sendFile('event/'.$event->xls.'_etaps'.'.xls');
        //return $this->render('download',['participation'=>$participation]);

    }*/
	
	public function actionStatistic($id)
	{
		$participation =Participation::find()
            ->select('ended_role')
            ->where(['participation.idEvent' => $id])
			->asArray()
            ->all();
		$general_count = count($participation);
		$participation =Participation::find()
            ->select('ended_role')
            ->where(['participation.idEvent' => $id,'participation.active'=>1])
			->asArray()
            ->all();
		$active_count = count($participation);
		$passive_count = $general_count - $active_count;
		$event = Event::find(['role'])->where(['id'=>$id])->one();
		$array_part = explode('/',$event->role);
		if (!in_array("", $array_part)) {
			array_push($array_part,'');
		}
		$count_role = [];
		foreach($array_part as $arr){
			$participation =Participation::find()
            ->select('ended_role')
            ->where(['participation.idEvent' => $id,'participation.ended_role'=>$arr,'participation.active'=>1])
			->asArray()
            ->all();
			$count_role[$arr]= count($participation);
		}
	
		$etapy =Etap::find()
            ->select('
             etap.name            
             ')
            ->where(['etap.idEvent' => $id])->asArray()
            ->all();
		$i=0;
		foreach($etapy as $arr){
			$etap =EtapUser::find()
				->leftJoin('etap', 'etap.id = etap_user.idEtap')
				->where(['etap.idEvent' => $id,'etap.name' => $arr])
				->asArray()
				->all();
			$general_count_etap[$i] = count($etap);
			$etap =EtapUser::find()
					->leftJoin('etap', 'etap.id = etap_user.idEtap')
					->where(['etap.idEvent' => $id,'etap_user.active'=> 1,'etap.name' => $arr])
					->asArray()
					->all();
			$active_count_etap[$i] = count($etap);
			$passive_count_etap[$i] = $general_count_etap[$i] - $active_count_etap[$i];
			$i++;
		}

		return $this->render('statistic',
		[
			'general_count'=>$general_count,
			'active_count'=>$active_count,
			'passive_count'=>$passive_count,
			'count_role'=>$count_role,
			'general_count_etap'=>$general_count_etap,
			'active_count_etap'=>$active_count_etap,
			'passive_count_etap'=>$passive_count_etap,
			'etapy'=>$etapy
		]);
	}
}
