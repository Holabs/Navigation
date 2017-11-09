<?php


namespace Holabs\Navigation\Item;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Icon implements IIcon {

	/** @var string */
	private $icon;

	/** @var string|null */
	private $color = NULL;

	/**
	 * Icon constructor.
	 * @param string $icon
	 */
	public function __construct(string $icon) {
		$this->icon = $icon;
	}


	/**
	 * @return string
	 */
	public function getIcon(): string {
		return $this->icon;
	}

	/**
	 * @return null|string
	 */
	public function getColor(): ?string {
		return $this->color;
	}

	/**
	 * @param string $icon
	 * @return IIcon
	 */
	public function setIcon(string $icon): IIcon {
		$this->icon = $icon;

		return $this;
	}

	/**
	 * @param string|null $color
	 * @return IIcon
	 */
	public function setColor(string $color = NULL): IIcon {
		$this->color = $color;

		return $this;
	}

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->getIcon();
	}
}