<?php

use yii\db\Schema;
use yii\db\Migration;

class m140403_174028_contacts extends Migration
{
	private $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

	public function up()
	{
		$this->createTable( '{{%contacts}}', [
			'id'         => Schema::TYPE_PK,
			'name'       => Schema::TYPE_STRING . '(32) NOT NULL',
			'email'      => Schema::TYPE_STRING . '(255) NOT NULL',
			'subject'    => Schema::TYPE_STRING . '(255) NOT NULL',
			'body'       => Schema::TYPE_TEXT . '(5000) NOT NULL',
			'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
		], $this->tableOptions );
	}

	public function down()
	{
		$this->dropTable( '{{%contacts}}' );
	}

}
