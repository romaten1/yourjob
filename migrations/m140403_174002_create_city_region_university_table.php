<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m140403_174025_init
 * Added tables City, Region, University, UniversityLang, CityLang and RegionLang
 */
class m140403_174002_create_city_region_university_table extends Migration
{
    private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

    public function up()
    {
        $this->createTable('{{%university}}', [
            'id'         => Schema::TYPE_PK,
            'title'    => Schema::TYPE_STRING . '(255)',
            'city_id'    => Schema::TYPE_INTEGER,
            'description' => Schema::TYPE_TEXT  . '(1000)',
        ], $this->tableOptions);

        $this->createTable( '{{%university_lang}}', [
            'id'       => Schema::TYPE_PK,
            'university_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'local'    => Schema::TYPE_STRING . '(10) NOT NULL',
            'title'    => Schema::TYPE_STRING . '(32) NOT NULL',
        ], $this->tableOptions );

        $this->createTable('{{%city}}', [
            'id'         => Schema::TYPE_PK,
            'title'    => Schema::TYPE_STRING . '(255)',
            'region_id'    => Schema::TYPE_INTEGER,
        ], $this->tableOptions);

        $this->createTable( '{{%city_lang}}', [
            'id'       => Schema::TYPE_PK,
            'city_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'local'    => Schema::TYPE_STRING . '(10) NOT NULL',
            'title'    => Schema::TYPE_STRING . '(32) NOT NULL',
        ], $this->tableOptions );

        $this->createTable('{{%region}}', [
            'id'         => Schema::TYPE_PK,
            'title'    => Schema::TYPE_STRING . '(255)',
        ], $this->tableOptions);

        $this->createTable( '{{%region_lang}}', [
            'id'       => Schema::TYPE_PK,
            'region_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'local'    => Schema::TYPE_STRING . '(10) NOT NULL',
            'title'    => Schema::TYPE_STRING . '(32) NOT NULL',
        ], $this->tableOptions );

        $this->createIndex( 'FK_university_lang_local_index', '{{%university_lang}}', 'local' );
        $this->createIndex( 'FK_city_lang_local_index', '{{%city_lang}}', 'local' );
        $this->createIndex( 'FK_region_lang_local_index', '{{%region_lang}}', 'local' );
        $this->addForeignKey( 'FK_university_lang', '{{%university_lang}}', 'university_id', '{{%university}}', 'id' );
        $this->addForeignKey( 'FK_city_lang', '{{%city_lang}}', 'city_id', '{{%city}}', 'id' );
        $this->addForeignKey( 'FK_region_lang', '{{%region_lang}}', 'region_id', '{{%region}}', 'id' );
        $this->addForeignKey( 'FK_university_lang_local', '{{%university_lang}}', 'local', '{{%lang}}', 'local' );
        $this->addForeignKey( 'FK_city_lang_local', '{{%city_lang}}', 'local', '{{%lang}}', 'local' );
        $this->addForeignKey( 'FK_region_lang_local', '{{%region_lang}}', 'local', '{{%lang}}', 'local' );
    }

    public function down()
    {
        $this->dropForeignKey( 'FK_university_lang', '{{%university_lang}}' );
        $this->dropForeignKey( 'FK_city_lang', '{{%city_lang}}' );
        $this->dropForeignKey( 'FK_region_lang', '{{%region_lang}}' );
        $this->dropForeignKey( 'FK_university_lang_local', '{{%university_lang}}' );
        $this->dropForeignKey( 'FK_city_lang_local', '{{%city_lang}}' );
        $this->dropForeignKey( 'FK_region_lang_local', '{{%region_lang}}' );
        $this->dropTable('{{%university}}');
        $this->dropTable('{{%university_lang}}');
        $this->dropTable('{{%city}}');
        $this->dropTable('{{%city_lang}}');
        $this->dropTable('{{%region}}');
        $this->dropTable('{{%region_lang}}');
    }
}
