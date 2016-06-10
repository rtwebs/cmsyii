<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $cid
 * @property string $c_name
 * @property string $c_slug
 * @property string $c_img
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['c_name', 'c_slug', 'c_img'], 'required'],
            [['c_name'], 'string', 'max' => 200],
            [['c_slug'], 'string', 'max' => 75],
            [['c_img'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => 'Cid',
            'c_name' => 'Nombre',
            'c_slug' => 'Slug',
            'c_img' => 'Url imagen',
        ];
    }
    
    public function getAllLeft(){
        
        $query = new \yii\db\Query();
        $query
            ->select(['categories.*', 'count(posts.post_id) as nposts'])
            ->from('categories')
            ->leftJoin('posts', '`posts`.`post_category` = `categories`.`cid`')
            ->where(['posts.post_status' => [1] ] );
            
        $cmd = $query->createCommand();
        $posts = $cmd->queryAll();
        
        return $posts;
    }
}
