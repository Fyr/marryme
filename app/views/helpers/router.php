<?
class RouterHelper extends AppHelper {
	var $helpers = array('articles.PHTranslit');

	function url($aArticle) {
		$dir = $this->getDir($aArticle['Article']['object_type']);
		$id = (isset($aArticle['Article']['page_id']) && $aArticle['Article']['page_id']) ? $aArticle['Article']['page_id'] : $aArticle['Article']['id'];
		/*
		if ($aArticle['Article']['object_type'] == 'companies') {
			return '/prazdnichnie-agentstva/'.$id;
		}
		*/
		if ($aArticle['Article']['object_type'] == 'photos') {
			return $dir.'view/'.$id.'.html';
		}
		if ($aArticle['Article']['object_type'] == 'pages') {
			return $dir.'show/'.$id.'.html';
		} elseif (in_array($aArticle['Article']['object_type'], array('news', 'articles', 'companies'))) {
			return $dir.$id.'.html';
		} else {
			$category = (isset($aArticle['Category']['id']) && $aArticle['Category']['title']) ? $this->getCat($aArticle['Category']) : 'empty';
		}

		if ($aArticle['Article']['object_type'] == 'products') {
			$id = $aArticle['Article']['id'];
			if (isset($aArticle['Article']['page_id']) && $aArticle['Article']['page_id']) {
				$id.= '-'.$aArticle['Article']['page_id'];
			}
		}
		return '/'.$category.$dir.$id.'.html';
	}
	
	function getCat($aCategory) {
		if (isset($aCategory['id']) && $aCategory['id'] == 18) {
			return 'svadebnye-platya';
		} elseif (isset($aCategory['id']) && $aCategory['id'] == 19) {
			return 'vechernie-platya';
		} elseif (isset($aCategory['id']) && $aCategory['id'] == 20) {
			return 'svadebnye-aksessuary';
		}
		$category = (isset($aCategory['id']) && $aCategory['title']) ? $aCategory['title'] : '';
		return $this->PHTranslit->convert($category, true).'-'.$aCategory['id'];
	}

	function catUrl($objectType, $aCategory = null) {
		$dir = $this->getDir($objectType);
		$category = (isset($aCategory['id']) && $aCategory['title']) ? $aCategory['title'] : '';
		$url = '/'.$this->getCat($aCategory).$dir;
		return ($category) ? $url : $dir;
	}

	function getDir($objectType = 'articles') {
		$aDir = array(
			'photos' => 'photo',
			'videos' => 'video',
			'products' => 'product',
			'companies' => 'prazdnichnie-agentstva'
		);
		$dir = (isset($aDir[$objectType])) ? $aDir[$objectType] : $objectType;
		return '/'.$dir.'/';
	}

	function transformPageParams($objectType, $url, $filterURL = '') {
		if ($objectType == 'brands') {
			$url = str_replace('/article/view_brand/page:', '/'.$this->params['url']['url'].'?page=', $url);
			return str_replace('?page=1', '', $url);
		}
		$category = (isset($this->params['category']) && $this->params['category']) ? '/'.$this->params['category'] : '';
		$url = str_replace(array('/article/', '/products/'), $category.$this->getDir($objectType), $url);
		return str_replace('page/1', '', str_replace('index/', '', str_replace('page:', 'page/', $url)));
	}
}
