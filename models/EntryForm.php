<?php

namespace app\models;

use Yii;
use yii\base\Model;

class EntryForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }

     /** 
     * {@inheritdoc} 
     */ 
    public function attributeLabels() 
    { 
        return [ 
            'name' => 'Your Name', 
            'email' => 'Your Email', 
        ]; 
    } 
}