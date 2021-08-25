<?php
/**
 * Adds a Relationship between 2 Modules
 */

$Vtiger_Utils_Log = true;
include_once('vtlib/Vtiger/Module.php');

// MODIFY:
$pModuleName = 'Leads';
$cModuleName = 'Test';

$pModule = Vtiger_Module::getInstance($pModuleName);
$cModule = Vtiger_Module::getInstance($cModuleName);
if ($pModule && $cModule) {
    $pModule->setRelatedList($cModule);
    echo "SUCCESS";
}
else {
    echo "coun't find $pModuleName OR $cModuleName";
}

?>