<?php

/**
 * MediaBrowser
 *
 * @author Team phpManufaktur <team@phpmanufaktur.de>
 * @link https://addons.phpmanufaktur.de/extendedWYSIWYG
 * @copyright 2013 Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */

use Symfony\Component\HttpFoundation\Request;
use phpManufaktur\MediaBrowser\Control\Browser;
use Symfony\Component\HttpKernel\HttpKernelInterface;

// scan the /Locale directory and add all available languages
try {
	$locale_path = MANUFAKTUR_PATH.'/MediaBrowser/Data/Locale';
	if (false === ($lang_files = scandir($locale_path)))
		throw new \Exception(sprintf("Can't read the /Locale directory %s!", $locale_path));
	$ignore = array('.', '..', 'index.php');
	foreach ($lang_files as $lang_file) {
		if (!is_file($locale_path.'/'.$lang_file)) continue;
		if (in_array($lang_file, $ignore)) continue;
		$lang_name = pathinfo($locale_path.'/'.$lang_file, PATHINFO_FILENAME);
		// get the array from the desired file
		$lang_array = include_once $locale_path.'/'.$lang_file;
		// add the locale resource file
		$app['translator'] = $app->share($app->extend('translator', function ($translator, $app) use ($lang_array, $lang_name) {
		    $translator->addResource('array', $lang_array, $lang_name);
		    return $translator;
		}));
	}
}
catch (\Exception $e) {
	throw new \Exception(sprintf('Error scanning the /Locale directory %s.', $locale_path));
}

// main dialog - expect the parameters given as Request
$app->get('/admin/mediabrowser', function (Request $request) use ($app) {
    $Browser = new Browser();
    return $Browser->exec();
});

// main dialog - get all parameters as encoded string
$app->get('/admin/mediabrowser/init/{params}', function (Request $request, $params) use ($app) {
    $parameter = json_decode(base64_decode($params), true);
    $subRequest = Request::create('/admin/mediabrowser', 'GET', array(
        'usage' => (isset($parameter['usage'])) ? $parameter['usage'] : 'framework',
        'start' => (isset($parameter['start'])) ? $parameter['start'] : '/',
        'redirect' => (isset($parameter['redirect'])) ? $parameter['redirect'] : null,
        'mode' => (isset($parameter['mode'])) ? $parameter['mode'] : 'public',
        'directory' => (isset($parameter['directory'])) ? $parameter['directory'] : null
    ));
    return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
});

$app->get('/admin/mediabrowser/delete/{delete}', function (Request $request, $delete) use ($app) {
    $params = json_decode(base64_decode($delete), true);
    $Browser = new Browser();
    if (isset($params['usage']))
        $Browser->setUsage($params['usage']);
    if (isset($params['start']))
        $Browser->setDirectoryStart($params['start']);
    if (isset($params['mode']))
        $Browser->setDirectoryMode($params['mode']);
    if (isset($params['redirect']))
        $Browser->setRedirect($params['redirect']);
    if (isset($params['directory']))
        $Browser->setDirectory($params['directory']);
    if (isset($params['file']))
        $Browser->setFile($params['file']);
    return $Browser->Delete();
});

$app->get('/admin/mediabrowser/directory/{change}', function (Request $request, $change) use ($app) {
    $params = json_decode(base64_decode($change), true);
    $Browser = new Browser();
    if (isset($params['usage']))
        $Browser->setUsage($params['usage']);
    if (isset($params['start']))
        $Browser->setDirectoryStart($params['start']);
    if (isset($params['mode']))
        $Browser->setDirectoryMode($params['mode']);
    if (isset($params['redirect']))
        $Browser->setRedirect($params['redirect']);
    if (isset($params['directory']))
        $Browser->setDirectory($params['directory']);
    return $Browser->exec();
});

$app->match('/admin/mediabrowser/directory/create', function (Request $request) use($app) {
    $Browser = new Browser();
    return $Browser->createDirectory();
});

$app->match('/admin/mediabrowser/upload', function (Request $request) use ($app) {
    $Browser = new Browser();
    return $Browser->upload();
});

$app->get('/admin/mediabrowser/select/{select}', function (Request $request, $select) use ($app) {
    $parameter = json_decode(base64_decode($select), true);
    $subRequest = Request::create($parameter['redirect'], 'GET', array(
        'usage' => (isset($parameter['usage'])) ? $parameter['usage'] : 'framework',
        'file' => (isset($parameter['file'])) ? $parameter['file'] : null
    ));
    return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
});

$app->get('/admin/mediabrowser/exit/{mode}', function (Request $request, $mode) use ($app) {
    $parameter = json_decode(base64_decode($mode), true);
    $subRequest = Request::create($parameter['redirect'], 'GET', array(
        'usage' => (isset($parameter['usage'])) ? $parameter['usage'] : 'framework',
    ));
    return $app->handle($subRequest, HttpKernelInterface::SUB_REQUEST);
});