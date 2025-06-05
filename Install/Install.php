<?php

namespace Apps\Fintech\Components\Mf\Transactions\Install;

use System\Base\BasePackage;
use System\Base\Providers\ModulesServiceProvider\MenuInstaller;

class Install extends BasePackage
{
    public function install()
    {
        return true;
    }

    public function uninstall()
    {
        return true;
    }
}