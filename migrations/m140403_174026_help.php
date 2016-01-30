<?php

use yii\db\Schema;
use yii\db\Migration;

class m140403_174026_help extends Migration
{
	private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

	public function up()
	{
		$this->createTable( '{{%help}}', [
			'id'         => Schema::TYPE_PK,
			'title'      => Schema::TYPE_STRING . '(255) NOT NULL',
			'text'       => Schema::TYPE_TEXT . '(20000) NOT NULL',
			'is_active'  => Schema::TYPE_INTEGER,
			'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
			'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
		], $this->tableOptions );

		$this->createTable( '{{%help_lang}}', [
			'id'      => Schema::TYPE_PK,
			'help_id' => Schema::TYPE_INTEGER . '(25) NOT NULL',
			'local'   => Schema::TYPE_STRING . '(10) NOT NULL',
			'title'   => Schema::TYPE_STRING . '(255) NOT NULL',
			'text'    => Schema::TYPE_TEXT . '(20000) NOT NULL',
		], $this->tableOptions );

		$this->createIndex( 'FK_help_lang_local_index', '{{%help_lang}}', 'local' );
		$this->addForeignKey( 'FK_help_lang', '{{%help_lang}}', 'help_id', '{{%help}}', 'id' );
		$this->addForeignKey( 'FK_help_lang_local', '{{%help_lang}}', 'local', '{{%lang}}', 'local' );
	}

	public function down()
	{
		$this->dropForeignKey( 'FK_help_lang', '{{%help_lang}}' );
		$this->dropForeignKey( 'FK_help_lang_local', '{{%help_lang}}' );
		$this->dropTable( '{{%help}}' );
	}
}
