<?php

namespace app\modules\admin\modules\rbac;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\modules\rbac\controllers';

    public $layout = 'main.php';

    public $defaultRoute = 'auth-assignment';

    public function init()
    {
        parent::init();
        //Задаємо шлях до шаблона субмодуля - в модулі Адмінки
        $this->setLayoutPath( '@app/modules/admin/views/layouts');
        // custom initialization code goes here
    }
}
