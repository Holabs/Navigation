<?php


namespace Holabs\Navigation\Bridges\Nette;

use Holabs\Navigation\Manager;
use Nette\DI\Extensions\ExtensionsExtension;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      holabs/navigation
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class NavigationExtension extends ExtensionsExtension {

	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('manager'))
			->setFactory(Manager::class);
	}

}