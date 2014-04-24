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

$properties = array(
    # shared
    array(
        'name' => 'debug',
        'desc' => 'analytics.prop_desc.debug',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => false,
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'isLocalhost',
        'desc' => 'analytics.prop_desc.isLocalhost',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => false,
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'excludeContextList',
        'desc' => 'analytics.prop_desc.excludeContextList',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'excludeLoggedInUserContextList',
        'desc' => 'analytics.prop_desc.excludeLoggedInUserContextList',
        'type' => 'textfield',
        'options' => '',
        'value' => 'mgr',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'enhancedLinkAttribution',
        'desc' => 'analytics.prop_desc.enhancedLinkAttribution',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),

    # Universal Analytics
    array(
        'name' => 'webPropertyID',
        'desc' => 'analytics.prop_desc.webPropertyID',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'pagePath',
        'desc' => 'analytics.prop_desc.pagePath',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'cookieDomain',
        'desc' => 'analytics.prop_desc.cookieDomain',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'cookiePath',
        'desc' => 'analytics.prop_desc.cookiePath',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'forceSSL',
        'desc' => 'analytics.prop_desc.forceSSL',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => false,
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'anonymizeIP',
        'desc' => 'analytics.prop_desc.anonymizeIP',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => false,
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'displayfeatures',
        'desc' => 'analytics.prop_desc.displayfeatures',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => false,
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),

    # Google Analytics
    array(
        'name' => 'setAccount',
        'desc' => 'analytics.prop_desc.setAccount',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'trackPageview',
        'desc' => 'analytics.prop_desc.trackPageview',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'setDomainName',
        'desc' => 'analytics.prop_desc.setDomainName',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'setCookiePath',
        'desc' => 'analytics.prop_desc.setCookiePath',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
);

return $properties;

?>