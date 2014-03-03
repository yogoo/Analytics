<?php
/**
 * @package analytics
 */

$analyticsCorePath = $modx->getOption('analytics.core_path',null,$modx->getOption('core_path').'components/analytics/');
$Analytics = $modx->getService('analytics','Analytics',$analyticsCorePath.'model/analytics/',$scriptProperties);
if (!($Analytics instanceof Analytics)) return $modx->lexicon('analytics.error.loadingclass',array('path' => $analyticsCorePath.'model/analytics/'));

$result = $Analytics->run();
unset($Analytics);
return $result;