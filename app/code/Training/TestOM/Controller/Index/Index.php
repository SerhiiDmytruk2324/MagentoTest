<?php

namespace Training\TestOM\Controller\Index;

use \Magento\Framework\App\Action\HttpGetActionInterface;
use \Magento\Framework\App\Action\HttpPostActionInterface;
use \App\code\Training\TestOM\Model\Test;

class Index implements HttpGetActionInterface, HttpPostActionInterface
{
    private $test;

    public function __construct(
        $test
    ) {
        $this->test = $test;
    }

    public function execute()
    {
        $this->test->log();
        exit();
    }
}
