<?php

namespace app\models\task;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property string $id
 * @property string $goods_id1
 * @property string $goods_id2
 * @property integer $status
 * @property integer $add_time
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_id1', 'goods_id2', 'status', 'add_time'], 'integer'],
            [['add_time'],'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goods_id1' => 'Goods Id1',
            'goods_id2' => 'Goods Id2',
            'status' => 'Status',
            'add_time' => 'Add Time',
        ];
    }



    public function process()
    {
        if($this->validate()) {
            $goods1 = Goods::findOne(['id'=>$this->goods_id1]);
            $goods1->status = 1;
            $goods1->save();
            $goods2 = Goods::findOne(['id'=>$this->goods_id2]);
            $goods2->status = 1;
            $goods2->save();

            $this->add_time = time();
            $this->status = 0;
            if($this->save()) {
                return true;
            }
        }
        return false;
    }
}
