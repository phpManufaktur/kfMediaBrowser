<?php

/**
 * MediaBrowser
 *
 * @author Team phpManufaktur <team@phpmanufaktur.de>
 * @link https://kit2.phpmanufaktur.de
 * @copyright 2013 Ralf Hertsch <ralf.hertsch@phpmanufaktur.de>
 * @license MIT License (MIT) http://www.opensource.org/licenses/MIT
 */

// scan the /Locale directory and add all available languages
$app['utils']->addLanguageFiles(MANUFAKTUR_PATH.'/MediaBrowser/Data/Locale');
// scan the /Locale/Custom directory and add all available languages
$app['utils']->addLanguageFiles(MANUFAKTUR_PATH.'/MediaBrowser/Data/Locale/Custom');

// main dialog - expect the parameters given as Request
$app->get('/admin/mediabrowser',
    'phpManufaktur\MediaBrowser\Control\Browser::ControllerMediaBrowser');

// main dialog - get all parameters as encoded string
$app->get('/admin/mediabrowser/init/{params}',
    'phpManufaktur\MediaBrowser\Control\Browser::ControllerMediaBrowserInit');

$app->get('/admin/mediabrowser/delete/{delete}',
    'phpManufaktur\MediaBrowser\Control\Browser::ControllerMediaBrowserDelete');

$app->get('/admin/mediabrowser/directory/{change}',
    'phpManufaktur\MediaBrowser\Control\Browser::ControllerMediaBrowserChangeDirectory');

$app->post('/admin/mediabrowser/directory/create',
    'phpManufaktur\MediaBrowser\Control\Browser::ControllerMediaBrowserCreateDirectory');

$app->post('/admin/mediabrowser/upload',
    'phpManufaktur\MediaBrowser\Control\Browser::ControllerMediaBrowserUpload');

$app->get('/admin/mediabrowser/select/{select}',
    'phpManufaktur\MediaBrowser\Control\Browser::ControllerMediaBrowserSelect');

$app->get('/admin/mediabrowser/exit/{usage}',
    'phpManufaktur\MediaBrowser\Control\Browser::ControllerMediaBrowserExit');

$app->get('/admin/mediabrowser/cke',
    'phpManufaktur\MediaBrowser\Control\Browser::ControllerMediaBrowserCKE');
