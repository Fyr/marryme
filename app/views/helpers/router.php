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
			$category = (isset($aArticle['Category']['id']) && $aArticle['Category']['title']) ? $this->PHTranslit->convert($aArticle['Category']['title'], true).'-'.$aArticle['Category']['id'] : 'empty';
		}

		if ($aArticle['Article']['object_type'] == 'products') {
			$id = $aArticle['Article']['id'];
			if (isset($aArticle['Article']['page_id']) && $aArticle['Article']['page_id']) {
				$id.= '-'.$aArticle['Article']['page_id'];
			}
		}
		return '/'.$category.$dir.$id.'.html';
	}

	function catUrl($objectType, $aCategory = null) {
		$category = (isset($aCategory['id']) && $aCategory['title']) ? $aCategory['title'] : '';
		$dir = $this->getDir($objectType);
		$url = '/'.$this->PHTranslit->convert($category, true).'-'.$aCategory['id'].$dir;
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
		$category = (isset($this->params['category']) && $this->params['category']) ? '/'.$this->params['category'] : '';
		$url = str_replace(array('/article/', '/products/'), $category.$this->getDir($objectType), $url);
		return str_replace('page/1', '', str_replace('index/', '', str_replace('page:', 'page/', $url)));
	}
}
