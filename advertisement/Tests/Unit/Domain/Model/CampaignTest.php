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
class CampaignTest extends UnitTestCase
{
    /**
     * @var \Slavlee\Advertisement\Domain\Model\Campaign|MockObject|AccessibleObjectInterface
     */
    protected $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getAccessibleMock(
            \Slavlee\Advertisement\Domain\Model\Campaign::class,
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
    public function getBannersReturnsInitialValueForBanner(): void
    {
        $newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        self::assertEquals(
            $newObjectStorage,
            $this->subject->getBanners()
        );
    }

    /**
     * @test
     */
    public function setBannersForObjectStorageContainingBannerSetsBanners(): void
    {
        $banner = new \Slavlee\Advertisement\Domain\Model\Banner();
        $objectStorageHoldingExactlyOneBanners = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $objectStorageHoldingExactlyOneBanners->attach($banner);
        $this->subject->setBanners($objectStorageHoldingExactlyOneBanners);

        self::assertEquals($objectStorageHoldingExactlyOneBanners, $this->subject->_get('banners'));
    }

    /**
     * @test
     */
    public function addBannerToObjectStorageHoldingBanners(): void
    {
        $banner = new \Slavlee\Advertisement\Domain\Model\Banner();
        $bannersObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['attach'])
            ->disableOriginalConstructor()
            ->getMock();

        $bannersObjectStorageMock->expects(self::once())->method('attach')->with(self::equalTo($banner));
        $this->subject->_set('banners', $bannersObjectStorageMock);

        $this->subject->addBanner($banner);
    }

    /**
     * @test
     */
    public function removeBannerFromObjectStorageHoldingBanners(): void
    {
        $banner = new \Slavlee\Advertisement\Domain\Model\Banner();
        $bannersObjectStorageMock = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->onlyMethods(['detach'])
            ->disableOriginalConstructor()
            ->getMock();

        $bannersObjectStorageMock->expects(self::once())->method('detach')->with(self::equalTo($banner));
        $this->subject->_set('banners', $bannersObjectStorageMock);

        $this->subject->removeBanner($banner);
    }
}
