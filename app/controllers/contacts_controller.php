<?
class ContactsController extends SiteController {
	var $components = array('Email', 'SiteEmail');
	var $helpers = array('core.PHA', 'Time', 'core.PHTime', 'articles.HtmlArticle');
	var $uses = array('Contact');

	function index() {
		$this->aBreadCrumbs = array('/' => 'Главная', 'Контакты');
		$captchaKey = md5(_SALT.mt_rand()); // any random text

		if (isset($this->data['send']) && $this->Contact->saveAll($this->data['Contact'], array('validate' => 'only'))) {
			    $this->SiteEmail->to = EMAIL_ADMIN;
			    $this->SiteEmail->subject = 'Сообщение сайта '.DOMAIN_NAME;
			    $this->SiteEmail->replyTo = $this->data['Contact']['email'];
			    $this->SiteEmail->from = $this->data['Contact']['email'];
			    $this->SiteEmail->template = 'contact_us';
			    $this->SiteEmail->sendAs = 'html';

			    $this->data['Contact']['body'] = nl2br(str_replace(array('<', '>'), array('&lt;', '&gt;'), $this->data['Contact']['body']));
			    $this->set('data', $this->data);

			    $this->SiteEmail->send();

				$this->redirect('/contacts/success#send');
				exit;
			} else {
				$this->aErrFields['Contact'] = $this->Contact->invalidFields();
			}

		//}

		$this->set('data', $this->data);
		$this->set('captchaKey', $captchaKey);

		$aArticle = $this->Article->findByPage_id('contacts');
		$this->set('aArticle', $aArticle);

		$this->pageTitle = (isset($aArticle['Seo']['title']) && $aArticle['Seo']['title']) ? $aArticle['Seo']['title'] : $aArticle['Article']['title'];
		$this->data['SEO'] = $aArticle['Seo'];
	}

	function success() {
		$aArticle = $this->Article->findByPage_id('contacts');
		$this->set('aArticle', $aArticle);
		$this->pageTitle = (isset($aArticle['Seo']['title']) && $aArticle['Seo']['title']) ? $aArticle['Seo']['title'] : $aArticle['Article']['title'];
		$this->data['SEO'] = $aArticle['Seo'];
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
