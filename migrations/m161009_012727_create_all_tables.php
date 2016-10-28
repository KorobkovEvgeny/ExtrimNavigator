<?php

use yii\db\Migration;

class m161009_012727_create_all_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'userlogin' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32),
            'password_hash' => $this->string()->notNull(),
            'email' => $this->string()->notNull()->unique(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx-user-userlogin', '{{%users}}', 'userlogin');
        $this->createIndex('idx-user-email', '{{%users}}', 'email');

        $this->createTable('{{%categories}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(80)->unique()->notNull(),
            'name_category' => $this->string(80)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createTable('{{%cities}}',[
            'id'=>$this->primaryKey(),
            'city'=>$this->string(50)->notNull()->unique(),
            'name_city'=>$this->string(50)->notNull(),
        ], $tableOptions);


        $this->createTable('{{%places}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(70)->notNull(),
            'description' => $this->text()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'coordinates' => $this->string(255)->notNull(),
            'rating' => $this->integer(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_place_users','{{%places}}','author_id');
        $this->createIndex('idx_place_category','{{%places}}','category_id');
        $this->createIndex('idx_place_city','{{%places}}','city_id');
        $this->addForeignKey('fk_place_users','{{%places}}','author_id','{{%users}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk_place_category','{{%places}}','category_id','{{%categories}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk_place_city','{{%places}}','city_id','{{%cities}}','id','CASCADE','CASCADE');

        $this->createTable('{{%comments}}',[
            'id' => $this->primaryKey(),
            'place_id' => $this->integer()->notNull(),
            'comment' => $this->text()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_comments_place','{{%comments}}','place_id');
        $this->createIndex('idx_comments_users','{{%comments}}','author_id');
        $this->addForeignKey('fk_comments_place','{{%comments}}','place_id','{{%places}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk_comments_users','{{%comments}}','author_id','{{%users}}','id','CASCADE','CASCADE');

        $this->createTable('{{%place_rating}}',[
            'id' => $this->primaryKey(),
            'user_id' =>$this->integer()->notNull()->unique(),
            'place_id' =>$this->integer()->notNull()->unique(),
            'rating_id' =>$this->integer()->notNull()
        ], $tableOptions);

        $this->createIndex('idx_place_rating_place','{{%place_rating}}','place_id');
        $this->addForeignKey('fk_place_rating_place','{{%place_rating}}','place_id','{{%places}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk_place_rating_users','{{%place_rating}}','user_id','{{%users}}','id','CASCADE','CASCADE');

        $this->createTable('{{%photos}}',[
            'id'=>$this->primaryKey(),
            'place_id'=>$this->integer()->notNull(),
            'filename'=>$this->string(255),
            'alias'=>$this->string(255),
        ], $tableOptions);

        $this->createIndex('idx_photo_place','{{%photos}}','place_id');
        $this->addForeignKey('fk_photo_place','{{%photos}}','place_id','{{%places}}','id','CASCADE','CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%place_rating}}');
        $this->dropTable('{{%photos}}');
        $this->dropTable('{{%comments}}');
        $this->dropTable('{{%places}}');
        $this->dropTable('{{%cities}}');
        $this->dropTable('{{%categories}}');
        $this->dropTable('{{%users}}');
    }
}
