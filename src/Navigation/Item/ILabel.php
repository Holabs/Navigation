<?php


namespace Holabs\Navigation\Item;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
interface ILabel {

	/**
	 * @return string
	 */
	public function getCaption(): string;

	/**
	 * @return string
	 */
	public function getColor(): string;

	/**
	 * @param string $caption
	 * @return ILabel
	 */
	public function setCaption(string $caption): self;

	/**
	 * @param string $color
	 * @return ILabel
	 */
	public function setColor(string $color): self;

	/**
	 * Return Label caption
	 * @return string
	 */
	public function __toString();

}