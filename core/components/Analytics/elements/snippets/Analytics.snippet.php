<?php
/**
 * Analytics
 *
 * Copyright 2014 by Jerome Perrin <hello@jeromeperrin.com>
 *
 * This file is part of Analytics, a utility tool for MODX Revolution.
 *
 * Analytics is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * Analytics is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * Analytics; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 * @package Analytics
 */

$analyticsCorePath = $modx->getOption('analytics.core_path',null,$modx->getOption('core_path').'components/analytics/');
$Analytics = $modx->getService('analytics','Analytics',$analyticsCorePath.'model/analytics/',$scriptProperties);
if (!($Analytics instanceof Analytics)) return $modx->lexicon('analytics.error.loadingclass',array('path' => $analyticsCorePath.'model/analytics/'));

$result = $Analytics->run();
unset($Analytics);
return $result;