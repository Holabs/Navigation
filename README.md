Holabs/Navigation
===============

Navigation manager for Nette framework

Installation
------------

**Requirements:**
 - php 7.1+
 - [nette/utils](https://github.com/nette/utils)
 - [holabs/utils](https://github.com/holabs/utils)
 
```sh
composer require holabs/navigation
```

Configuration
-------------
```yaml
extensions:
	holabs.navigation: Holabs\Navigation\Bridges\Nette\NavigationExtension
	
	
# OPTIONAL - You can predefine navigation sections
services:
	holabs.navigation.manager:
		setup:
			- createSection('main')
			- createSection('settings', 'System settings')
```

Using
-----
Your **Presenter**, **module** or whatever now can looks like this:

```php
<?php 

namespace App\Presenters;

use Holabs\Navigation\Manager;
use Nette\Application\UI\Presenter;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.cz]
 */
abstract class BasePresenter extends Presenter {

	/** @var Manager @inject */
	public $navigation;


	public function startup() {
		parent::startup();
		
		$section = $this->navigation->getSection('main');
		$section->createItem('dashboard', 'Main dashboard')
			->setLink('Dashboard:default')
			->setIcon('dashboard')
			->setLabel('new', 'red')
			->addActiveCondition(function() { // Set active callback
				return $this->isLinkCurrent('Dashboard:*');
			})
			->addRenderCondition(function () { // Set render callback
				return $this->getUser()->isAllowed('Dashboard', 'default');
			});
	
		$section = $this->navigation->getSection('settings');
		$section->createItem('users', 'Users settings')
			->setLink('Users:default')
			->setIcon('group', 'green')
			->addActiveCondition(function() {
				return $this->isLinkCurrent('Users:*');
			})
			->addRenderCondition(function () {
				return $this->getUser()->isAllowed('Users', 'default');
			});
	}
	
	public function beforeRender() {
		parent::beforeRender();
		$this->template->sections = $this->navigation->getSections();
	}
}
```


```latte
<ul class="sidebar-menu" data-widget="tree" n:inner-foreach="$sections as $section">
	<li n:if="$section->getCaption()" class="header">{$section->getCaption()|translate}</li>
	{var $item = $section}
	{block item}
		<li n:foreach="$item->getItems() as $subitem" n:if="$subitem->isRenderingAllowed()" n:class="$subitem->isTreeView() ? 'treeview', $subitem->isActive() ? 'active', !$subitem->getLink() ? 'bg-danger'">

			{var $link = $subitem->getLink() ? ($subitem->isUrl() ? $subitem->getLink() : $presenter->link($subitem->getLink())) : '#'}

			<a href="{$link}">
				<i n:if="$subitem->getIcon()" n:class="'fa', 'fa-' . $subitem->getIcon(), $subitem->getIcon()->getColor() ? 'text-' . $subitem->getIcon()->getColor()"></i>
				<i n:if="!$subitem->getIcon()" class="fa fa-circle-o"></i>
				<span>{$subitem->getCaption()|translate}</span>
				<span n:if="$subitem->getLabel() && !$subitem->isTreeView()" n:class="'label', 'pull-right', $subitem->getLabel()->getColor() ? 'bg-' . $subitem->getLabel()->getColor()">
					{$subitem->getLabel()->getCaption()|translate}
				</span>
				<span n:if="$subitem->isTreeView()" class="pull-right-container">
              		<i class="fa fa-angle-left pull-right"></i>
            	</span>
			</a>

			<ul n:if="$subitem->isTreeView()" class="treeview-menu">
				{include item item => $subitem}
			</ul>
		</li>
	{/block}
</ul>

```