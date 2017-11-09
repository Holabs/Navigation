<?php

namespace Holabs\Navigation;

use Holabs\Navigation\Item\IIcon;
use Holabs\Navigation\Item\ILabel;
use Holabs\Utils\ArrayHash;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
interface IItem {

	/**
	 * @return string
	 */
	public function getName(): string;

	/**
	 * @return string
	 */
	public function getCaption(): ?string;

	/**
	 * @return ILabel
	 */
	public function getLabel(): ?ILabel;

	/**
	 * @return IIcon
	 */
	public function getIcon(): ?IIcon;

	/**
	 * @return string
	 */
	public function getLink(): ?string;

	/**
	 * @return bool
	 */
	public function isUrl(): bool;

	/**
	 * @return bool
	 */
	public function isTreeView(): bool;

	/**
	 * @return IItem[]|ArrayHash
	 */
	public function getItems(): ArrayHash;

	/**
	 * @param string $caption
	 * @return IItem
	 */
	public function setCaption(string $caption): self;

	/**
	 * @param string|null $label
	 * @param string|null $color
	 * @return IItem
	 */
	public function setLabel(string $label = NULL, string $color = NULL): self;

	/**
	 * @param string $link
	 * @return IItem
	 */
	public function setLink(string $link): self;

	/**
	 * @param string|null $icon
	 * @param string|null $color
	 * @return IItem
	 */
	public function setIcon(string $icon = NULL, string $color = NULL): self;

	/**
	 * @param bool $url
	 * @return IItem
	 */
	public function setUrl(bool $url = TRUE): self;

	/**
	 * @param int|string      $name
	 * @param string          $caption
	 * @param int|string|null $insertBefore
	 * @return IItem
	 */
	public function createItem(string $name, string $caption, string $insertBefore = NULL): self;

	/**
	 * @param IItem           $item
	 * @param int|string|null $insertBefore
	 * @return IItem
	 */
	public function addItem(IItem $item, string $insertBefore = NULL): self;

	/**
	 * @param \Closure|callable|array $callable (IItem $item, $result)
	 * @return IItem
	 */
	public function addActiveCondition($callable): self;

	/**
	 * @param \Closure|callable|array $callable (IItem $item, $result)
	 * @return IItem
	 */
	public function addRenderCondition($callable): self;


}