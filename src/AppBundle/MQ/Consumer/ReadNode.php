<?php

namespace AppBundle\MQ\Consumer;


use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class ReadNode implements ConsumerInterface
{
    private $logger;
    private $mage_url;
    private $mage_user;
    private $mage_api_key;

    public function __construct(LoggerInterface $logger, $mage_url, $mage_user, $mage_api_key)
    {
        $this->logger = $logger;
        $this->mage_url = $mage_url;
        $this->mage_user = $mage_user;
        $this->mage_api_key = $mage_api_key;
    }

    public function execute(AMQPMessage $msg)
    {
        $client = new \SoapClient($this->mage_url);
        $session = $client->login($this->mage_user, $this->mage_api_key);

        $data = array(
            "attribute_code" => $msg->body,
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

        echo 'Number of results: ' . count($orders) . "\n";

        var_dump ($orders);

        $client->endSession($session);
    }
}