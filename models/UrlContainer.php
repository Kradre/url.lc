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
            [['full_url', 'cookie_key'], 'required'],
            [['created_at'], 'integer'],
            [['short_url'], 'string', 'max' => 7],
            [['full_url', 'cookie_key'], 'string', 'max' => 255],
            [['cookie_key'], 'unique'],
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
            'cookie_key' => 'Cookie Key',
            'created_at' => 'Created At',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', false],
                    ActiveRecord::EVENT_BEFORE_UPDATE => false,
                ],
            ],
        ];
    }
}
