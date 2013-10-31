<?
class FeedbackController extends SiteController {
	const PER_PAGE = 10;

	var $components = array('Email', 'SiteEmail', 'comments.PCComment', 'grid.PCGrid');
	var $helpers = array('core.PHA', 'Time', 'core.PHTime', 'articles.HtmlArticle');
	var $uses = array('Contact', 'Comment');

	function index() {
		$this->aBreadCrumbs = array('/' => 'Главная', 'Отзывы');
		$captchaKey = md5(_SALT.mt_rand()); // any random text

		if (isset($this->data['send']) && isset($this->data['Contact'])
				&& $this->Contact->saveAll($this->data['Contact'], array('validate' => 'only'))) {
					/*
			if (!$this->data['Contact']['username']) {
				$this->errMsg[] = __('Input your name', true);
			}
			if (!$this->data['Contact']['email']) {
				$this->errMsg[] = __('Input your email address', true);
			} elseif (!AppModel::isEmailValid($this->data['Contact']['email'])) {
				$this->errMsg[] = __('Incorrect email address', true);
			}
			if (!$this->data['Contact']['body']) {
				$this->errMsg[] = __('Input the message', true);
			}
			if (substr(md5(_SALT.$this->data['Contact']['captcha_q']), 0, 6) !== $this->data['Contact']['captcha']) {
				$this->errMsg[] = __('Incorrect text on image', true);
			}

			if (!$this->errMsg) {
			// if ($this->Contact->validates()) {
			*/
				$this->SiteEmail->to = EMAIL_ADMIN;
			    $this->SiteEmail->subject = 'A message from '.DOMAIN_NAME;
			    $this->SiteEmail->replyTo = $this->data['Contact']['email'];
			    $this->SiteEmail->from = $this->data['Contact']['email'];
			    $this->SiteEmail->template = 'contact_us';
			    $this->SiteEmail->sendAs = 'html';


			    $this->data['Contact']['body'] = nl2br(str_replace(array('<', '>'), array('&lt;', '&gt;'), $this->data['Contact']['body']));
			    $this->set('data', $this->data);

			    $this->SiteEmail->send();

			    $this->data['Comment'] = $this->data['Contact'];
				$this->PCComment->post('Guestbook', '0', 1);

				$this->redirect('/feedback/success#send');
				exit;
			} else {
				$this->aErrFields['Contact'] = $this->Contact->invalidFields();
			}

		//}

		$this->set('data', $this->data);
		$this->set('captchaKey', $captchaKey);

		$this->grid['Comment'] = array(
			'conditions' => array('published' => 1),
			'order' => array('Comment.created' => 'desc'),
			'limit' => self::PER_PAGE
		);

		$aComments = $this->PCGrid->paginate('Comment');
		$this->set('aComments', $aComments);
	}

	function success() {
		$this->grid['Comment'] = array(
			'conditions' => array('published' => 1),
			'order' => array('Comment.created' => 'desc'),
			'limit' => self::PER_PAGE
		);

		$aComments = $this->PCGrid->paginate('Comment');
		$this->set('aComments', $aComments);
	}
/*
	function view($id) {
		$aArticle = $this->Brand->findById($id);
		$aArticle['Article'] = $aArticle['Brand'];
		$this->set('aArticle', $aArticle);

		$this->pageTitle = (isset($aArticle['Seo']['title']) && $aArticle['Seo']['title']) ? $aArticle['Seo']['title'] : $aArticle['Article']['title'];
		$this->data['SEO'] = $aArticle['Seo'];

		$this->aBreadCrumbs = array('/' => 'Home', '/brands/' => 'Brands', 'View brand');
	}
*/
}
