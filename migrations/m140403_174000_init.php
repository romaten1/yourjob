<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m140403_174025_init
 * Added tables Config, Lang, Student, Employer
 */
class m140403_174000_init extends Migration
{
    private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    public function up()
    {
        $this->createTable( '{{%config}}', [
            'name'        => Schema::TYPE_STRING . '(64) NOT NULL',
            'value'       => Schema::TYPE_STRING . '(255) NOT NULL',
            'description' => Schema::TYPE_STRING . '(255) NOT NULL',
            'PRIMARY KEY (name)'
        ], $this->tableOptions );

        $this->createIndex( 'FK_config_name', '{{%config}}', 'name' );

        $this->createTable( '{{%lang}}', [
            'id'         => Schema::TYPE_PK,
            'local'      => Schema::TYPE_STRING . '(10) NOT NULL',
            'name'       => Schema::TYPE_STRING . '(255) NOT NULL',
            'default'    => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'is_active'  => ' TINYINT NOT NULL DEFAULT 0',
        ], $this->tableOptions );

        $this->batchInsert( 'lang', [ 'local', 'name', 'default', 'updated_at', 'created_at', 'is_active' ], [
            [ 'uk_UA', 'Ukrainian', 1, time(), time(), 1 ],
            [ 'en_EN', 'English', 0, time(), time(), 0 ],
            [ 'ru_RU', 'Russian', 0, time(), time(), 1 ],
        ] );

        $this->createTable('{{%student}}', [
            'id'         => Schema::TYPE_PK,
            'user_id'    => Schema::TYPE_INTEGER,
            'description' => Schema::TYPE_TEXT  . '(1000)',
        ], $this->tableOptions);

        $this->createTable('{{%employer}}', [
            'id'         => Schema::TYPE_PK,
            'user_id'    => Schema::TYPE_INTEGER,
            'company'    => Schema::TYPE_STRING . '(255)',
            'city_id'    => Schema::TYPE_INTEGER,
            'position'   => Schema::TYPE_STRING . '(255)',
        ], $this->tableOptions);

        $this->createIndex( 'FK_lang_local_index', '{{%lang}}', 'local' );
        $this->addForeignKey('fk_user_student', '{{%student}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk_user_employer', '{{%employer}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey( 'fk_user_student', '{{%student}}' );
        $this->dropForeignKey( 'fk_user_employer', '{{%employer}}' );
        $this->dropTable('{{%config}}');
        $this->dropTable('{{%lang}}');
        $this->dropTable('{{%student}}');
        $this->dropTable('{{%employer}}');
    }
}
