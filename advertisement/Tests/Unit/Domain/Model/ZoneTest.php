<?php
declare(strict_types=1);

namespace Slavlee\Advertisement\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Kevin Chileong Lee <support@slavlee.de>
 */
class ZoneTest extends UnitTestCase
{
    /**
     * @var \Slavlee\Advertisement\Domain\Model\Zone|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Slavlee\Advertisement\Domain\Model\Zone::class,
            ['dummy']
        );
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName(): void
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('name'));
    }

    /**
     * @test
     */
    public function getHeightReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getHeight()
        );
    }

    /**
     * @test
     */
    public function setHeightForStringSetsHeight(): void
    {
        $this->subject->setHeight('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('height'));
    }

    /**
     * @test
     */
    public function getWidthReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getWidth()
        );
    }

    /**
     * @test
     */
    public function setWidthForStringSetsWidth(): void
    {
        $this->subject->setWidth('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('width'));
    }
}
