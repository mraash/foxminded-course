<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report\Libs\TableView;

use Tests\TestCase;
use App\Packages\Report\Libs\TableView\ConsoleTableView;

class ConsoleTableViewTest extends TestCase
{
    public function testSimpleTable(): void
    {
        $tableView = new ConsoleTableView([
            ['Cell 1', 'Cell 2', 'Cell 3'],
            ['Cell 4', 'Cell 5', 'Cell 6'],
        ]);

        $view = $tableView->getView();

        $this->assertSame(
            'Cell 1 | Cell 2 | Cell 3' . PHP_EOL .
            'Cell 4 | Cell 5 | Cell 6',
            $view
        );
    }

    public function testTableWithDifferentWidthCells(): void
    {
        $tableView = new ConsoleTableView([
            ['Cell 111', 'Cell 2', 'Cell 333'],
            ['Cell 4', 'Cell 555', 'Cell 6'],
        ]);

        $view = $tableView->getView();

        $this->assertSame(
            'Cell 111 | Cell 2   | Cell 333' . PHP_EOL .
            'Cell 4   | Cell 555 | Cell 6  ',
            $view
        );
    }

    public function testTableWithDifferentNumberOfCells(): void
    {
        $tableView = new ConsoleTableView([
            ['Cell 1', 'Cell 2', 'Cell 3', 'Cell 4'],
            ['Cell 4'],
        ]);

        $view = $tableView->getView();

        $this->assertSame(
            'Cell 1 | Cell 2 | Cell 3 | Cell 4' . PHP_EOL .
            'Cell 4 |        |        |       ',
            $view
        );
    }

    public function testTableWithMixedValued(): void
    {
        $tableView = ConsoleTableView::fromMixedTable([
            [1, 1.1, null, true, false],
        ]);

        $view = $tableView->getView();

        $this->assertSame(
            '1 | 1.1 | null | true | false',
            $view
        );
    }

    public function testSeparatorLine(): void
    {
        $tableView = new ConsoleTableView([
            ['A', 'B', 'C'],
            ['A', 'B', 'C'],
        ]);

        $tableView->setSeparatorLine(1);
        $view = $tableView->getView();

        $this->assertSame(
            'A | B | C' . PHP_EOL .
            '---------' . PHP_EOL .
            'A | B | C',
            $view
        );
    }
}
