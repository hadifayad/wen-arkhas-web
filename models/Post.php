<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $r_sub_category_id
 * @property int $r_user_id
 * @property string $c_shop_name
 * @property string $c_shop_place
 * @property int $c_price
 * @property int $c_duration
 *
 * @property SubCategory $rSubCategory
 * @property User $rUser
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['r_sub_category_id', 'r_user_id', 'c_shop_name', 'c_shop_place', 'c_price', 'c_duration'], 'required'],
            [['r_sub_category_id', 'r_user_id', 'c_price', 'c_duration'], 'integer'],
            [['c_shop_name', 'c_shop_place'], 'string', 'max' => 200],
            [['r_sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubCategory::className(), 'targetAttribute' => ['r_sub_category_id' => 'id']],
            [['r_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['r_user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'r_sub_category_id' => Yii::t('app', 'R Sub Category ID'),
            'r_user_id' => Yii::t('app', 'R User ID'),
            'c_shop_name' => Yii::t('app', 'C Shop Name'),
            'c_shop_place' => Yii::t('app', 'C Shop Place'),
            'c_price' => Yii::t('app', 'C Price'),
            'c_duration' => Yii::t('app', 'C Duration'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRSubCategory()
    {
        return $this->hasOne(SubCategory::className(), ['id' => 'r_sub_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRUser()
    {
        return $this->hasOne(User::className(), ['id' => 'r_user_id']);
    }
}
