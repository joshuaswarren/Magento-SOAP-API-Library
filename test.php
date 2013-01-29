<?php

require_once('magentoSoapApi.php');
ini_set('memory_limit', '256M');

$soapUrl = ''; // insert the URL of your site's API endpoint here
$soapUsername = ''; // insert a SOAP usnermae here
$soapPassword = ''; // insert a SOAP password here

$incrementId = ''; // insert an order increment ID here to test with.  

$api = new magentoSoapApi($soapUrl, $soapUsername, $soapPassword);
$filter = array('filter' => array(array('key' => 'status', 'value' => 'processing')));
//$result = $api->salesOrderList($filter);
$result = $api->salesOrderInfo($incrementId);
echo 'Result of call: '; 
var_dump($result);
echo "\n";
