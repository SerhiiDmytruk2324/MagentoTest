<?php

namespace Training\TestOM\Model;

class Test
{
    private $manager;
    private $arrayList;
    private $name;
    private $number;
    private $managerFactory;
    private $playWithTest;

    public function __construct(
        ManagerInterface $manager,
        $name,
        int $number,
        array $arrayList,
        ManagerInterfaceFactory $managerFactory,
        PlayWithTest $playWithTest
    ) {
        $this->manager = $manager;
        $this->name = $name;
        $this->number = $number;
        $this->arrayList = $arrayList;
        $this->managerFactory = $managerFactory;
        $this->playWithTest = $playWithTest;
    }
public function log()
    {
        print_r(get_class($this->manager));
        echo '<br>';
        print_r($this->name);
        echo '<br>';
        print_r($this->number);
        echo '<br>';
        print_r($this->arrayList);
        echo '<br>';
        $newManager = $this->managerFactory->create();
        print_r(get_class($newManager));
        echo '<br>';
        $playWithTest = $this->playWithTest->run();
        print_r($playWithTest);
    }
}
