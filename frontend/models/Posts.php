<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $post_id
 * @property string $post_title
 * @property string $post_content
 * @property integer $post_status
 * @property integer $post_author
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_title', 'post_content', 'post_author'], 'required'],
            [['post_content'], 'string'],
            [['post_status', 'post_author'], 'integer'],
            [['post_title'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'post_id' => 'Post ID',
            'post_title' => 'Titulo',
            'post_content' => 'Contenido',
            'post_status' => 'Estado',
            'post_author' => 'Post Author',
        ];
    }
    
    

    
    public function getAllLeft(){
        
        $query = new \yii\db\Query();
        $query
            ->select(['posts.*','user.username', 'user.id as puid',  'profile.name AS pname'])
            ->from('posts')
            ->leftJoin('user', '`user`.`id` = `posts`.`post_author`')
            ->leftJoin('profile', '`profile`.`user_id` = `posts`.`post_author`')
            ->where(['posts.post_status' => [1] ] )
            ->orderBy(['post_id' => SORT_DESC]);
            
        $cmd = $query->createCommand();
        $posts = $cmd->queryAll();
        
        return $posts;
    }
}
