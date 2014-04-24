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
 * @language fr
 */

# shared
$_lang['analytics.prop_desc.debug'] = 'Afficher les messages d\'erreur? Les messages d\'erreur se trouvent avant le code de suivi et dans une balise html script.';
$_lang['analytics.prop_desc.isLocalhost'] = 'UA - Le serveur est un serveur local ? Règle "cookieDomain" sur "none".';
$_lang['analytics.prop_desc.excludeContextList'] = 'Liste de contextes à exclure des statistiques - valeur par défaut: \'\' - Ex: web, web2,...';
$_lang['analytics.prop_desc.excludeLoggedInUserContextList'] = 'Liste de contextes à exlure des statistiques quand l\'utilisateur a une session active dans ce contexte - valeur par défaut: \'mgr\' -  Ex: mgr, web,...';
$_lang['analytics.prop_desc.enhancedLinkAttribution'] = 'UA+GA - Activer le suivi "In-Page" ?';

# Universal Analytics
$_lang['analytics.prop_desc.webPropertyID'] = 'UA - Code de suivi';
$_lang['analytics.prop_desc.cookieDomain'] = 'UA - Domaine du cookie : auto||none||domaine.tld - valeur par défaut: auto';
$_lang['analytics.prop_desc.cookiePath'] = 'UA - Chemin du cookie pour la suivi des sous-dossiers.';
$_lang['analytics.prop_desc.forceSSL'] = 'UA - Forcer Google Analytics a toujours envoyer les données en utilisant SSL, même depuis une page non sécurisée (http)?';
$_lang['analytics.prop_desc.anonymizeIP'] = 'UA - Anonymiser l\'adresse IP pour tous les "hits" envoyés?';
$_lang['analytics.prop_desc.displayfeatures'] = 'UA - Display Advertising features.';
$_lang['analytics.prop_desc.pagePath'] = 'UA - pageview\'s page path';

# Google Analytics
$_lang['analytics.prop_desc.setAccount'] = 'GA - Code de suivi.';
$_lang['analytics.prop_desc.setDomainName'] = 'GA - Domaine du cookie.';
$_lang['analytics.prop_desc.setCookiePath'] = 'GA - Chemin du cookie.';
$_lang['analytics.prop_desc.trackPageview'] = 'GA - pageview\'s page path';
