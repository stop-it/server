<?php
/**
 * Stop-it server application.
 *
 * @copyright (c) 2015 Leonardo Sedevcic
 * @author Ondřej Doněk, <ondrejd@gmail.com>
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

require 'vendor/autoload.php';

$app = new \Slim\Slim();
$app->get('/', function() {
	echo 'Stop-it server...';
});
$app->run();