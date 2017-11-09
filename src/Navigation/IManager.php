<?php


namespace Holabs\Navigation;

use Holabs\Utils\ArrayHash;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
interface IManager {

	/**
	 * @param string      $name
	 * @param string|null $caption
	 * @param string|null $insertBefore
	 * @return ISection
	 */
	public function createSection(string $name, string $caption = NULL, string $insertBefore = NULL): ISection;

	/**
	 * @param ISection         $section
	 * @param string|null $insertBefore
	 * @return IManager
	 */
	public function addSection(ISection $section, string $insertBefore = NULL): self;

	/**
	 * @return ISection[]|ArrayHash
	 */
	public function getSections(): ArrayHash;

	/**
	 * @param string $name
	 * @return ISection|null
	 */
	public function getSection(string $name): ?ISection;

}