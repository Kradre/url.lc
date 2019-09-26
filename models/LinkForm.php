<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LinkForm is the model behind the link form on main page
 */
class LinkForm extends Model
{
    public $link;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['link'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'link' => 'URL to shorten up',
        ];
    }

    public function createRecord()
    {

    }

}
