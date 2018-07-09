<?php

namespace app\models;

use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "resource".
 *
 * @property int $id
 * @property string $name
 * @property int $type_resource_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property TypeResource $typeResource
 */
class Background extends ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'resource';
    }

    public function behaviors(){
        return array_merge(
            parent::behaviors(),
            [
                TimestampBehavior::class,
                [
                    'class' => AttributeBehavior::class,
                    'preserveNonEmptyValues' => true,
                    'attributes' => [
                        ActiveRecord::EVENT_BEFORE_DELETE => 'name'
                    ],
                    'value' => function($event){
                        if(file_exists(Yii::getAlias('@webroot/upload/' . $this->name)))
                            unlink(Yii::getAlias('@webroot/upload/' . $this->name));

                        return null;
                    }
                ],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['name'], 'required'],
            [['type_resource_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['type_resource_id'], 'default', 'value' => TypeResource::TYPE_RESOURCE_IMAGE],
            [
                ['type_resource_id'], 'exist',
                'skipOnError' => true,
                'targetClass' => TypeResource::className(),
                'targetAttribute' => ['type_resource_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type_resource_id' => 'Type Resource ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeResource(){
        return $this->hasOne(TypeResource::className(), ['id' => 'type_resource_id']);
    }
}
