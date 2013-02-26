<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__) . DS . 'helper.php');
$document = & JFactory::getDocument();
$document->addStyleSheet(JURI::root() . 'modules\mod_currencies\css\currenciesTable.css', 'text/css');

//scripts
echo ' <script type="text/javascript" src="' . JURI::root() . 'modules/mod_currencies/js/jquery-1.9.0.js"></script>   ';
echo ' <script type="text/javascript" src="' . JURI::root() . 'modules/mod_currencies/js/banklist.js"></script>   ';


$modulBanks = new ModBankCurrences();
$XML = $modulBanks->getXMLList();
$best = $modulBanks->getBestCurrences($XML);



require(JModuleHelper::getLayoutPath('mod_currencies'));
