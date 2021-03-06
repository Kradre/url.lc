<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "url_container".
 *
 * @property int $id
 * @property string $short_url
 * @property string $full_url
 * @property string $cookie_key
 * @property int $created_at
 */
class UrlContainer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'url_container';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['full_url'], 'required'],
            [['created_at'], 'integer'],
            [['short_url'], 'string', 'max' => 7],
            [['full_url'], 'string', 'max' => 500],
            [['short_url'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'short_url' => 'Short Url',
            'full_url' => 'Full Url',
            'created_at' => 'Created At',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', false],
                    ActiveRecord::EVENT_BEFORE_UPDATE => false,
                ],
            ],
        ];
    }
}
