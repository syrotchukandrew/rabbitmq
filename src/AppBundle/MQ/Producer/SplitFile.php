<?php

namespace AppBundle\MQ\Producer;

use League\Csv\Reader;
use League\Csv\Writer;

class SplitFile
{
    private $path;
    private $producer;

    public function __construct($path, $producer)
    {
        $this->path = $path;
        $this->producer = $producer;
    }

    public function process()
    {
        $csv = Reader::createFromPath($this->path);
        $result = $csv->fetchAll();
        foreach ($result as $item) {
            $this->producer->publish($item[0]);
        }
    }
}