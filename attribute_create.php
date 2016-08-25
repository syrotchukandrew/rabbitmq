<?php

$mage_url = 'http://52.28.243.203/api/v2_soap?wsdl=1';
$mage_user = 'AkeneoSoap';
$mage_api_key = 'zaraffa1991';
$client = new SoapClient($mage_url);
$session = $client->login($mage_user, $mage_api_key);

$data = array(
    "attribute_code" => "andrew_attribute_2",
    "frontend_input" => "select",
    "scope" => "global",
    "default_value" => "1",
    "is_unique" => 0,
    "is_required" => 0,
    "apply_to" => array("configurable"),
    "is_configurable" => 1,
    "is_searchable" => 0,
    "is_visible_in_advanced_search" => 0,
    "is_comparable" => 0,
    "is_used_for_promo_rules" => 0,
    "is_visible_on_front" => 0,
    "used_in_product_listing" => 0,
    "additional_fields" => array(),
    "frontend_label" => array(array("store_id" => "0", "label" => "some label")),

    'group' => "General",
    'visible_in_advanced_search' => true,
    'visible_on_front' => true,
    'visible' => true,
    'user_defined' => true,
    'global' => 1,
);
$orders = $client->catalogProductAttributeCreate($session, $data);

echo 'Number of results: ' . count($orders) . '<br/>';

var_dump ($orders);

$client->endSession($session);
