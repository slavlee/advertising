<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Tests\Unit\Domain\Model;

use PHPUnit\Framework\MockObject\MockObject;
use TYPO3\TestingFramework\Core\AccessibleObjectInterface;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * Test case
 *
 * @author Kevin Chileong Lee <support@slavlee.de>
 */
class BannerTest extends UnitTestCase
{
    /**
     * @var \Slavlee\Advertising\Domain\Model\Banner|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Slavlee\Advertising\Domain\Model\Banner::class,
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
    public function getDescriptionReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionForStringSetsDescription(): void
    {
        $this->subject->setDescription('Conceived at T3CON10');

        self::assertEquals('Conceived at T3CON10', $this->subject->_get('description'));
    }

    /**
     * @test
     */
    public function getCustomerReturnsInitialValueForCustomer(): void
    {
        self::assertEquals(
            null,
            $this->subject->getCustomer()
        );
    }

    /**
     * @test
     */
    public function setCustomerForCustomerSetsCustomer(): void
    {
        $customerFixture = new \Slavlee\Advertising\Domain\Model\Customer();
        $this->subject->setCustomer($customerFixture);

        self::assertEquals($customerFixture, $this->subject->_get('customer'));
    }

    /**
     * @test
     */
    public function getZonesReturnsInitialValueForZone(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getZones()
        );
    }

    /**
     * @test
     */
    public function setZonesForObjectStorageContainingZoneSetsZones(): void
    {
        $zone = new \Slavlee\Advertising\Domain\Model\Zone();
        $objectStorageHoldingExactlyOneZones = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneZones->attach($zone);
        $this->subject->setZones($objectStorageHoldingExactlyOneZones);

        self::assertEquals($objectStorageHoldingExactlyOneZones, $this->subject->_get('zones'));
    }

    /**
     * @test
     */
    public function addZoneToObjectStorageHoldingZones(): void
    {
        $zone = new \Slavlee\Advertising\Domain\Model\Zone();
        $zonesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $zonesObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($zone));
        $this->subject->_set('zones', $zonesObjectStorageMock);

        $this->subject->addZone($zone);
    }

    /**
     * @test
     */
    public function removeZoneFromObjectStorageHoldingZones(): void
    {
        $zone = new \Slavlee\Advertising\Domain\Model\Zone();
        $zonesObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $zonesObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($zone));
        $this->subject->_set('zones', $zonesObjectStorageMock);

        $this->subject->removeZone($zone);
    }
}
