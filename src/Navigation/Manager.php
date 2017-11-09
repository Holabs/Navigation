<?php

namespace Holabs\Navigation;

use Holabs\Utils\ArrayHash;
use Nette\Utils\Arrays;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Manager implements IManager {
	
	/** @var ISection[]|ArrayHash */
	protected $sections;


	public function __construct() {
		$this->sections = new ArrayHash;
	}

	/**
	 * @return ISection[]|ArrayHash
	 */
	public function getSections(): ArrayHash {
		return clone $this->sections;
	}

	/**
	 * @param string $name
	 * @return ISection|null
	 */
	public function getSection(string $name): ?ISection{
		return $this->getSections()->offsetGetExists($name);
	}

	/**
	 * @param string      $name
	 * @param string|null $caption
	 * @param string|null $insertBefore
	 * @return ISection
	 */
	public function createSection(string $name, string $caption = NULL, string $insertBefore = NULL): ISection {
		$section = new Section($name, $caption);
		$this->addSection($section, $insertBefore);

		return $section;
	}
	
	/**
	 * @param ISection         $section
	 * @param string|null $insertBefore
	 * @return IManager
	 */
	public function addSection(ISection $section, string $insertBefore = NULL): IManager{
		if ($insertBefore && $this->getSections()->offsetExists($insertBefore)){
			$arr = (array) $this->getSections();
			Arrays::insertBefore($arr, $insertBefore, [$section->getName() => $section]);
			$this->sections = ArrayHash::from($arr);
			return $this;
		}
		$this->sections->offsetSet($section->getName(), $section);
		return $this;
	}
}