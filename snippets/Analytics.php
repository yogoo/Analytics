<?php

/**
 * A snippet to insert optimized and minified Google Analytics asynchronous js tracking code...
 *   ... and ignore traffic from users logged into the manager.
 *
 * @author Jérôme Perrin <hello@jeromeperrin.com>
 * @version 1.0.0-rc1
 * @dependencies chunk googleAnalyticsTpl.html
 * @param bool debug Ouput debug messages as html comments
 * Following parameters: refer to Google Analytics documentation for details and values
 *   https://code.google.com/apis/analytics/docs/gaJS/gaJSApi.html
 * @param string setAccount
 * @param string trackPageview
 * @param string setDomainName
 * @param string setCookiePath
 * @return string empty string or tracking code or debug messages
 */

$htmlOutput = '';
$trackCurrentUser = true;

if ($modx->user instanceof modUser) {
    if ($modx->user->hasSessionContext('mgr')) {
      $trackCurrentUser = false;
    }
}

if ($trackCurrentUser) {
    $gaq = array();

    $gaq['setAccount'] = $modx->getOption('setAccount',$scriptProperties,'');
    if (empty($gaq['setAccount'])) $gaq['setAccount'] = $modx->getOption('gaq_setAccount');

    $gaq['trackPageview'] = $modx->getOption('trackPageview',$scriptProperties,'');
    if (empty($gaq['trackPageview'])) $gaq['trackPageview'] = $modx->getOption('gaq_trackPageview');

    $gaq['setDomainName'] = $modx->getOption('setDomainName',$scriptProperties,$modx->getOption('gaq_setDomainName'));
    if (empty($gaq['setDomainName'])) $gaq['setDomainName'] = $modx->getOption('gaq_setDomainName');

    $gaq['setCookiePath'] = $modx->getOption('setCookiePath',$scriptProperties,$modx->getOption('gaq_setCookiePath'));
    if (empty($gaq['setCookiePath'])) $gaq['setCookiePath'] = $modx->getOption('gaq_setCookiePath');

    $debug = $modx->getOption('debug',$scriptProperties,$modx->getOption('debug'));

    if (!empty($gaq['setAccount'])) {
        $gaqJSOptions['setAccount'] = "['_setAccount','".$gaq['setAccount']."']";
        if ($gaq['trackPageview']) $gaqJSOptions['trackPageview'] = "['_trackPageview', '".$gaq['trackPageview']."']";
            else  $gaqJSOptions['trackPageview'] = "['_trackPageview']";
        if (!empty($gaq['setDomainName'])) $gaqJSOptions['setDomainName'] = "['_setDomainName', '".$gaq['setDomainName']."']";
        if (!empty($gaq['setCookiePath'])) $gaqJSOptions['setCookiePath'] = "['_setCookiePath', '".$gaq['setCookiePath']."']";

        $gaq_options = implode(', ', $gaqJSOptions);
        $htmlOutput .= $modx->getChunk('googleAnalyticsTpl',array('gaq_options'=>$gaq_options));
    }
    else if ($debug) {
        $htmlOutput .= '<!-- Oops, did you forget to set up your tracking id? -->';
    }
}

return $htmlOutput;

?>