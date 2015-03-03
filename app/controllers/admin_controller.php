<?
class AdminController extends AppController {
	var $name = 'Admin';
	var $layout = 'admin';
	var $components = array('Auth', 'articles.PCArticle', 'grid.PCGrid', 'Email', 'SiteEmail');
	var $helpers = array('Text', 'Session', 'core.PHFcke', 'core.PHA', 'grid.PHGrid');

	var $uses = array('articles.Article', 'media.Media', 'stats.Stat', 'category.Category', 'comments.Comment', 'tags.Tag', 'tags.TagObject', 'SiteArticle', 'SiteComment', 'SiteProduct', 'TagcloudLink', 'Company', 'SiteCompany');
	// var $helpers = array('Html'); // 'Form', 'Fck', 'Ia'

	var $aMenu = array(
		'pages' => '/admin/articlesList/Article.object_type:pages',
		'articles' => '/admin/articlesList/Article.object_type:articles',
		'news' => '/admin/articlesList/Article.object_type:news',
		'brands' => '/admin/articlesList/Article.object_type:brands',
		'collections' => '/admin/articlesList/Article.object_type:collections',
		'subcategories' => '/admin/articlesList/Article.object_type:subcategories',
		'products' => '/admin/articlesList/Article.object_type:products',
		'photos' => '/admin/articlesList/Article.object_type:photos',
		'comments' => '/admin/commentsList/',
		'photoslider' => '/admin/photoslider/',
		'companies' => '/admin/companiesList/',
		'settings' => '/admin/settings/',
		'statistics' => '/admin/statistics/',
		'tagcloud' => '/admin/tagcloud/'
	);
	var $currMenu = '';

	function beforeFilter() {
		Configure::write('Config.language', 'rus');

		Security::setHash("md5");
		$this->Auth->loginAction = array('controller' => 'admin', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'admin', 'action' => 'index');
		$this->Auth->logoutRedirect = '/pages/home';
		$this->Auth->userScope = array('User.group_id' => 10);

		if ($this->Auth->isAuthorized() && $this->Auth->user('group_id') != 10) {
			$this->redirect('/pages/home');
		}

		$this->Article = $this->SiteArticle; // что работало все, что написано для Article в самом плагине
		$this->Comment = $this->SiteComment;

		$this->beforeFilterMenu();
		$this->beforeFilterLayout();
	}


	function beforeFilterMenu() {
		$this->currMenu = $this->params['action'];
		$this->currLink = $this->params['action'];
	}

	function beforeFilterLayout() {
		// do nothing
	}

	function beforeRender() {
		$this->beforeRenderMenu();
		$this->beforeRenderLayout();
	}

	function beforeRenderLayout() {
		$this->set('errMsg', $this->errMsg);
		$this->set('aErrFields', $this->aErrFields);
	}

	function beforeRenderMenu() {
		$this->set('aMenu', $this->aMenu);
		$this->set('currMenu', $this->currMenu);
	}

	function login() {
		$this->layout = 'admin_login';
	}

	function logout() {
		$this->redirect($this->Auth->logout());
	}

	function index() {
		//$data = $this->PMCategory->children();
		/*
		$data = $this->PMCategory->generateTreeList(null, null, null, '&nbsp;&nbsp;&nbsp;');
		// debug($data);
		$categories = $this->PMCategory->generateNestedTree();
		$this->set('categories', $categories);
		*/
		// debug($categories);
	}

	function articlesList() {
		$objectType = $this->params['named']['Article.object_type'];
		$this->currMenu = $objectType;
		if ($objectType == 'photos') {
			$this->grid['SiteArticle'] = array(
				'conditions' => array('Article.object_type' => $objectType),
				'fields' => array('modified', 'Article.title', 'featured', 'published'),
				'hidden' => array('body')
			);
		} elseif ($objectType == 'pages') {
			$this->grid['SiteArticle'] = array(
				'conditions' => array('Article.object_type' => $objectType),
				'fields' => array('title', 'page_id'),
				'captions' => array('title' => 'Название', 'page_id' => 'ID страницы'),
				'hidden' => array('body')
			);
		} elseif ($objectType == 'products') {
			$this->grid['SiteArticle'] = array(
				'conditions' => array('Article.object_type' => $objectType),
				'fields' => array('modified', 'object_type', 'object_id', 'title', 'price', 'images_filesize', 'featured', 'is_active', 'is_new', 'is_pending', 'published'),
				'hidden' => array('body'),
				'captions' => array(
					'Category.title' => __('Category', true),
					'Article.featured' => __('New!!!', true),
					'Article.is_active' => __('Active', true),
					'Article.is_pending' => __('Pending', true),
					'Article.object_id' => __('Collection', true),
					'Article.images_filesize' => __('Images filesize', true),
					'Article.object_type' => __('Brand', true),
					'Article.is_new' => __('Is_New', true)
				),
				'filters' => array(
					'Article.object_id' => array(
						'filterType' => 'dropdown',
						'filterOptions' => $this->Article->find('list', array('conditions' => array('object_type' => 'collections'))),
						'conditions' => array('Article.object_id' => '{$value}')
					)
				)
			);
		} elseif ($objectType == 'brands') {
			$this->grid['SiteArticle'] = array(
				'conditions' => array('Article.object_type' => $objectType),
				'fields' => array('Article.modified', 'Category.title', 'Article.title'),
				'captions' => array('Category.title' => __('Category', true)),
				'hidden' => array('body'),
				'filters' => array(
					'Category.title' => array(
						'filterType' => 'dropdown',
						'filterOptions' => $this->Category->getOptions('brands'),
						'conditions' => array('Article.object_id' => '{$value}')
					)
				)
			);
		} elseif ($objectType == 'collections') {
			$this->grid['SiteArticle'] = array(
				'conditions' => array('Article.object_type' => $objectType),
				'fields' => array('Article.modified', 'Category.title', 'Article.title'),
				'captions' => array('Category.title' => __('Brand', true)),
				'hidden' => array('Article.body', 'Article.object_id'),
				'filters' => array(
					'Category.title' => array(
						'filterType' => 'dropdown',
						'filterOptions' => $this->Article->getOptions('brands'),
						'conditions' => array('Article.object_id' => '{$value}')
					)
				)
			);
		} else {
			$this->grid['SiteArticle'] = array(
				'conditions' => array('Article.object_type' => $objectType),
				'fields' => array('modified', 'title', 'featured', 'published'),
				'hidden' => array('body')
			);
		}
		$aArticles = $this->PCGrid->paginate('SiteArticle');
		$aTitles = array(
			'articles' => __('Articles', true),
			'news' => __('News', true),
			'photos' => __('Photos', true),
			'videos' => __('Videos', true),
			'pages' => __('Pages', true),
			'products' => __('Products', true),
			'brands' => __('Brands', true),
			'collections' => __('Collections', true),
			'subcategories' => __('Subcategories', true)
		);
		$this->set('pageTitle', $aTitles[$this->currMenu]);
		$this->set('objectType', $objectType);

		$aBrandOptions = $this->Article->find('list', array('conditions' => array('object_type' => 'brands')));
		$this->set('aBrandOptions', $aBrandOptions);

		$aCollections = $this->Article->findAllByObjectType('collections');
		$aCollectionBrands = array();
		foreach($aCollections as $item) {
			$aCollectionOptions[$item['Article']['id']] = $item['Article']['title'];
			$aCollectionBrands[$item['Article']['id']] = $item['Article']['object_id'];
		}

		$this->set('aCollectionOptions', $aCollectionOptions);
		$this->set('aCollectionBrands', $aCollectionBrands);
		$aCollectionOptions = $this->Article->find('list', array('conditions' => array('object_type' => 'collections')));
		$this->set('aCollectionOptions', $aCollectionOptions);
	}

	function articlesEdit($id = 0) {
		if (isset($this->data['Article']['object_type'])) {
			if ($this->data['Article']['object_type'] == 'brands') {
				$this->data['Article']['category_id'] = $this->data['Article']['object_id'];
			} elseif ($this->data['Article']['object_type'] == 'collections') {
				$this->data['Article']['brand_id'] = $this->data['Article']['object_id'];
				$brand = $this->Article->findById($this->data['Article']['brand_id']);
				$this->data['Article']['category_id'] = $brand['Article']['category_id'];
			} elseif ($this->data['Article']['object_type'] == 'subcategories') {
				$this->data['Article']['category_id'] = 20;
			} elseif ($this->data['Article']['object_type'] == 'products') {
				if ($this->data['Article']['category_id'] == 20) {
					$this->data['Article']['object_id'] = 20;
					$this->data['Article']['brand_id'] = 0;
					$this->data['Article']['collection_id'] = 0;
				} else {
					$this->data['Article']['collection_id'] = $this->data['Article']['object_id'];
					$this->data['Article']['subcategory_id'] = 0;
				}
			}
		}
		if (isset($this->data['Article']['price']) && !$this->data['Article']['price']) {
			$this->data['Article']['price'] = '0';
		}
		if (isset($this->data['Article']['sorting']) && !$this->data['Article']['sorting']) {
			$this->data['Article']['sorting'] = '1';
		}
		$aArticle = $this->PCArticle->adminEdit(&$id, &$lSaved);
		if ($lSaved) {
			// $data = $this->data['RegionObject'];
			// $this->RegionObject->save($this->data);
			$this->redirect('/admin/articlesEdit/'.$id);
		}

		if ($id) {
			$objectType = $aArticle['Article']['object_type'];

			$this->set('aTags', $this->Tag->getOptions());
			$this->set('aRelatedTags', $this->TagObject->getRelatedTags('Article', $id));

			unset($aArticle['Media']);
			$aArticle['Media'] = $this->Media->getMedia('Article', $aArticle['Article']['id']);
		} else {
			$objectType = $this->params['named']['Article.object_type'];

			// значения по умолчанию для статьи
			$aArticle['Article']['published'] = 1;
			$aArticle['Article']['is_active'] = 1;
		}
		$this->set('aArticle', $aArticle);

		$this->currMenu = $objectType;

		if ($objectType == 'brands' || $objectType == 'collections' || $objectType == 'products') {
			$aCategoryOptions = $this->Category->getOptions('brands');
			$this->set('aCategoryOptions', $aCategoryOptions);
			$aSubcategoryOptions = $this->Article->getOptions('subcategories');
			$this->set('aSubcategoryOptions', $aSubcategoryOptions);

			$aBrands = $this->Article->find('all', array('conditions' => array('Article.object_type' => 'brands'), 'order' => 'Article.object_id'));
			$aBrandOptions = array();
			$aBrandCategories = array();
			foreach($aBrands as $item) {
				$aBrandCategories[$item['Article']['object_id']][] = $item['Article']['id'];
				$aBrandOptions[$item['Article']['id']] = $item['Article']['title'];
			}
			$this->set('aBrandCategories', $aBrandCategories);
			$this->set('aBrandOptions', $aBrandOptions);

			$aCollections = $this->Article->find('all', array('conditions' => array('Article.object_type' => 'collections'), 'order' => 'Article.object_id'));
			$aCollectionOptions = array();
			$aBrandCollections = array();
			foreach($aCollections as $item) {
				$aBrandCollections[$item['Article']['object_id']][] = $item['Article']['id'];
				$aCollectionOptions[$item['Article']['id']] = $item['Article']['title'];
			}
			$this->set('aBrandCollections', $aBrandCollections);
			$this->set('aCollectionOptions', $aCollectionOptions);
		}
		if ($id) {
			$aTitles = array(
				'articles' => __('Edit article', true),
				'news' => __('Edit "News" article', true),
				'brands' => __('Edit brand', true),
				'collections' => __('Edit collection', true),
				'photos' => __('Edit "Photos" article', true),
				'pages' => __('Edit static page', true),
				'products' => __('Edit product', true),
				'subcategories' => __('Edit subcategory', true)
			);
		} else {
			$aTitles = array(
				'articles' => __('New article', true),
				'news' => __('New "News" article', true),
				'brands' => __('New brand', true),
				'collections' => __('New collection', true),
				'photos' => __('New "Photos" article', true),
				'pages' => __('New static page', true),
				'products' => __('New product', true),
				'subcategories' => __('New subcategory', true)
			);
		}
		$this->set('pageTitle', $aTitles[$this->currMenu]);
		$this->set('objectType', $objectType);

		if ($objectType == 'photos' && $id) {
			$row = $this->Media->find('first',
				array(
					'fields' => array('object_id', 'COUNT(*) AS media_count'),
					'conditions' => array('Media.object_type' => 'Article', 'Media.object_id' => $id, 'media_type' => 'image'),
					'group' => array('object_id')
				)
			);
			$this->Stat->setItem('Article', $id, 'photos', ($row && $row[0]['media_count']) ? $row[0]['media_count'] : 0);
		}

		$productBrandID = 0;
		$productCategoryID = 0;
		if ($objectType == 'products' && $id) {
			if ($aArticle['Article']['object_id'] == 20) {
				$productCategoryID = 20;
			} else {
				$productCollection = $this->Article->findById($aArticle['Article']['object_id']);
				$productBrandID = $productCollection['Article']['object_id'];
				$productBrand = $this->Article->findById($productCollection['Article']['object_id']);
				$productCategoryID = $productBrand['Article']['object_id'];
			}
		}
		$this->set('productBrandID', $productBrandID);
		$this->set('productCategoryID', $productCategoryID);
	}
/*
	function process() {
		$aProducts = $this->Article->find('all');
		foreach($aProducts as $aArticle) {
			$productCollectionID = 0;
			$productBrandID = 0;
			$productCategoryID = 0;
			if ($aArticle['Article']['object_type'] == 'products') {
				if ($aArticle['Article']['object_id'] == 20) {
					$productCategoryID = 20;
				} else {
					$productCollectionID = $aArticle['Article']['object_id'];
					$productCollection = $this->Article->findById($aArticle['Article']['object_id']);
					$productBrandID = $productCollection['Article']['object_id'];
					$productBrand = $this->Article->findById($productCollection['Article']['object_id']);
					$productCategoryID = $productBrand['Article']['object_id'];

				}
				if (!$productCategoryID) {
					echo $aArticle['Article']['id'].'<br>';
				}

				$this->Article->save(array(
					'id' => $aArticle['Article']['id'],
					'category_id' => $productCategoryID,
					'brand_id' => $productBrandID,
					'collection_id' => $productCollectionID
				));
			} elseif ($aArticle['Article']['object_type'] == 'collections') {
				if ($aArticle['Article']['object_id'] == 20) {
					$productCategoryID = 20;
				} else {
					$productBrandID = $aArticle['Article']['object_id'];
					$productBrand = $this->Article->findById($productCollection['Article']['object_id']);
					$productCategoryID = $productBrand['Article']['object_id'];

				}
				if (!$productBrandID) {
					echo $aArticle['Article']['id'].'<br>';
				}

				$this->Article->save(array(
					'id' => $aArticle['Article']['id'],
					'category_id' => $productCategoryID,
					'brand_id' => $productBrandID,
					'collection_id' => $productCollectionID
				));
			}
		}
		exit;
	}
	*/

	function commentsList() {
		$this->grid['SiteComment'] = array(
			'fields' => array('created', 'username', 'email', 'body', 'published'),
			'captions' => array('Comment.object_id' => __('URL', true)),
			'hidden' => array('Comment.object_type', 'Comment.object_id', 'Article.id', 'Article.object_id', 'Article.object_type', 'Article.teaser', 'Article.title', 'Comment.body'),
			'order' => array('Comment.created' => 'desc')
		);
		$this->PCGrid->paginate('SiteComment');
	}

	function commentsPublish() {
		if (isset($this->data['ids']) && isset($this->data['publish'])) {
			$aID = explode(',', $this->data['ids']);
			$this->Comment->publish($aID, $this->data['publish']);

			// recalculate stats for updated articles
			$aUpdated = $this->Comment->find('all',
				array(
					'fields' => array('object_id', 'COUNT(*) AS comment_count'),
					'conditions' => array('Comment.id' => $aID),
					'group' => array('object_id')
				)
			);

			$aObjectID = array();
			foreach($aUpdated as $row) {
				$aObjectID[] = $row['Comment']['object_id'];
			}

			$aUpdated = $this->Comment->find('all',
				array(
					'fields' => array('object_id', 'SUM(Comment.published) AS comment_count'),
					'conditions' => array('Comment.object_id' => $aObjectID),
					'group' => array('object_id')
				)
			);
			foreach($aUpdated as $row) {
				$this->Stat->setItem('Article', $row['Comment']['object_id'], 'comments', $row[0]['comment_count']);
			}

			$this->redirect($this->data['back_url']);
			exit();
		}
		$this->redirect('/admin/commentsList');
	}


	function categories() {
		$this->grid['Article'] = array(
			'conditions' => array('Article.object_type' => $objectType),
			'fields' => array('modified', 'Category.title', 'title', 'featured', 'published'),
			'hidden' => array('body'),
			'captions' => array('Category.title' => __('Category', true)),
			'filters' => array(
				'Category.title' => array(
					'filterType' => 'dropdown',
					'filterOptions' => $this->Category->getOptions($objectType),
					'conditions' => array('Article.object_id' => '{$value}')
				)
			)
		);
		$this->PCGrid->paginate('SiteArticle');
	}

	function photoslider() {
		$id = PHOTOSLIDER_ID;
		$aArticle = $this->PCArticle->adminEdit($id, &$lSaved);
		if ($lSaved) {
			$this->redirect('/admin/photoslider/');
		}

		unset($aArticle['Media']);
		$aArticle['Media'] = $this->Media->getMedia('Article', $aArticle['Article']['id']);
		$this->set('aArticle', $aArticle);

		$this->currMenu = 'photoslider';

		$row = $this->Media->find('first',
			array(
				'fields' => array('object_id', 'COUNT(*) AS media_count'),
				'conditions' => array('Media.object_type' => 'Article', 'Media.object_id' => $id, 'media_type' => 'image'),
				'group' => array('object_id')
			)
		);
		$this->Stat->setItem('Article', $id, 'photos', ($row && $row[0]['media_count']) ? $row[0]['media_count'] : 0);
	}

	function settings() {
		if (isset($this->data)) {

			$this->data['Settings']['SHOW_PRICE'] = (isset($this->data['Settings']['SHOW_PRICE']) && $this->data['Settings']['SHOW_PRICE'])  ? '1' : '0';
			$this->data['Settings']['SHOW_SEARCH_ACTIVE'] = (isset($this->data['Settings']['SHOW_SEARCH_ACTIVE']) && $this->data['Settings']['SHOW_SEARCH_ACTIVE'])  ? '1' : '0';

			$this->data['Settings']['SHOW_BLOCK_FEATURED'] = (isset($this->data['Settings']['SHOW_BLOCK_FEATURED']) && $this->data['Settings']['SHOW_BLOCK_FEATURED'])  ? '1' : '0';
			$this->data['Settings']['SHOW_BLOCK_NEWS'] = (isset($this->data['Settings']['SHOW_BLOCK_NEWS']) && $this->data['Settings']['SHOW_BLOCK_NEWS'])  ? '1' : '0';
			$this->data['Settings']['SHOW_BLOCK_STOCK'] = (isset($this->data['Settings']['SHOW_BLOCK_STOCK']) && $this->data['Settings']['SHOW_BLOCK_STOCK'])  ? '1' : '0';
			$this->data['Settings']['SHOW_BLOCK_AWAY'] = (isset($this->data['Settings']['SHOW_BLOCK_AWAY']) && $this->data['Settings']['SHOW_BLOCK_AWAY'])  ? '1' : '0';

			$php = "<?\r\n";
			foreach($this->data['Settings'] as $key => $val) {
				$php.= "define('{$key}', '{$val}');\r\n";
			}
			file_put_contents(ROOT.DS.'app'.DS.'config'.DS.'extra.php', $php);
			$this->redirect('/admin/settings?success=1');
			return;
		}
		$data = array(
			array('caption' => __('Price prefix', true), 'field' => 'Settings.PU_', 'value' => PU_),
			array('caption' => __('Price postfix', true), 'field' => 'Settings._PU', 'value' => _PU),
			array('caption' => __('BYR course', true), 'field' => 'Settings.BYR_COURSE', 'value' => BYR_COURSE),
			array('caption' => __('Show prices', true), 'field' => 'Settings.SHOW_PRICE', 'value' => SHOW_PRICE, 'input' => 'checkbox'),
			array('caption' => __('Show active in search', true), 'field' => 'Settings.SHOW_SEARCH_ACTIVE', 'value' => SHOW_SEARCH_ACTIVE, 'input' => 'checkbox')
		);
		$data2 = array(
				array('caption' => __('New!!!', true), 'field' => 'Settings.SHOW_BLOCK_FEATURED', 'value' => SHOW_BLOCK_FEATURED, 'input' => 'checkbox'),
				array('caption' => __('Is_New', true), 'field' => 'Settings.SHOW_BLOCK_NEWS', 'value' => SHOW_BLOCK_NEWS, 'input' => 'checkbox'),
				array('caption' => __('Active', true), 'field' => 'Settings.SHOW_BLOCK_STOCK', 'value' => SHOW_BLOCK_STOCK, 'input' => 'checkbox'),
				array('caption' => __('Pending', true), 'field' => 'Settings.SHOW_BLOCK_AWAY', 'value' => SHOW_BLOCK_AWAY, 'input' => 'checkbox')
		);

		$this->set('data', $data);
		$this->set('data2', $data2);
	}

	function statistics() {
		$data = array();
		$errors = array();

		$timeOfDay = (24 * 60 * 60 * 1000); //jQuery Flot issue - PHP fix;

		$time = time();
		$todayScriptDate = date('Ymd');
		$yesterdayScriptDate = date('Ymd', $time - 1 * 24 * 3600);
		$weekScriptDate = date('Ymd', $time - 7 * 24 * 3600);
		$monthScriptDate = date('Ymd', $time - 30 * 24 * 3600);

		$todayFormDate = date('d.m.Y');
		$yesterdayFormDate = date('d.m.Y', $time - 1 * 24 * 3600);
		$weekFormDate = date('d.m.Y', $time - 7 * 24 * 3600);
		$monthFormDate = date('d.m.Y', $time - 30 * 24 * 3600);

		if (isset($this->data)) {
			$this->data['dates']['for'] = (isset($this->data['dates']['for']) && $val = $this->data['dates']['for'])  ? $val : $todayFormDate;
			$this->data['dates']['from'] = (isset($this->data['dates']['from']) && $val = $this->data['dates']['from'])  ? $val : $weekFormDate;
		}

		App::import('Vendor', 'Yapi', array('file' => '../vendors/yapi/yapi.class.php'));
		$api = new Yapi(YAPI_appId, YAPI_appPass, YAPI_appToken, YAPI_login, YAPI_password);

		if (!$api) {
			$this->errorHandler(1);
			return false;
		}

		$viewData['todayFormDate'] = $todayFormDate;
		$viewData['yesterdayFormDate'] = $yesterdayFormDate;
		$viewData['weekFormDate'] = $weekFormDate;
		$viewData['monthFormDate'] = $monthFormDate;

		$result = $api->MakeQuery('/counters');

		if (!$result) {
			$this->errorHandler(2);
			return false;
		}

		$counters = $api->result['counters'];
		if (!is_array($counters) || (!count($counters))) {
			$this->errorHandler(3);
			return false;
		}

		$counterid = 19619107; //marry-me.by counter;
		$viewData['counterid'] = $counterid;

		$convertor = $this->data['dates']['from'] ? $this->data['dates']['from'] : $weekFormDate;
		if (!$convertor) {
			$this->errorHandler(4);
			return false;
		}

		$year = substr($convertor, 6, 4);
		$month = substr($convertor, 3, 2);
		$day = substr($convertor, 0, 2);
		$dateFrom = $year.$month.$day;
		$dateFromForm = $day.'.'.$month.'.'.$year;

		$convertor = $this->data['dates']['for'] ? $this->data['dates']['for'] : $todayFormDate;
		if (!$convertor) {
			$this->errorHandler(5);
			return false;
		}

		$year = substr($convertor, 6, 4);
		$month = substr($convertor, 3, 2);
		$day = substr($convertor, 0, 2);
		$dateFor = $year.$month.$day;
		$dateForForm = $day.'.'.$month.'.'.$year;

		if ($dateFrom > $dateFor) {
			$this->errorHandler(6);
			return false;
		}
		if ($dateFrom == $dateFor) {
			$time = mktime(1,1,1,(int) $month, (int) $day, (int)$year);
			$fromTime = $time - (24 * 3600);

			$dateFrom = date('Ymd', $fromTime);
			$dateFromForm = date('d.m.Y', $fromTime);
		}

		$viewData['dateFromForm'] = $dateFromForm;
		$viewData['dateForForm'] = $dateForForm;

		$group = 'day';
		$params = array(
			'id' => $counterid,
			'date1' => $dateFrom,
			'date2' => $dateFor,
			'group' => $group,
		);

		$result = $api->MakeQuery('/stat/sources/summary', $params);
		if (!$result || !isset($api->result['data']) || !is_array($api->result['data'])) {
			$this->errorHandler(7);
			return false;
		}

		$engines = array();
		$forwards = array();
		$inbounds = array();
		$links = array();

		$counter = 0;
		foreach ($api->result['period_groups'] as $key=>$item) {
			$year = substr($item['0'], 0, 4);
			$month = substr($item['0'], 4, 2);
			$day = substr($item['0'], 6, 2);

			$date = $day.'.'.$month.'.'.$year;
			$time = strtotime("$year-$month-$day UTC") * 1000;

			$engines[$counter][] = $time;
			$engines[$counter][] = $api->result['data'][0]['visits'][$key];

			$forwards[$counter][] = $time+(1*($timeOfDay/5));;
			$forwards[$counter][] = $api->result['data'][1]['visits'][$key];

			$inbounds[$counter][] = $time+(2*($timeOfDay/5));;
			$inbounds[$counter][] = $api->result['data'][2]['visits'][$key];

			$links[$counter][] = $time+(3*($timeOfDay/5));;
			$links[$counter][] = $api->result['data'][3]['visits'][$key];

			$counter++;
		}
		$fromArr[0] = $engines;
		$fromArr[1] = $forwards;
		$fromArr[2] = $inbounds;
		$fromArr[3] = $links;

		$jsonData['jsonFromArr'] = json_encode($fromArr);

		$datesArr = $api->result['period_groups']; // needs for the next request balancing; don't touch this!!!

		$result = $api->MakeQuery('/stat/traffic/summary', $params);
		if (!$result || !is_array($api->result['data'])) {
			$this->errorHandler(8);
			return false;
		}

		$pageviews = array();
		$visitors = array();
		$newvisitors = array();
		$visits = array();
		$wday = array();

		$year1 = substr($api->result['date1'], 0, 4);
		$month1 = substr($api->result['date1'], 4, 2);
		$day1 = substr($api->result['date1'], 6, 2);
		$date1 = $day1.'.'.$month1.'.'.$year1;

		$year2 = substr($api->result['date2'], 0, 4);
		$month2 = substr($api->result['date2'], 4, 2);
		$day2 = substr($api->result['date2'], 6, 2);
		$date2 = $day2.'.'.$month2.'.'.$year2;

		$date = $date1.' - '.$date2;

		$total = array(
			null,
			null,
			$date,
			$api->result['totals']['page_views'],
			$api->result['totals']['visits'],
			$api->result['totals']['visitors'],
			$api->result['totals']['new_visitors']
		);

		$viewData['total'] = $total;

		$counter = 0;
		foreach ($datesArr as $key=>$item) {
			$year = substr($item['0'], 0, 4);
			$month = substr($item['0'], 4, 2);
			$day = substr($item['0'], 6, 2);

			$date = $day.'.'.$month.'.'.$year;
			$time = strtotime("$year-$month-$day UTC") * 1000;

			$pageviews[$counter][] = $time;
			$pageviews[$counter][] = array_key_exists($key, $api->result['data']) ? $api->result['data'][$key]['page_views'] : 0;

			$visitors[$counter][] = $time+(2*($timeOfDay/5));
			$visitors[$counter][] = array_key_exists($key, $api->result['data']) ? $api->result['data'][$key]['visitors'] : 0;

			$newvisitors[$counter][] = $time+(3*($timeOfDay/5));
			$newvisitors[$counter][] = array_key_exists($key, $api->result['data']) ? $api->result['data'][$key]['new_visitors'] : 0;

			$visits[$counter][] = $time+(1*($timeOfDay/5));
			$visits[$counter][] = array_key_exists($key, $api->result['data']) ? $api->result['data'][$key]['visits'] : 0;

			$counter++;
		}
		$visitsArr[0] = $pageviews;
		$visitsArr[1] = $visits;
		$visitsArr[2] = $visitors;
		$visitsArr[3] = $newvisitors;

		$jsonData['jsonVisitsArr'] = json_encode($visitsArr);

		$result = $api->MakeQuery('/stat/sources/phrases', $params);
		if (!$result || !is_array($api->result['data'])) {
			$this->errorHandler(9);
			return false;
		}

		$words = array();
		$wordsTotal = 0;
		$counter = 0;
		foreach ($api->result['data'] as $datakey=>$dataitem) {
			$words[$counter]['max'] = 0;
			$words[$counter]['total'] = 0;
			$words[$counter]['name'] = $dataitem['name'];
			$words[$counter]['id'] = $dataitem['id'];

			$counter2 = 0;
			foreach ($api->result['period_groups'] as $key=>$item) {
				$year = substr($item['0'], 0, 4);
				$month = substr($item['0'], 4, 2);
				$day = substr($item['0'], 6, 2);

				$date = $day.'.'.$month.'.'.$year;
				$time = strtotime("$year-$month-$day UTC") * 1000;

				$words[$counter]['days'][$counter2][] = $time;
				$words[$counter]['days'][$counter2][] = $dataitem['visits'][$key];
				$words[$counter]['total'] = $words[$counter]['total'] + $dataitem['visits'][$key];
				$words[$counter]['max'] = ($dataitem['visits'][$key] > $words[$counter]['max']) ? $dataitem['visits'][$key] : $words[$counter]['max'];

				$counter2++;
			}
			$words[$counter]['days'] = json_encode($words[$counter]['days']);
			$wordsTotal += $words[$counter]['total'];
			$counter++;
		}

		$viewData['words'] = $words;
		$viewData['wordsTotal'] = $wordsTotal;

		$result = $api->MakeQuery('/stat/sources/search_engines', $params);

		if (!$result || !is_array($api->result['data'])) {
			$this->errorHandler(10);
			return false;
		}

		$sEngines = array();
		$counter = 0;
		foreach ($api->result['data'] as $datakey=>$dataitem) {
			$sEngines[$counter]['max'] = 0;
			$sEngines[$counter]['total'] = 0;
			$sEngines[$counter]['name'] = $dataitem['name'];
			$sEngines[$counter]['id'] = $dataitem['id'];

			$counter2 = 0;
			foreach ($api->result['period_groups'] as $key=>$item) {
				$year = substr($item['0'], 0, 4);
				$month = substr($item['0'], 4, 2);
				$day = substr($item['0'], 6, 2);

				$date = $day.'.'.$month.'.'.$year;
				$time = strtotime("$year-$month-$day UTC") * 1000;

				$sEngines[$counter]['days'][$counter2][] = $time;
				$sEngines[$counter]['days'][$counter2][] = $dataitem['visits'][$key];

				$sEngines[$counter]['total'] = $sEngines[$counter]['total'] + $dataitem['visits'][$key];
				$sEngines[$counter]['max'] = ($dataitem['visits'][$key] > $sEngines[$counter]['max']) ? $dataitem['visits'][$key] : $sEngines[$counter]['max'];

				$counter2++;
			}
			$counter++;
		}
		$SEnginesData = '';
		$jsonSEnginesData = '';
		foreach ($sEngines as $item) {
			$oneEngine = array();

			$oneEngine['label'] = $item['name'];
			$oneEngine['data'] = $item['days'];

			$SEnginesData[] = $oneEngine;
		}
		$jsonSEnginesData = json_encode($SEnginesData);

		$jsonData['jsonSEnginesData'] = $jsonSEnginesData;

		$data = array(
			'dateFromInput' => array(
				'caption' => __('DateStart', true),
				'field' => 'Statistics.dates.from',
				'value' => $dateFromForm
			),
			'dateForInput' => array(
				'caption' => __('DateEnd', true),
				'field' => 'Statistics.dates.for',
				'value' => $dateForForm
			),
			'dateFromInputHidden' => array(
				'caption' => __('DateStart', true),
				'field' => 'Statistics.dates.from',
				'value' => $dateFromForm,
				'input' => 'hidden'
			),
			'dateForInputHidden' => array(
				'caption' => __('DateEnd', true),
				'field' => 'Statistics.dates.for',
				'value' => $dateForForm,
				'input' => 'hidden'
			),
		);

		$this->set('data', $data);
		$this->set('errors', $errors);
		$this->set('jsonData', $jsonData);
		$this->set('viewData', $viewData);
		$this->render('statistics');
		return true;
	}

	private $errors = array();
	private function errorHandler($code = 0, $action = 'statistics', $text = null) {
			if (!$text) {
				switch ($code) {
					case 1:
						$text ='Ошибка создания объекта Статистики. Сообщите администратору.';
						break;
					case 2:
						$text ='Ошибка получения информации с сервера статистики. Сообщите администратору.';
						break;
					case 3:
						$text ='Ошибка инициализации счетчиков или не объявлено ни одного счетчика. Сообщите администратору.';
						break;
					case 4:
						$text ='Ошибка Даты - вы неверно указали дату начала периода.';
						break;
					case 5:
						$text ='Ошибка Даты - вы неверно указали дату конца периода.';
						break;
					case 6:
						$text ='Ошибка даты - дата начала периода не может быть больше даты окончания.';
						break;
					case 7:
						$text ='Ошибка /stat/sources/summary или нет данных для текущего периода. Сообщите администратору.';
						break;
					case 8:
						$text ='Ошибка /stat/traffic/summary или нет данных для текущего периода. Сообщите администратору.';
						break;
					case 9:
						$text ='Ошибка /stat/sources/phrases или нет данных для текущего периода. Сообщите администратору.';
						break;
					case 10:
						$text = 'Ошибка получения информации про поисковые системы. Сообщите администратору.';
						break;
					case 0:
					default:
						$text = 'Ошибка, не определенная в спецификации. Сообщите администратору.';
						break;
				}
			}

			$i = count($this->errors);
			$this->errors[$i]['code'] = $code;
			$this->errors[$i]['text'] = $text;
			$this->set('errors', $this->errors);
			$this->render($action);
	}

	function tagcloud() {
		$this->grid['TagcloudLink'] = array(
			'order' => array('size' => 'desc')
		);
		$this->PCGrid->paginate('TagcloudLink');
	}

	function companiesList() {
		$this->Article = $this->SiteCompany;
		$this->currMenu = 'companies';
		$this->grid['SiteCompany'] = array(
			'fields' => array('Company.id', 'Article.title', 'Company.phones', 'Company.address', 'Company.email', 'Company.site_url', 'Article.published'),
			'captions' => array('Company.site_url' => __('Site', true)),
			'conditions' => array('Article.object_type' => 'companies'),
			'order' => array('id' => 'desc')
		);
		$this->PCGrid->paginate('SiteCompany');
	}

	function companiesEdit($id = 0) {
		$this->Article = $this->SiteCompany;
		$objectType = 'companies';
		$this->currMenu = $objectType;
		if (isset($this->data['Company']) && $this->data['Company']) {
			$this->data['Company']['site_url'] = str_replace('http://', '', $this->data['Company']['site_url']);
		}
		$aArticle = $this->PCArticle->adminEdit(&$id, &$lSaved);
		if ($lSaved) {
			$this->redirect('/admin/companiesEdit/'.$id);
		}

		if ($id) {
			// $aCompany = $this->SiteCompany->findById($company_id);
			unset($aArticle['Media']);
			$aArticle['Media'] = $this->Media->getMedia('Article', $aArticle['Article']['id']);
			// $aArticle['Gallery'] = $this->Media->getMedia('Company', $aArticle['Article']['id']);
		} else {
			// значения по умолчанию для статьи
			$aArticle['Article']['published'] = 1;
		}
		$this->set('aArticle', $aArticle);
		$this->set('objectType', $objectType);
	}

	function companiesGallery($id) {
		$this->Article = $this->SiteCompany;
		$aArticle = $this->SiteCompany->findById($id);
		unset($aArticle['Media']);
		$aArticle['Media'] = $this->Media->getMedia('Company', $aArticle['Article']['id']);
		$this->set('aArticle', $aArticle);
	}
/*
	function update() {
		$aArticles = $this->Article->find('all', array('conditions' => array('Article.object_type' => 'products')));
		foreach($aArticles as $article) {
			$this->Media->recalcStats('Article', $article['Article']['id']);
		}
		exit;
	}

	function update2() {
		App::import('Helper', 'articles.PHTranslit');
		App::import('Helper', 'Router');
		$this->Router = new RouterHelper();
		$this->Router->PHTranslit = new PHTranslitHelper();
		$aArticles = $this->Article->findAllByObjectType(array('collections', 'brands', 'products'));
		foreach ($aArticles as $article) {
			$data = array('id' => $article['Article']['id'], 'page_id' => $this->Router->PHTranslit->convert($article['Article']['title'], true));
			$this->Article->save($data);
		}
		echo count($aArticles).' records processed';
		exit;
	}
	*/
	function utils() {

	}

	function removeImageCache() {
		$this->set('stats', $this->Media->removeImageCache());
	}

	function removePornoLinks() {
		$this->layout = false;
		// $re = '/<a style="text-decoration: none;" href="http:\/\/goldpussy[a-z\.\/\-]+"> <\/a>/';
		$re = '/<a href="http:\/\/www\.gfc\.by/';
		$aRows = $this->Article->find('all', array('conditions' => array('body LIKE "%http%"')));
		fdebug($aRows);
		/*
		foreach($aRows as $row) {
			$body = preg_replace($re, '<a rel="nofollow" href="http://www.gfc.by', $row['Article']['body']);
			
			$this->Article->create();
			$this->Article->save(array('id' => $row['Article']['id'], 'body' => $body));
		}
		*/
		exit;
	}
}