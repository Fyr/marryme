<?
define('CONTACT_ERR1', __('Username cannot be blank', true));
define('CONTACT_ERR2', __('Username length should be between 3 to 50 characters', true));
define('CONTACT_ERR3', __('Incorrect e-mail address', true));
define('CONTACT_ERR4', __('Incorrect text for captcha', true));

class Contact extends AppModel {
	var $name = 'Contact';
	var $useTable = false;

	var $validate = array(
		'username' => array(
			'nonEmpty' => array(
				'rule' => 'notEmpty',
				'message' => CONTACT_ERR1
			),
			'between' => array(
				'rule' => array('between', 3, 50),
				'message' => CONTACT_ERR2
			)
		),
		'email' => array(
			'nonEmpty' => array(
				'rule' => 'notEmpty',
				'message' => CONTACT_ERR3
			),
			'email' => array(
				'rule' => 'email',
				'message' => CONTACT_ERR3
			)
		),
		'captcha' => array(
			'nonEmpty' => array(
				'rule' => 'notEmpty',
				'message' => CONTACT_ERR4
			),
			'check_captcha' => array(
				'rule' => array('checkCaptcha'),
				'message' => CONTACT_ERR4
			)
		)
	);

	function checkCaptcha($value) {
		return (substr(md5(_SALT.$this->data['Contact']['captcha_q']), 0, 6) === $this->data['Contact']['captcha']);
	}

}
