<?php


namespace Holabs\Navigation\Item;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Label implements ILabel {

	/** @var string */
	private $caption;

	/** @var string */
	private $color = 'blue';

	/**
	 * Label constructor.
	 * @param string $caption
	 */
	public function __construct(string $caption) {
		$this->caption = $caption;
	}

	/**
	 * @return string
	 */
	public function getCaption(): string {
		return $this->caption;
	}

	/**
	 * @return string
	 */
	public function getColor(): string {
		return $this->color;
	}

	/**
	 * @param string $caption
	 * @return ILabel
	 */
	public function setCaption(string $caption): ILabel {
		$this->caption = $caption;

		return $this;
	}

	/**
	 * @param string $color
	 * @return ILabel
	 */
	public function setColor(string $color): ILabel {
		$this->color = $color;

		return $this;
	}

	/**
	 * Return Label caption
	 * @return string
	 */
	public function __toString() {
		$this->getCaption();
	}
}