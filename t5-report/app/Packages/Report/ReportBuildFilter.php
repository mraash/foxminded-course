<?php

namespace App\Packages\Report;

/**
 * Class that contains folter options for Report::build() method.
 */
class ReportBuildFilter
{
    private bool $isAsc = true;
    /** @var string[] */
    private array $allowedNames = [];

    public static function construct(): self
    {
        return new self();
    }

    public function asc(): self
    {
        $this->isAsc = true;

        return $this;
    }

    public function desc(): self
    {
        $this->isAsc = false;

        return $this;
    }

    public function isAsc(): bool
    {
        return $this->isAsc;
    }

    public function isDesc(): bool
    {
        return !$this->isAsc;
    }

    public function addAllowedName(string $name): self
    {
        $this->allowedNames[] = $name;

        return $this;
    }

    public function hasAllowedNames(): bool
    {
        return count($this->allowedNames) > 0;
    }

    public function isNameInAllowedNames(string $name): bool
    {
        return in_array($name, $this->allowedNames);
    }
}
