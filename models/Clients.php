<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $c_name
 *
 * @property Post[] $posts
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_name'], 'required'],
            [['c_name'], 'string', 'max' => 200],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['r_user_id' => 'id']);
    }
}
