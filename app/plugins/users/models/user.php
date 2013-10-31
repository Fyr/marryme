<?
define('USR_ERR_1', __('This field should not be blank', true));
define('USR_ERR_2', __('Username length should be between 3 to 50 characters', true));
define('USR_ERR_3', __('Password should be mimimum 6 characters long', true));
define('USR_ERR_4', __('User with such email already exists', true));
define('USR_ERR_5', __('Incorrect e-mail address', true));
define('USR_ERR_6', __('Passwords should be the same', true));
define('USR_ERR_7', __('Incorrect text for image', true));

class User extends UsersAppModel {
	var $name = 'User';
	
	var $validate = array(
		'username' => array(
			'nonEmpty' => array(
				'rule' => 'notEmpty',
				'message' => USR_ERR_1
			),
			'between' => array(
				'rule' => array('between', 3, 50),
				'message' => USR_ERR_2
			)
		),
		'password' => array(
			'nonEmpty' => array(
				'rule' => 'notEmpty',
				'message' => USR_ERR_1
			),
			'minLen' => array(
				'rule' => array('minLength', '6'),
				'message' => USR_ERR_3
			)
		),
		'email' => array(
			'nonEmpty' => array(
				'rule' => 'notEmpty',
				'message' => USR_ERR_1
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => USR_ERR_4
			),
			'email' => array(
				'rule' => 'email',
				'message' => USR_ERR_5
			)
		),
		'password_again' => array(
			'nonEmpty' => array(
				'rule' => 'notEmpty',
				'message' => USR_ERR_1
			),
			'check_equ' => array(
				'rule' => array('checkPsw'),
				'message' => USR_ERR_6
			)
		),
		'captcha' => array(
			'nonEmpty' => array(
				'rule' => 'notEmpty',
				'message' => USR_ERR_1
			),
			'check_captcha' => array(
				'rule' => array('checkCaptcha'),
				'message' => USR_ERR_7
			)
		)
	);
	
	function checkPsw($value) {
		$_ret = true;
		if (isset($this->data['User']['password'])) {
			$_ret = ($this->data['User']['password_again'] === $this->data['User']['password']);
		}
		return $_ret;
	}
	
	function checkCaptcha($value) {
		return (substr(md5(_SALT.$this->data['User']['captcha_q']), 0, 6) === $this->data['User']['captcha']);
	}
	
	function beforeSave() {
		if (isset($this->data['User']['password'])) {
			$this->data['User']['password'] = md5($this->data['User']['password']);
		}
		return true;
	}
}
?>