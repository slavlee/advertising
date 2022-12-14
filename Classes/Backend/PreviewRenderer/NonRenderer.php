<?php
declare(strict_types=1);

namespace Slavlee\Advertising\Backend\PreviewRenderer;

use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;

/**
 * This file is part of the "Advertising" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * (c) 2021 Kevin Chileong Lee <support@slavlee.de>, Slavlee
 */


/**
 * This class prevent elements from rendering in the backend at all
 * @author Kevin Chileong Lee* 
 * @package TYPO3
 * @subpackage Slavlee TYPO3
 * @project advertising
 */
class NonRenderer implements \TYPO3\CMS\Backend\Preview\PreviewRendererInterface
{
	/**
	 * Dedicated method for rendering preview header HTML for
	 * the page module only. Receives $item which is an instance of
	 * GridColumnItem which has a getter method to return the record.
	 *
	 * @param GridColumnItem
	 * @return string
	 */
	public function renderPageModulePreviewHeader(GridColumnItem $item): string
	{
		return '';
	}
	
	/**
	 * Dedicated method for rendering preview body HTML for
	 * the page module only.
	 *
	 * @param GridColumnItem $item
	 * @return string
	 */
	public function renderPageModulePreviewContent(GridColumnItem $item): string
	{
		return '';
	}
	
	/**
	 * Render a footer for the record to display in page module below
	 * the body of the item's preview.
	 *
	 * @param GridColumnItem $item
	 * @return string
	 */
	public function renderPageModulePreviewFooter(GridColumnItem $item): string
	{
		return '';
	}
	
	/**
	 * Dedicated method for wrapping a preview header and body HTML.
	 *
	 * @param string $previewHeader
	 * @param string $previewContent
	 * @param GridColumnItem $item
	 * @return string
	 */
	public function wrapPageModulePreview($previewHeader, $previewContent, GridColumnItem $item): string
	{
		return '';
	}
}