<?php
/**
 * Adds a profile picture field to a Leads
 */

$Vtiger_Utils_Log = true;
include_once('vtlib/Vtiger/Module.php');

// MODIFY:
$fieldName = 'Image';
$blockName = 'Privat';

$fieldLow = strtolower($fieldName);
$moduleInstance = Vtiger_Module::getInstance('Leads');
if ($moduleInstance) {
    $blockInstance = Vtiger_Block::getinstance($blockName,$moduleInstance);
    if ($blockInstance) {
        $fieldInstance = new Vtiger_Field();
        $fieldInstance->name = $fieldLow;
        $fieldInstance->table = "vtiger_leaddetails";
        $fieldInstance->column = $fieldLow ;
        $fieldInstance->columntype = "VARCHAR(100)";
        $fieldInstance->uitype = 69;
        $fieldInstance->typeofdata = "V~O";
        $fieldInstance->label = $fieldName;
        $blockInstance->addField($fieldInstance);
        echo "SUCCESS";
    }
    else {
        echo "No block with name: {$blockName} found in module: 'Leads'";
    }
}
else{
    echo "No module with name: 'Leads' found";
}

?>


