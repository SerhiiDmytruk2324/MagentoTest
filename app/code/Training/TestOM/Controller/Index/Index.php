<?php

namespace Training\TestOM\Controller\Index;

class Index implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    private $test;

    public function __construct(
        \Training\TestOM\Model\Test $test
    ) {
        $this->test = $test;
    }

    public function execute()
    {
        $this->test->log();
        exit();
    }
}
