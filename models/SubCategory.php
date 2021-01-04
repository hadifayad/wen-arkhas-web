<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sub_category".
 *
 * @property int $id
 * @property string $c_name
 * @property int $r_cat_id
 *
 * @property Post[] $posts
 * @property Category $rCat
 */
class SubCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sub_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_name', 'r_cat_id'], 'required'],
            [['r_cat_id'], 'integer'],
            [['c_name'], 'string', 'max' => 200],
            [['r_cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['r_cat_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'c_name' => Yii::t('app', 'C Name'),
            'r_cat_id' => Yii::t('app', 'R Cat ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['r_sub_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'r_cat_id']);
    }
}
