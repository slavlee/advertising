<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Bootstrap;


/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2023 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */


abstract class Base
{
    protected $extensionKey = 'advertising';

    /**
     * Does the main class purpose
     * @return void
     */
    public abstract function invoke(): void;
}