<?php

namespace app\models\forms;

use app\models\UrlContainer;
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
            [['link'], 'url'],
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

    /**
     *
     * Create short url record in database, based by assigned id (short link is created by hash function).
     * @return UrlContainer|bool
     * @internal param $authKey
     */
    public function createRecord()
    {
        $record = new UrlContainer();
        $record->full_url = $this->link;
        try {
            if ($record->save()) {
                $record->short_url = substr(hash('sha256', $record->id), 0, 7);
                if (!$record->save()) {
                    Yii::error(
                        'Error on save: ' .
                        var_export([$record->attributes, $record->errors], true)
                    );
                    return false;
                }
            } else {
                Yii::error('Error on save: ' . var_export($record->errors, true));
                return false;
            }

            return $record;
        } catch (\Exception $e) {
            Yii::error('Error on save: ' . var_export([
                    $e->getMessage(),
                    $e->getTraceAsString(),
                    $e->getFile(),
                    $e->getLine()
                ], true));
            return false;
        }
    }

}
