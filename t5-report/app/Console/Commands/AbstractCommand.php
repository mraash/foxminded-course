<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Symfony\Component\Console\Helper\FormatterHelper;
use Illuminate\Console\Command;

abstract class AbstractCommand extends Command
{
    protected function writeErrorBlock(string $message): void
    {
        /** @var FormatterHelper */
        $formatter = $this->getHelper('formatter');
        $formatterMessage = $formatter->formatBlock($message, 'error', true);

        $this->output->writeln('');
        $this->output->writeln($formatterMessage);
    }
}
