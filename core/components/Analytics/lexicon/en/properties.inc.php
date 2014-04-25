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
 * @subpackage lexicon
 * @language en
 */

# shared
$_lang['analytics.prop_desc.debug'] = 'Output debug messages? Debug messages are output before the tracking code and within a single html script tag.';
$_lang['analytics.prop_desc.isLocalhost'] = 'UA - Running on a localhost? This will set cookieDomain to "none".';
$_lang['analytics.prop_desc.excludeContextList'] = 'Comma separated list of contexts to exclude from tracking - default: \'\' - Ex: web, web2,...';
$_lang['analytics.prop_desc.excludeLoggedInUserContextList'] = 'Comma separated list of contexts to exclude from tracking when users are logged in - default: \'mgr\' - Ex: mgr, web,...';
$_lang['analytics.prop_desc.enhancedLinkAttribution'] = 'UA+GA - Enable In-Page Analytics?';

# Universal Analytics
$_lang['analytics.prop_desc.webPropertyID'] = 'UA - Your tracking ID.';
$_lang['analytics.prop_desc.cookieDomain'] = 'UA - Cookie domain: auto||none||domain.tld - default: auto.';
$_lang['analytics.prop_desc.cookiePath'] = 'UA - Cookie path for subdirectory tracking.';
$_lang['analytics.prop_desc.forceSSL'] = 'UA - Force Google Analytics to always send data using SSL, even from insecure pages (http)?';
$_lang['analytics.prop_desc.anonymizeIP'] = 'UA - Anonymize IP addresses?';
$_lang['analytics.prop_desc.displayfeatures'] = 'UA - Enable Display Advertising features?';
$_lang['analytics.prop_desc.pagePath'] = 'UA - pageview\'s page path.';

# Google Analytics
$_lang['analytics.prop_desc.setAccount'] = 'GA - Your tracking ID.';
$_lang['analytics.prop_desc.setDomainName'] = 'GA - Cookie domain.';
$_lang['analytics.prop_desc.setCookiePath'] = 'GA - Cookie path.';
$_lang['analytics.prop_desc.trackPageview'] = 'GA - pageview\'s page path.';
