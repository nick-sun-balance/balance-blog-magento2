<?php
/**
 * Project: magento2
 * Author: Nick Sun
 * Email: nick@balanceinternet.com.au
 * Date: 5/01/16
 * Time: 11:44 AM
 */

namespace Balance\Blog\Console\Command;

use Magento\Framework\App\State as AppState;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class HelloWorldCommand extends Command
{
    const INPUT_KEY_EXTENDED = 'extended';

    /**
     * @var AppState
     */
    protected $appState;

    public function __construct(
        AppState $appState
    )
    {
        $this->appState = $appState;
        parent::__construct();
    }

    protected function configure()
    {
        $options = [
            new InputOption(
                self::INPUT_KEY_EXTENDED,
                null,
                InputOption::VALUE_OPTIONAL,
                'Get extended info'
            ),
        ];
        $this->setName('blog:helloworld:info')
            ->setDescription('This is a Hello World trial')
            ->setDefinition($options);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<error>' . 'writeln surrounded by error tag' . '</error>');
        $output->writeln('<comment>' . 'writeln surrounded by comment tag' . '</comment>');
        $output->writeln('<info>' . 'writeln surrounded by info tag' . '</info>');
        $output->writeln('<question>' . 'writeln surrounded by question tag' . '</question>');
        $output->writeln('writeln with normal output');

        if ($input->getOption(self::INPUT_KEY_EXTENDED)) {
            $output->writeln('');
            $output->writeln('<info>' . 'Extended parameter is given as '.$input->getOption(self::INPUT_KEY_EXTENDED). '</info>');
        }

        $output->writeln('');
    }
}
