<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Exception;
use Symfony\Component\Console\Helper\FormatterHelper;
use App\Exceptions\UndefinedIdException;
use App\Packages\Report\Libs\TableView\ConsoleTableView;
use App\Packages\Report\Data\FileSystem\DataFileNames;
use App\Packages\Report\Data\DbRacerProvider;
use App\Packages\Report\ReportBuilder;
use App\Packages\Report\ReportBuildFilter;
use App\Packages\Report\ViewData\ReportToTableConverter;

class ReportCommand extends AbstractCommand
{
    /** @var string */
    protected $signature = 'app:report {--desc} {driver?}';

    /** @var string */
    protected $description = 'Command to view race report';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $driver = strval($this->input->getArgument('driver')) ?: null;
        $isDesc = boolval($this->input->getOption('desc'));

        try {
            $racers = (new DbRacerProvider())->provide();

            $filter = new ReportBuildFilter();
            $reportBuilder = new ReportBuilder($racers);

            if ($isDesc) {
                $filter->desc();
            }

            if ($driver) {
                try {
                    $reportBuilder->racerCollection()->findByName($driver);
                } catch (UndefinedIdException $err) {
                    throw new UndefinedIdException("There is no driver named \"$driver\"");
                }
                $filter->addAllowedName($driver);
            }

            $report = $reportBuilder->build($filter);
            $dataConverter = new ReportToTableConverter();
            $table = $driver ? $dataConverter->convertSingle($report) : $dataConverter->convert($report);

            $tableView = new ConsoleTableView($table);

            if ($filter->isAsc()) {
                $tableView->setSeparatorLine(15);
            } else {
                $tableView->setSeparatorLine(-15);
            }

            $view = $tableView->getView();
        } catch (Exception $err) {
            $this->writeErrorBlock($err->getMessage());
            return self::FAILURE;
        }

        $this->output->writeln($view);
        return self::SUCCESS;
    }
}
