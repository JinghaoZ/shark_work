<?php

namespace app\models\task;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property string $id
 * @property string $goods_name
 * @property string $goods_type
 * @property string $username
 * @property string $goods_desc
 * @property string $add_time
 * @property string $logo
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['add_time'], 'integer'],
            [['goods_name'], 'string', 'max' => 32],
            [['goods_name'], 'required'],
            [['goods_type'], 'string', 'max' => 10],
            [['username'], 'string', 'max' => 16],
            [['goods_desc'], 'string', 'max' => 256],
            [['add_time'],'safe'],
            [['logo'],'required'],
            [['logo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_name' => 'Goods Name',
            'goods_type' => 'Goods Type',
            'username' => 'Username',
            'goods_desc' => 'Location',
            'add_time' => 'Add Time',
            'logo' => 'Image',
        ];
    }


}
