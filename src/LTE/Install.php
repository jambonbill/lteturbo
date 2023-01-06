<?php

namespace LTE;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

/**
 * Install/Setup jambonbill/lteturbo
 * https://getcomposer.org/doc/articles/scripts.md#what-is-a-script-
 */
class Install
{
    

    public static function postUpdate(Event $event)
    {
        $composer = $event->getComposer();
        // do stuff
        echo "this is Install::postUpdate()";
    }

    public static function postAutoloadDump(Event $event)
    {
        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        require $vendorDir . '/autoload.php';

        some_function_from_an_autoloaded_file();
    }

    public static function postPackageInstall(PackageEvent $event)
    {
        $installedPackage = $event->getOperation()->getPackage();
        // do stuff
        echo "doing jambon stuff.";
        //make sure we have the config/adminlte folder ready
        //copy json files into it 
    }

    public static function warmCache(Event $event)
    {
        // make cache toasty
    }
}