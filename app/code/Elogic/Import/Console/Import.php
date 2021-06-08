<?php
namespace Elogic\Import\Console;

use Elogic\Import\Api\Service\ImportInterface;
use Elogic\Import\Service\GenericCSVImport;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Import
 */
class Import extends Command
{
    /**
     * @var array
     */
    private $importers;

    /**
     * Import constructor.
     * @param null $name
     * @param array $importers
     */
    public function __construct(
        $name = null,
        array $importers = []
    )
    {
        parent::__construct($name);
        $this->importers = $importers;
    }


    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('elogic:import');
        $this->setDescription('Elogic DI confoguration demo.');

        parent::configure();
    }

    /**
     * Execute the command
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->importers as $importer) {
            $result = $importer->execute();

            if ($result) {
                $output->writeln('<info>Imported!</info>');
            } else {
                $output->writeln('<error>Failed</error>');
            }
        }




//        $output->writeln('<info>Success Message.</info>');
//        $output->writeln('<error>An error encountered.</error>');
//        $output->writeln('<comment>Some Comment.</comment>');
    }
}