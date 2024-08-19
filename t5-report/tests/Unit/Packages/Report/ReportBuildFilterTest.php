<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report;

use App\Packages\Report\ReportBuildFilter;
use Tests\TestCase;

class ReportBuildFilterTest extends TestCase
{
    private ReportBuildFilter $filter;

    public function setUp(): void
    {
        $this->filter = new ReportBuildFilter();
    }

    public function tearDown(): void
    {
        unset($this->filter);
    }

    public function testAscDesc(): void
    {
        $this->assertTrue($this->filter->isAsc());
        $this->assertFalse($this->filter->isDesc());

        $this->filter->desc();
        $this->assertFalse($this->filter->isAsc());
        $this->assertTrue($this->filter->isDesc());

        $this->filter->asc();
        $this->assertTrue($this->filter->isAsc());
        $this->assertFalse($this->filter->isDesc());
    }

    public function testAllowedNames(): void
    {
        $this->assertFalse($this->filter->hasAllowedNames());

        $this->filter->addAllowedName('John');

        $this->assertTrue($this->filter->hasAllowedNames());

        $this->assertTrue($this->filter->isNameInAllowedNames('John'));
        $this->assertFalse($this->filter->isNameInAllowedNames('NotJohn'));
    }

    public function testChainSyntax(): void
    {
        $this->assertInstanceOf(ReportBuildFilter::class, ReportBuildFilter::construct());
        $this->assertInstanceOf(ReportBuildFilter::class, $this->filter->asc());
        $this->assertInstanceOf(ReportBuildFilter::class, $this->filter->desc());
        $this->assertInstanceOf(ReportBuildFilter::class, $this->filter->addAllowedName(''));
    }
}
