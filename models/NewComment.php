<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 08.11.2017
 * Time: 16:46
 */

namespace app\models;


use yii\base\Model;

class NewComment extends Model
{
    public $content;
    public $idUser;
    public $idArticle;

    public function attributeLabels()
    {
        return [
            'idUser' => '',
            'idArticle' => '',
            'content'=>'Залишити коментарій',
            'date' => ''
        ];
    }
}