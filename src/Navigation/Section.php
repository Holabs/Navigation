<?php

namespace Holabs\Navigation;

use Holabs\Utils\ArrayHash;
use Nette\Utils\Arrays;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Section implements ISection {

	/** @var string */
	private $name;

	/** @var string */
	private $caption = NULL;
	
	/** @var IItem[]|ArrayHash */
	private $items;

	/**
	 * @param string $name
	 * @param string $caption
	 */
	public function __construct(string $name, string $caption = NULL) {
		$this->name = $name;
		$this->caption = $caption;
		$this->items = new ArrayHash;
	}
	
	/**
	 * @return string
	 */
	public function getName(): string{
		return $this->name;
	}
	
	/**
	 * @return string|null
	 */
	public function getCaption(): ?string {
		return $this->caption;
	}

	/**
	 * @param string|null $caption
	 * @return ISection
	 */
	public function setCaption(string $caption = NULL): ISection {
		$this->caption = $caption;
		return $this;
	}

	/**
	 * @return IItem[]|ArrayHash
	 */
	public function getItems(): ArrayHash {
		return clone $this->items;
	}

	/**
	 * @param string $name
	 * @return IItem|null
	 */
	public function getItem(string $name): ?IItem {
		$items = $this->getItems();
		return $items->offsetGetExists($name);
	}
	
	/**
	 * @param string      $name
	 * @param string      $caption
	 * @param string|null $insertBefore
	 * @return IItem
	 */
	public function createItem(string $name, string $caption, string $insertBefore = NULL): IItem {
		$item = new Item($name, $caption);
		$this->addItem($item, $insertBefore);
		return $item;
	}
	
	/**
	 * @param IItem $item
	 * @param string|null $insertBefore
	 * @return ISection
	 */
	public function addItem(IItem $item, string $insertBefore = NULL): ISection{
		if ($insertBefore && $this->getItems()->offsetExists($insertBefore)){
			$arr = (array) $this->getItems();
			Arrays::insertBefore($arr, $insertBefore, [$item->getName() => $item]); 
			$this->items = ArrayHash::from($arr);
			return $this;
		}
		$this->items->offsetSet($item->getName(), $item);
		return $this;
	}
	
}