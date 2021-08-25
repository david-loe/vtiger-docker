<?php
/**
 * Deletes a module from vtigercrm and all its data
 */

$Vtiger_Utils_Log = true;
include_once 'vtlib/Vtiger/Module.php';

// MODIFY:
$moduleName = 'Test';

$module = Vtiger_Module::getInstance($moduleName);
if ($module){
    rrmdir("modules/{$moduleName}");
    rrmdir("layouts/vlayout/modules/{$moduleName}");
    rrmdir("cron/{$moduleName}");
    unlink("languages/en_us/{$moduleName}.php");
    $module->delete();
    echo "SUCCESS";
} else {
    echo "No module with name: {$moduleName} found";
}


function rrmdir($dir) { 
    if (is_dir($dir)) { 
      $objects = scandir($dir);
      foreach ($objects as $object) { 
        if ($object != "." && $object != "..") { 
          if (is_dir($dir. DIRECTORY_SEPARATOR .$object) && !is_link($dir."/".$object))
            rrmdir($dir. DIRECTORY_SEPARATOR .$object);
          else
            unlink($dir. DIRECTORY_SEPARATOR .$object); 
        } 
      }
      rmdir($dir); 
    } 
  }

?>