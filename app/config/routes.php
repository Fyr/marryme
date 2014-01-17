<?php
/**
 * Short description for file.
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'home'));
	Router::connect('/pages/', array('controller' => 'pages', 'action' => 'home'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */

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
	Router::connect('/:category/brands', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'brands'
	));
	Router::connect('/:category/brands/:id', array(
		'controller' => 'article',
		'action' => 'view',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'brands'
	));

	/* -= Subcategories =- */
	Router::connect('/:category/subcategories', array(
		'controller' => 'products',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'subcategories'
	));
	Router::connect('/:category/subcategories/:id', array(
		'controller' => 'products',
		'action' => 'accessories',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'subcategory'
	));

	/* -= Collections =- */
	Router::connect('/:category/collections/:id', array(
		'controller' => 'article',
		'action' => 'view',
		'category' => '[a-z0-9\-]+',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'collections'
	));
	/*
	Router::connect('/myarticle/page/:page', array('controller' => 'myarticle', 'action' => 'index', 'category' => '', 'object_type' => 'articles', 'page' => '[0-9]+'));
	Router::connect('/myarticle/:category/page/:page', array('controller' => 'myarticle', 'action' => 'index', 'category' => '[a-z0-9\-]+', 'page' => '[0-9]+', 'object_type' => 'articles'));
	Router::connect('/myarticle/:category/:id', array('controller' => 'myarticle', 'action' => 'view', 'category' => '[a-z0-9\-]+', 'id' => '[a-z0-9\-]+\.html', 'object_type' => 'articles'));
	Router::connect('/myarticle/:category', array('controller' => 'myarticle', 'action' => 'index', 'category' => '[a-z0-9\-]+', 'object_type' => 'articles'));
	Router::connect('/myarticle/', array('controller' => 'myarticle', 'action' => 'index', 'category' => '', 'object_type' => 'articles'));
	*/
	/*
	Router::connect('/video/:category/:id', array(
		'controller' => 'article',
		'action' => 'view',
		'category' => '[a-z0-9\-]+',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'videos'
	));
	Router::connect('/video/:category', array('controller' => 'article', 'action' => 'index', 'category' => '[a-z0-9\-]+', 'object_type' => 'videos'));
	Router::connect('/video/', array('controller' => 'article', 'action' => 'index', 'category' => '', 'object_type' => 'videos'));
	*/
/*
	Router::connect('/video/page/:page', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '',
		'object_type' => 'videos',
		'page' => '[0-9]+'
	));
	Router::connect('/video/:category/page/:page', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'page' => '[0-9]+',
		'object_type' => 'videos'
	));
	Router::connect('/video/:category/:id', array(
		'controller' => 'article',
		'action' => 'view',
		'category' => '[a-z0-9\-]+',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'videos'
	));
	Router::connect('/video/:category', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'videos'
	));
	Router::connect('/video/', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '',
		'object_type' => 'videos'
	));
*/

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
	Router::connect('/feedback/', array('controller' => 'feedback', 'action' => 'index'));

/*
	Router::connect('/product/:category/page/:page', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'page' => '[0-9]+',
		'object_type' => 'products'
	));
	Router::connect('/product/:category/:id', array(
		'controller' => 'article',
		'action' => 'view',
		'category' => '[a-z0-9\-]+',
		'id' => '[a-z0-9\-]+\.html',
		'object_type' => 'products'
	));
	Router::connect('/product/:category', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'products'
	));
	Router::connect('/product/', array(
		'controller' => 'article',
		'action' => 'index',
		'category' => '',
		'object_type' => 'products'
	));
	*/

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
		'id' => '[0-9]+'
	));

	Router::connect('/:category/product/', array(
		'controller' => 'products',
		'category' => '[a-z0-9\-]+',
		'object_type' => 'products',
		'action' => 'index'
	));

	/* -= companies =- */
	Router::connect('/prazdnichnie-agentstva/page/:page', array(
		'controller' => 'companies',
		'action' => 'index',
		'page' => '[0-9]+'
	));
	Router::connect('/prazdnichnie-agentstva/:id', array(
		'controller' => 'companies',
		'action' => 'view',
		'id' => '[a-z0-9\-]+\.html',
	));
	Router::connect('/prazdnichnie-agentstva/', array(
		'controller' => 'companies',
		'action' => 'index',
	));
?>