<?php


namespace Holabs\Navigation;

use Holabs\Utils\ArrayHash;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
interface ISection {

	/**
	 * @return string|int
	 */
	public function getName(): string;

	/**
	 * @return string|null
	 */
	public function getCaption(): ?string;

	/**
	 * @param string|null $caption
	 * @return ISection
	 */
	public function setCaption(string $caption = NULL): self;

	/**
	 * @return IItem[]|ArrayHash
	 */
	public function getItems(): ArrayHash;

	/**
	 * @param string $name
	 * @return IItem|null
	 */
	public function getItem(string $name): ?IItem;

	/**
	 * @param string $name
	 * @param string $caption
	 * @param string|null $insertBefore
	 * @return IItem
	 */
	public function createItem(string $name, string $caption, string $insertBefore = NULL): IItem;

	/**
	 * @param IItem $item
	 * @param string|null $insertBefore
	 * @return ISection
	 */
	public function addItem(IItem $item, string $insertBefore = NULL): self;

}