<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "transaction".
 *
 * @property string $id
 * @property string $currency  Currency code 3 chars
 * @property float $amount  Decimal amount of transaction
 * @property string $info  Some additional information about payment
 * @property int $type  See constants
 * @property int $status See constants
 * @property int $provider_type  See constanst PROVIDER_TYPE_*
 * @property int $created_at
 *
 * @property Event $event
 */
class Transaction extends ActiveRecord
{
    const TYPE_NOT_SET = 0;
    const TYPE_DONATE = 1;
    const TYPE_DONATE_TEAM = 2;

    const PROVIDER_TYPE_NOT_SET = 50;
    const PROVIDER_TYPE_PAYPAL = 51;
    const PROVIDER_TYPE_AUTHORIZE = 52;
    const PROVIDER_TYPE_STRIPE = 52;

    const STATUS_NOT_SET = 100;
    const STATUS_SUCCESS = 101;
    const STATUS_FAILED = 102;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['status', 'in', 'range' => [
                self::STATUS_SUCCESS,
                self::STATUS_FAILED,
            ]],

            ['provider_type', 'in', 'range' => [
                self::PROVIDER_TYPE_NOT_SET,
                self::PROVIDER_TYPE_PAYPAL,
                self::PROVIDER_TYPE_AUTHORIZE,
            ]],
            [['amount'], 'number'],
            [['info'], 'string'],
            [['currency'], 'string', 'max' => 3],

            //default values for not null fields
            [['amount'], 'default', 'value' => 0],
            ['currency', 'default', 'value' => 'USD'],
            ['info', 'default', 'value' => null],
            ['type', 'default', 'value' => self::TYPE_NOT_SET],
            ['status', 'default', 'value' => self::STATUS_NOT_SET],
            ['provider_type', 'default', 'value' => self::PROVIDER_TYPE_NOT_SET],
            [['event_id'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency' => 'Currency',
            'amount' => 'Amount',
            'info' => 'Info',
            'type' => 'Type',
            'provider_type' => 'Provider Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }


}
