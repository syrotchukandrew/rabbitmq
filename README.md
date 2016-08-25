1.Install RabbitMQ: sudo apt-get install rabbitmq-server.
2.Enable UI: sudo rabbitmq-plugins enable rabbitmq_management. After that go to http://localhost:15672
3.Command for RabbitMQ:
    sudo rabbitmqctl status
    sudo service rabbitmq-server restart
4.Install this project:
    There are some parameters you need take from Magento application
    mage_url:          ~    url SOAP API
    mage_user:         ~    user Magento in proper group
    mage_api_key:      ~    api key for SOAP API Magento
5.Run consumer: app/console rabbitmq:consumer -w read_node
6.Run producer: app/console reader:read-file

