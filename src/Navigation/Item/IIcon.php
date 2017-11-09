<?php


namespace Holabs\Navigation\Item;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
interface IIcon {

	/**
	 * @return string
	 */
	public function getIcon(): string;

	/**
	 * @return null|string
	 */
	public function getColor(): ?string;

	/**
	 * @param string $icon
	 * @return IIcon
	 */
	public function setIcon(string $icon): IIcon;

	/**
	 * @param string|null $color
	 * @return IIcon
	 */
	public function setColor(string $color = NULL): IIcon;

	/**
	 * Return icon
	 * @return string
	 */
	public function __toString();

}