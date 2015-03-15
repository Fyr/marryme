<?php

	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
	Router::connect('/pages/', array('controller' => 'pages', 'action' => 'home'));

	Router::connect('/sitemap.xml', array(
		'controller' => 'sitemap',
		'action' => 'xml'
	));

/*
	Router::connect('/article/:category/page/:page', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'page' => '[0-9]+',
		'object_type' => 'articles'
	));
	Router::connect('/article/:category/:id', array(
		'controller' => 'article',
		'action' => 'view',
		'category' => '[a-z0-9\-]+',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'articles'
	));
	Router::connect('/article/:category', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'articles'
	));
	Router::connect('/article/', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '',
		'object_type' => 'articles'
	));
*/
	Router::connect('/articles/page/:page', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '',
		'object_type' => 'articles',
		'page' => '[0-9]+'
	));
	Router::connect('/articles/:id', array(
		'controller' => 'article',
		'action' => 'view',
		'category' => '[a-z0-9\-]+',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'articles'
	));
	Router::connect('/articles/', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '',
		'object_type' => 'articles'
	));
	/* -= News =- */
	Router::connect('/news/page/:page', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '',
		'object_type' => 'news',
		'page' => '[0-9]+'
	));
	Router::connect('/news/:id', array(
		'controller' => 'article',
		'action' => 'view',
		'category' => '[a-z0-9\-]+',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'news'
	));
	Router::connect('/news/', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '',
		'object_type' => 'news'
	));

	/* -= Brands =- */
	Router::connect('/:category/brands/:id', array(
		'controller' => 'article',
		'action' => 'view_brand',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'brands'
	));
	Router::connect('/:category/brands', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'brands'
	));
	
	/* -= Collections =- */
	Router::connect('/:category/collections/:id', array(
		'controller' => 'article',
		'action' => 'view',
		'category' => '[a-z0-9\-]+',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'collections'
	));
	
	/* -= Models =- */
	Router::connect('/:category/product/page/:page', array(
		'controller' => 'products',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'products',
		'page' => '[0-9]+'
	));
	Router::connect('/:category/product/:id', array(
		'controller' => 'products',
		'action' => 'view',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'products',
		'id' => '[a-z0-9\-]+\.html',
	));
	Router::connect('/:category/product/', array(
		'controller' => 'products',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'products',
		'action' => 'index'
	));
	
	/* -= Accessories =- */
	Router::connect('/:category/subcategories/:id', array(
		'controller' => 'products',
		'action' => 'accessories',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'subcategories'
	));
	Router::connect('/:category/subcategories', array(
		'controller' => 'products',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'subcategories'
	));

	Router::connect('/photo/page/:page', array(
		'controller' => 'article',
		'action' => 'index',
		'object_type' => 'photos',
		'page' => '[0-9]+'
	));
	Router::connect('/photo/view/:id', array(
		'controller' => 'article',
		'action' => 'view',
		'id' => '[0-9]+',
		'object_type' => 'photos'
	));
	Router::connect('/photo/', array(
		'controller' => 'article',
		'action' => 'index',
		'object_type' => 'photos'
	));

	Router::connect('/feedback/page/:page', array(
		'controller' => 'feedback',
		'action' => 'index',
		'page' => '[0-9]+'
	));
	Router::connect('/feedback/:page', array(
		'controller' => 'pages',
		'action' => 'home',
		'page' => '[0-9]+'
	));
	Router::connect('/feedback/', array('controller' => 'feedback', 'action' => 'index'));

	/* -= companies =- */
	Router::connect('/svadebnye-salony-minsk/page/:page', array(
		'controller' => 'companies',
		'action' => 'index',
		'page' => '[0-9]+'
	));
	Router::connect('/svadebnye-salony-minsk/:id', array(
		'controller' => 'companies',
		'action' => 'view',
		'id' => '[a-z0-9\-]+\.html',
	));
	Router::connect('/svadebnye-salony-minsk/', array(
		'controller' => 'companies',
		'action' => 'index',
	));
	