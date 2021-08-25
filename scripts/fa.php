<?php
/**
 * Adds a Field to a Block of a Module of UI-Type 10
 * Usefull for a 1-m relationship
 */

$Vtiger_Utils_Log = true;
include_once('vtlib/Vtiger/Module.php');

// MODIFY:
$_1_m_moduleName = 'Leads';
$_m_1_moduleName = 'Test';
$blockName = 'Notizen';

$_1mLow = strtolower($_1_m_moduleName);
$_m1Low = strtolower($_m_1_moduleName);
$moduleInstance = Vtiger_Module::getInstance($_m_1_moduleName);
if ($moduleInstance) {
    $blockInstance = Vtiger_Block::getinstance($blockName,$moduleInstance);
    if ($blockInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = "RelateTo{$_1_m_moduleName}";
        $fieldInstance->table = "vtiger_{$_m1Low}";
        $fieldInstance->column = "realteto{$_1mLow}";
        $fieldInstance->columntype = "VARCHAR(100)";
        $fieldInstance->uitype = 10;
        $fieldInstance->typeofdata = "V~O";
        $fieldInstance->label = $_1_m_moduleName;

        $blockInstance->addField($fieldInstance);
        $fieldInstance->setRelatedModules(Array($_1_m_moduleName));
        echo "SUCCESS";
    }
    else {
        echo "No block with name: {$blockName} found in module: {$_m_1_moduleName}";
    }
}
else{
    echo "No module with name: {$_m_1_moduleName} found";
}

?>