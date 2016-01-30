<?php

use yii\db\Schema;
use yii\db\Migration;

class m140403_174027_static_page extends Migration
{
	private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

	public function up()
	{
		$this->createTable( '{{%static_page}}', [
			'id'              => Schema::TYPE_PK,
			'title'           => Schema::TYPE_STRING . '(255) NOT NULL',
			'alias'           => Schema::TYPE_STRING . '(32) NOT NULL',
			'seo_title'       => Schema::TYPE_STRING . '(255)',
			'seo_description' => Schema::TYPE_STRING . '(255)',
			'seo_keywords'    => Schema::TYPE_STRING . '(255)',
			'content'         => Schema::TYPE_TEXT . '(20000)',
			'is_active'       => Schema::TYPE_INTEGER,
			'created_at'      => Schema::TYPE_INTEGER,
			'updated_at'      => Schema::TYPE_INTEGER,
		], $this->tableOptions );

		$this->createTable( '{{%static_page_lang}}', [
			'id'              => Schema::TYPE_PK,
			'static_page_id'  => Schema::TYPE_INTEGER . '(25) NOT NULL',
			'local'           => Schema::TYPE_STRING . '(10) NOT NULL',
			'title'           => Schema::TYPE_STRING . '(255) NOT NULL',
			'seo_title'       => Schema::TYPE_STRING . '(255)',
			'seo_description' => Schema::TYPE_STRING . '(255)',
			'seo_keywords'    => Schema::TYPE_STRING . '(255)',
			'content'         => Schema::TYPE_TEXT . '(20000) NOT NULL',
		], $this->tableOptions );

		$this->createIndex( 'FK_static_page_lang_local_index', '{{%static_page_lang}}', 'local' );
		$this->addForeignKey( 'FK_static_page_lang', '{{%static_page_lang}}', 'static_page_id', '{{%static_page}}',
			'id' );
		$this->addForeignKey( 'FK_static_page_lang_local', '{{%static_page_lang}}', 'local', '{{%lang}}', 'local' );
	}

	public function down()
	{
		$this->dropForeignKey( 'FK_static_page_lang', '{{%static_page_lang}}' );
		$this->dropForeignKey( 'FK_static_page_lang_local', '{{%static_page_lang}}' );
		$this->dropTable( '{{%static_page}}' );
	}
}
