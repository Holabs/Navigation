<?php

namespace Holabs\Navigation;

use Holabs\Navigation\Item\Icon;
use Holabs\Navigation\Item\IIcon;
use Holabs\Navigation\Item\ILabel;
use Holabs\Navigation\Item\Label;
use Holabs\Utils\ArrayHash;
use Nette\Utils\Arrays;
use Nette\Utils\Callback;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Item implements IItem {

	/** @var string */
	private $name;

	/** @var string */
	private $caption = '';

	/** @var Label|null */
	private $label = NULL;

	/** @var string */
	private $link = NULL;

	/** @var Icon|null */
	private $icon = NULL;

	/** @var bool */
	private $url = FALSE;

	/** @var ArrayHash */
	private $items;

	/** @var \Closure[]|callable[]|array */
	private $activeConditions = [];

	/** @var \Closure[]|callable[]|array */
	private $renderConditions = [];

	/**
	 * @param string $name
	 * @param string $caption
	 * @param string $label
	 * @param string $link
	 * @param bool   $url
	 */
	public function __construct(
		string $name,
		string $caption = '',
		string $label = NULL,
		string $link = NULL,
		bool $url = FALSE
	) {
		$this->name = $name;
		$this->caption = $caption;
		$this->label = $label ? new Label($label) : NULL;
		$this->link = $link;
		$this->url = $url;
		$this->items = new ArrayHash;
	}

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getCaption(): string {
		return $this->caption;
	}

	/**
	 * @return ILabel
	 */
	public function getLabel(): ?ILabel {
		return $this->label;
	}

	/**
	 * @return IIcon|null
	 */
	public function getIcon(): ?IIcon {
		return $this->icon;
	}

	/**
	 * @return string
	 */
	public function getLink(): ?string {
		return $this->link;
	}

	/**
	 * @return bool
	 */
	public function isUrl(): bool {
		return $this->url;
	}

	/**
	 * @return bool
	 */
	public function isTreeView(): bool {
		return (bool)$this->getItems()->count();
	}

	/**
	 * @return IItem[]|ArrayHash
	 */
	public function getItems(): ArrayHash {
		return $this->items;
	}

	/**
	 * @param string $caption
	 * @return IItem
	 */
	public function setCaption(string $caption): IItem {
		$this->caption = $caption;

		return $this;
	}

	/**
	 * @param string|null $label
	 * @param string|null $color
	 * @return IItem
	 */
	public function setLabel(string $label = NULL, string $color = NULL): IItem {
		$this->label = $label ? new Label($label) : NULL;

		if ($this->label && $color) {
			$this->label->setColor($color);
		}

		return $this;
	}

	/**
	 * @param string|null $link
	 * @return IItem
	 */
	public function setLink(string $link = NULL): IItem {
		$this->link = $link;

		return $this;
	}

	/**
	 * @param string|null $icon
	 * @param string|null $color
	 * @return IItem
	 */
	public function setIcon(string $icon = NULL, string $color = NULL): IItem {
		$this->icon = $icon ? new Icon($icon) : NULL;

		if ($this->icon && $color) {
			$this->icon->setColor($color);
		}

		return $this;
	}

	/**
	 * @param bool $url
	 * @return IItem
	 */
	public function setUrl(bool $url = TRUE): IItem {
		$this->url = $url;

		return $this;
	}

	/**
	 * @param int|string  $name
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
	 * @param IItem       $item
	 * @param string|null $insertBefore
	 * @return IItem
	 */
	public function addItem(IItem $item, string $insertBefore = NULL): IItem {
		if ($insertBefore && $this->getItems()->offsetExists($insertBefore)) {
			$arr = (array)$this->getItems();
			Arrays::insertBefore($arr, $insertBefore, [$item->getName() => $item]);
			$this->items = ArrayHash::from($arr);

			return $this;
		}
		$this->getItems()->offsetSet($item->getName(), $item);

		return $this;
	}

	/**
	 * @param \Closure|callable|array $callable (IItem $item, $result)
	 * @return IItem
	 */
	public function addActiveCondition($callable): IItem {

		Callback::check($callable);

		$this->activeConditions[] = $callable;

		return $this;
	}

	/**
	 * @param \Closure|callable|array $callable (IItem $item, $result)
	 * @return IItem
	 */
	public function addRenderCondition($callable): IItem {

		Callback::check($callable);

		$this->renderConditions[] = $callable;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool {
		$result = FALSE;
		foreach ($this->activeConditions as $handler) {
			//$result = call_user_func_array($handler, [$this]);
			$return = Callback::invoke($handler, $this);
			if ($return !== NULL) {
				$result = (bool)$return;
			}
		}

		return $result;
	}

	/**
	 * @return bool
	 */
	public function isRenderingAllowed(): bool {
		$result = TRUE;
		foreach ($this->renderConditions as $handler) {
			//$result = call_user_func_array($handler, [$this]);
			$return = Callback::invoke($handler, $this);
			if ($return !== NULL) {
				$result = (bool)$return;
			}
		}

		return $result;
	}


}