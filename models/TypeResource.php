<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "type_resource".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Resource[] $resources
 */
class TypeResource extends \yii\db\ActiveRecord{

    const TYPE_RESOURCE_FILE = 2;
    const TYPE_RESOURCE_IMAGE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'type_resource';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function behaviors(){
        return array_merge(parent::behaviors(), [TimestampBehavior::class]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles(){
        return $this->hasMany(File::className(), ['type_resource_id' => 'id'])
                    ->where([static::tableName() . '.id' => static::TYPE_RESOURCE_FILE]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages(){
        return $this->hasMany(Logo::className(), ['type_resource_id' => 'id'])
                    ->where([static::tableName() . '.id' => static::TYPE_RESOURCE_IMAGE]);
    }
}
