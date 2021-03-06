_Current version 0.9.0_

NordCms is a stand-alone module developed by Nord Software Ltd. This extension provides the core content management system functionality such as multilingual content and in place editing of content to any Yii project. NordCms is licensed under the New BSD License, please see the LICENSE file.

##Links

* [Try out the Demo](http://www.cniska.net/cmsdemo)
* [Join the Discussion](http://www.yiiframework.com/forum/index.php?/topic/26809-extension-nordcms)
* [Report an issue](https://bitbucket.org/NordLabs/nordcms/issues/new)
* [Fork us on Bitbucket](https://bitbucket.org/NordLabs/nordcms)

##What's included?

* In place content editing using [MarkItUp](http://markitup.jaysalvat.com)
* Custom tags for dynamic content
* Rendering of nodes as pages and/or widgets
* Attachments such as images and other files
* Multilingual content
* Search engine optimization for pages
* Support for both internal and external links
* Theme that uses my [Bootstrap extension](http://www.yiiframework.com/extensions/bootstrap)

For more detailed information please read the [Usage section](#hh4).

##Setup

Unzip the extension under protected/modules/cms and add the following to your application configuration:

~~~
[php]
'imports'=>array(
	.....
	'application.modules.cms.CmsModule',
),
'modules'=>array(
	.....
	'cms',
),
'components'=>array(
	.....
	'urlManager'=>array(
		.....
		'rules'=>array(
			.....
			'page/<name>-<id:\d+>.html'=>'cms/node/page', // clean URLs for pages
		),
	),
	'cms'=>array(
		'class'=>'cms.components.Cms'
	),
),
~~~

Next you need to create the necessary database tables by running the schema.sql in the data folder.

###Configuration

The cms application component supports the following configuration parameters:

~~~
[php]
'cms'=>array(
	'class'=>'cms.components.Cms'
	// the names of the web users with access to the cms
	'users'=>array('admin'),
	// the langauges enabled for the cms
	'languages'=>array('en_us'=>'English'),
	// the default language
	'defaultLanguage'=>'en_us',
	// the types of files that can uploaded as attachments
	'allowedFileTypes'=>'jpg, gif, png',
	// the maximum allowed filesize for attachments
	'allowedFileSize'=>1024,
	// the path to save the attachments
	'attachmentPath'=>'/files/cms/attachments/',
	// the template to use for node headings
	'headingTemplate'=>'<h1 class="heading">{heading}</h1>',
	// the template to use for widget headings
	'widgetHeadingTemplate'=>'<h3 class="heading">{heading}</h3>',
	// the template to use for page titles
	'pageTitleTemplate'=>'{title} | {appName}',
	// the application layout to use with the cms
	'appLayout'=>'application.views.layouts.main',
	// the name of the error flash message categories
	'flashError'=>'error',
	'flashInfo'=>'info',
	'flashSuccess'=>'success',
	'flashWarning'=>'warning',
),
~~~

**Please note that this is the component configuration, NOT the module.**

##Usage

###Creating a page

Pages are created by linking to them. To create a page add the following to one of your views:

~~~
[php]
Yii::app()->cms->createUrl('foo');
~~~

What the above code does it creates a node with the name 'foo' (if it doesn't already exist) and returns the URL to that node.

You can also set the following page properties: URL, page title, meta title, meta description, meta keywords.

###Creating a block

Blocks are used for displaying Cms content within views and they can be created using the CmsBlock widget. To add a block, add the following code to one of your views:

~~~
[php]
<?php $this->widget('cms.widgets.CmsBlock',array('name'=>'bar')) ?>
~~~

###Adding content to a node

If you have permissions to update Cms content an 'Update' link will be displayed below the content. Nodes have a set of properties that can be specified per language:

* Heading - _the main heading_
* Body - _the content_
* Stylesheet - _stylesheet associated with the content_
* URL - _the page URL (page/{url}-{id}.html)_
* Page Title - _the page title_
* Breadcrumb - _the breadcrumb text_
* Meta Title - _the page meta title_
* Meta Description - _the page meta description_
* Meta Keywords - _the page meta keywords_

Please note that the page properties are only used with pages.

It is possible to create relations between nodes by setting the parent. This will help you organize your content and it will also automatically set the correct breadcrumbs.

###Editing content

You can use various tags within the body-field:

* {{heading}} - _the main heading_
* {{image:id}} - _displays an attached image_
* {{node:name}} - _displays an inline node
* {{file:id}} or {{file:id:Custom link name}} - _creates a link to an attached file_
* {{email:address}} - _creates a mailto link_
* {{name|text}} - _creates an internal link_
* {{address|text}} - _creates an external link_

Please note that you cannot render inline nodes using the block widget.

###Using NordCms with Bootstrap

NordCms comes with a theme that can be used with my [Bootstrap extension](http://www.yiiframework.com/extension/bootstrap).

To enable the bootstrap theme you first need to download and setup Bootstrap. When you have Bootstrap up and running you need to copy the files in themes/bootstrap/views to you themes/views folder. If you're not familiar with Yii's theming, read more about it [here](http://www.yiiframework.com/doc/guide/1.1/en/topics.theming).

##What's next?

* Comming soon!

##Changes

##Dec 15, 2011
* Initial release