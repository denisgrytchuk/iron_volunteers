<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 04.11.2017
 * Time: 20:24
 */

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;


class AppAdminController extends Controller
{
    public function behaviors()
    {
        return ['access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }
}