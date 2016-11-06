*
* URL_PROTOCOL:
* The protocol. Don't change unless you know exactly what you do. This defines the protocol part of the URL, in older
* versions of MINI it was 'http://' for normal HTTP and 'https://' if you have a HTTPS site for sure. Now the
* protocol-independent '//' is used, which auto-recognized the protocol.
*
* URL_DOMAIN:
* The domain. Don't change unless you know exactly what you do.
*
* URL_SUB_FOLDER:
* The sub-folder. Leave it like it is, even if you don't use a sub-folder (then this will be just "/").
*
* URL:
* The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
* then replace this line with full URL (and sub-folder) and a trailing slash.
*/

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
* Configuration for: Database
* This is the place where you define your database credentials, database type etc.
*/
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'f16g16');
define('DB_USER', 'f16g16');
define('DB_PASS', 'love4germany');
define('DB_CHARSET', 'utf8');