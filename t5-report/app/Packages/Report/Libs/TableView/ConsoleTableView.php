<?php

declare(strict_types=1);

namespace App\Packages\Report\Libs\TableView;

use App\Exceptions\InvalidReturnException;

class ConsoleTableView
{
    private const CELL_SEPARATOR = ' | ';

    /** @var array<array<string>> */
    private array $table;

    private int $numberOfRows;
    private int $numberOfColumns;

    /** @var array<int> */
    private array $columnWidths;
    private int $tableWidth;

    private int $separatorLine;

    /**
     * @param array<array<string>> $table
     */
    public function __construct(array $table)
    {
        $this->numberOfRows    = self::getNumberOfRows($table);
        $this->numberOfColumns = self::getNumberOfColumns($table);
        $this->table           = self::fillEmptyTableCells($table, $this->numberOfColumns);
        $this->columnWidths    = self::getColumnWidths($this->table, $this->numberOfColumns);
        $this->tableWidth      = self::getTableWidth($this->columnWidths, self::CELL_SEPARATOR);
    }

    /**
     * Construct from table that contains mixed tyep cells
     *
     * @param array<array<string|int|float|bool|null>> $table
     */
    public static function fromMixedTable(array $table): self
    {
        $stringTable = [];

        foreach ($table as $ri => $row) {
            $stringTable[] = [];

            foreach ($row as $ci => $cell) {
                $stringTable[$ri][$ci] = self::toStringValue($cell);
            }
        }

        return new self($stringTable);
    }

    public function setSeparatorLine(int $separatorLine): self
    {
        $this->separatorLine = $separatorLine >= 0 ? $separatorLine : $this->numberOfRows - abs($separatorLine);

        return $this;
    }

    /**
     * Main method.
     */
    public function getView(): string
    {
        $view = '';

        foreach ($this->table as $rowIndex => $row) {
            foreach ($row as $cellIndex => $cell) {
                $cellView = $cell;

                if (mb_strlen($cellView) < $this->columnWidths[$cellIndex]) {
                    $difference = $this->columnWidths[$cellIndex] - mb_strlen($cellView);
                    $cellView .= str_repeat(' ', $difference);
                }

                $view .= $cellView;

                if ($cellIndex + 1 < $this->numberOfColumns) {
                    $view .= self::CELL_SEPARATOR;
                }
            }

            if ($rowIndex + 1 < $this->numberOfRows) {
                $view .= PHP_EOL;
            }

            if (isset($this->separatorLine) && $rowIndex + 1 === $this->separatorLine) {
                $view .= str_repeat('-', $this->tableWidth) . PHP_EOL;
            }
        }

        return $view;
    }

    /**
     * Get tables with the same number of cells in each row.
     *
     * If there are not enough cells in row, add emty string to that row.
     *
     * @param array<array<string>> $table
     *
     * @return array<array<string>>
     */
    private static function fillEmptyTableCells(array $table, int $numberOfColumns): array
    {
        $result = [];

        foreach ($table as $row) {
            if (count($row) < $numberOfColumns) {
                $missingCells = $numberOfColumns - count($row);

                for ($i = 0; $i < $missingCells; $i++) {
                    $row[] = '';
                }
            }

            $result[] = $row;
        }

        return $result;
    }

    /**
     * Get the longest cell of each column.
     *
     * @param array<array<string>> $table
     *
     * @return array<int>  An array where index is column and its value is its width.
     */
    private static function getColumnWidths(array $table, int $numberOfColumns): array
    {
        $widths = [];

        for ($i = 0; $i < $numberOfColumns; $i++) {
            $widths[] = 0;
        }

        foreach ($table as $row) {
            foreach ($row as $i => $cell) {
                if ($widths[$i] < mb_strlen($cell)) {
                    $widths[$i] = mb_strlen($cell);
                }
            }
        }

        return $widths;
    }

    /**
     * Get number of $table rows.
     *
     * @param array<array<string>> $table
     */
    private static function getNumberOfRows(array $table): int
    {
        return count($table);
    }

    /**
     * Get number of $table columns.
     *
     * @param array<array<string>> $table
     */
    private static function getNumberOfColumns(array $table): int
    {
        $maxCells = 0;

        foreach ($table as $row) {
            if (count($row) > $maxCells) {
                $maxCells = count($row);
            }
        }

        return $maxCells;
    }

    /**
     * @param array<int> $columnWidths
     */
    private static function getTableWidth(array $columnWidths, string $cellSeparator): int
    {
        $result = 0;

        foreach ($columnWidths as $i => $width) {
            $result += $width;

            if ($i < count($columnWidths) - 1) {
                $result += mb_strlen($cellSeparator);
            }
        }

        return $result;
    }

    /**
     * Convert primitive to string value.
     */
    private static function toStringValue(string|int|float|bool|null $value): string
    {
        $str = json_encode($value);

        if (!is_string($str)) {
            throw new InvalidReturnException();
        }

        return $str;
    }
}
