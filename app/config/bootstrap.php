<?php
define('TEST_ENV', $_SERVER['SERVER_ADDR'] == '192.168.1.22');

define('DOMAIN_NAME', 'marryme.dev');
define('DOMAIN_TITLE', 'MarryMe.dev');

define('EMAIL_ADMIN', 'marrymeminsk@gmail.com');
define('EMAIL_ADMIN_CC', 'fyr.work@gmail.com');

define('_SALT', '_MSTL_');

define('PATH_FILES_UPLOAD', $_SERVER['DOCUMENT_ROOT'].'files/');

define('VIDEO_FB_CAT', 27);
define('VIDEO_FB_FAQ', 1);

define('PHOTOSLIDER_ID', 751);

define('YAPI_appId', 'cb6240820447440fb0876d9d2284884f');
define('YAPI_appPass', '63adce9ffd404075b79fdb5b8acbc38c');
define('YAPI_appToken', null);
define('YAPI_login', 'fyr-work');
define('YAPI_password', 'beHolder');

define('TAG_CLOUD_W', 217);
define('TAG_CLOUD_H', 200);

require_once('extra.php');

// session_start();
// Configure::write('Session.start', true);
// start session only for specific controllers
if (isset($_GET['url']) && $_GET['url'] && strpos($_GET['url'], '/')) {
	list($controller, $method) = explode('/', $_GET['url']);
	if (strtolower($controller) == 'userarea') {
		Configure::write('Session.start', true);
	}
}

function ___($string) {
	return __($string, true);
}

function fdebug($data, $logFile = 'tmp.log', $lAppend = true) {
	file_put_contents($logFile, mb_convert_encoding(print_r($data, true), 'cp1251', 'utf8'), ($lAppend) ? FILE_APPEND : null);
}