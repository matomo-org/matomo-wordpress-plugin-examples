<?php
namespace Piwik\Plugins\MyCustomPlugin;

use Piwik\Widget\WidgetsList;

class MyCustomPlugin extends \Piwik\Plugin {

	public function registerEvents()
	{
		return array(
			'Widget.filterWidgets' => 'filterWidgets',
		);
	}

	public function filterWidgets(WidgetsList $list)
	{
		// remove all widgets within this category
		$list->remove('General_Generic');
	}

}