<?php
/**
 * @package Analytics
 */

$properties = array(
    array(
        'name' => 'setAccount',
        'desc' => 'Analytics.prop_desc.setAccount',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'setDomainName',
        'desc' => 'Analytics.prop_desc.setDomainName',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'setCookiePath',
        'desc' => 'Analytics.prop_desc.setCookiePath',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
    array(
        'name' => 'enhancedLinkAttribution',
        'desc' => 'Analytics.prop_desc.enhancedLinkAttribution',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => true,
        'lexicon' => PKG_NAME_LOWER . ':properties',
    ),
);

return $properties;

?>