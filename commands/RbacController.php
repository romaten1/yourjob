<?php
namespace app\commands;

use dektrium\user\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\console\Controller;
use yii\rbac\DbManager;

/**
 * Class RbacController
 * @package app\commands
 */
class RbacController extends Controller
{
	public function actionInit()
    {
        if (!$this->confirm("Are you sure? It will re-create permissions tree.")) {
            return self::EXIT_CODE_NORMAL;
        }

        //$auth = Yii::$app->authManager;
	    // Підключення через Базу даних
	    $auth = new DbManager;
	    $auth->init();
        $auth->removeAll();

	    // Роль студент
	    $student = $auth->createRole('student');
	    $student->description = 'Student';
	    $auth->add($student);

		// Роль працедавець
		$employer = $auth->createRole('employer');
		$employer->description = 'Employer';
		$auth->add($employer);

        // Роль модератор
	    $moderator = $auth->createRole('moderator');
        $moderator->description = 'Moderator';
        $auth->add($moderator);
	    $auth->addChild($moderator, $student);
		$auth->addChild($moderator, $employer);

		// Роль адміністратор
        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $auth->add($admin);
        $auth->addChild($admin, $moderator);
    }

    public function actionAssign($role, $userId)
    {
        $user = User::findOne($userId);
        if (!$user) {
            throw new InvalidParamException('There is no such user.');
        }

        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role);
        if (!$role) {
            throw new InvalidParamException('There is no such role.');
        }

        $auth->assign($role, $userId);
    }
}