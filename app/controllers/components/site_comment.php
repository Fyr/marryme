<?
class SiteCommentComponent extends Object {

	var $components = array('comments.PCComment');

	function initialize(&$controller, $settings = array()) {
		// saving the controller reference for later use
		$this->_ = &$controller;
	}

	function listForm($articleID) {
		if (in_array($this->_->objectType, array('articles', 'news', 'products'))) {
			$captchaKey = md5(_SALT.mt_rand());
			if (isset($this->_->data['send']) && isset($this->_->data['Contact'])
					&& $this->_->Contact->saveAll($this->_->data['Contact'], array('validate' => 'only'))) {
				$this->_->data['Comment'] = $this->_->data['Contact'];
				$this->_->PCComment->post('Comment', $articleID, 1);
				return $this->_->redirect('/feedback/success?comment=1#send');
			} else {
				$this->_->aErrFields['Contact'] = $this->_->Contact->invalidFields();
			}
			$this->_->set('data', $this->_->data);
			$this->_->set('captchaKey', $captchaKey);
			$this->_->grid['Comment'] = array(
				'conditions' => array('object_type' => 'Comment', 'object_id' => $articleID, 'published' => 1),
				'order' => array('Comment.created' => 'desc'),
				'limit' => 1000
			);

			$aComments = $this->_->PCGrid->paginate('Comment');
			$this->_->set('aComments', $aComments);
		}
	}
}
?>