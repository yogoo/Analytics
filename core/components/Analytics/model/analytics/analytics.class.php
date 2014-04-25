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

class Analytics {

  public $modx;
  public $config = array();

  /**
   * The Analytics constructor.
   *
   * @param modX $modx A reference to the modX constructor.
   * @param array $config Holds the configuration values.
   */
  function __construct(modX &$modx, array $config = array()) {

    $this->modx =& $modx;

    $basePath = $this->modx->getOption('analytics.core_path',$config,$this->modx->getOption('core_path').'components/analytics/');
    $this->config = array_merge(array(
      'base_path' => $basePath,
      'core_path' => $basePath,
      'model_path' => $basePath.'model/',
      'elements_path' => $basePath.'elements/',
      'universalAnalyticsTpl' => 'ua_tracking',
      'googleAnalyticsTpl' => 'ga_tracking',
    ), $config);
  }


  /**
   *
   * Build and returns the tracking codes as html/js.
   * @access public
   * @return string Returns the tracking codes as html/js.
   *
   */
  public function buildAndReturnTrackingCode(){
    $output = '';
    $d_output = '';

    ## no tracking ID provided, return
    if ( empty($this->config['webPropertyID']) && empty($this->config['setAccount']) ) {
      if ($this->config['debug']) {
        $d_output .= '// Whoops, did you forget to set an analytics tracking ID? If not, set debug to false to remove this message.';
        return $this->wrapIntoHTMLScriptTag($d_output)."\n".$output;
      }
      return $output;
    }

    # should we track?
    if (!$this->track()) { ## dont track
      if ($this->config['debug']) {
        $d_output .= '// Do not track';
        return $this->wrapIntoHTMLScriptTag($d_output)."\n".$output;
      }
      return $output;
    } else { ## track
      # UA (analytics.js)
      if (!empty($this->config['webPropertyID'])) {
        if ($this->config['debug']) $d_output .= '// Track with Universal Analytics';
        $output .= $this->generateUATrackingCode();
      }

      # GA (ga.js)
      if (!empty($this->config['setAccount'])) {
        if ($this->config['debug']) $d_output .= '// Track with Google Analytics';
        $output .= $this->generateGATrackingCode();
      }
    }

    ## return
    if ($this->config['debug']) $output = $this->wrapIntoHTMLScriptTag($d_output)."\n".$output;
    return $output;
  }


  /**
   * Check wether we should track or not based on the current context and user's session(s)
   *
   * @access private
   * @return bool Returns the status of tracking depending on the current context and user's session(s).
   */
  private function track() {
    $currentContext = $this->modx->context->get('key');

    # track current context?
    $trackCurrentContext = true;
    if (!empty($this->config['excludeContextList'])) {
      $excludeContexts = explode(',', $this->stripWhitespace($this->config['excludeContextList']));
      $trackCurrentContext = !in_array($currentContext, $excludeContexts, true);
    }

    # track logged in user?
    $trackLoggedUser = true;
    if (!empty($this->config['excludeLoggedInUserContextList'])) {
      $excludeLoggedUserContexts = explode(',', $this->stripWhitespace($this->config['excludeLoggedInUserContextList']));
      if ($this->modx->user instanceof modUser) {
        $userSessionContexts = array_keys($this->modx->user->getSessionContexts()); // array("mgr" => 1) ==> array("mgr")
        # check each session context against each excludeContext
        foreach ($userSessionContexts as $sessionContext) {
          if (in_array($sessionContext, $excludeLoggedUserContexts)) {
            $trackLoggedUser = false;
            break;
          }
        }
      }
    }

    return $trackCurrentContext && $trackLoggedUser;
  }


  /**
   * Generates a Universal Analytics tracking code (analytics.js).
   *
   * @access private
   * @return bool Returns the Universal Analytics tracking code based on current config
   */
  private function generateUATrackingCode() {
    # string webPropertyID
    # bool isLocalhost
    # string cookieDomain => auto||none||domain.tld - default = auto
    # string cookiePath
    # bool forceSSL
    # bool enhancedLinkAttribution
    # bool anonymizeIP
    # string pagePath
    # bool displayfeatures

    # [[+ua_options]]
    $ua_options = array();

    # create a UA tracker
    #   ga('create', 'UA-XXXXX-X', 'auto');
    #   ga('create', 'UA-XXXXX-X', 'domain.tld');
    #   ga('create', 'UA-XXXXX-X', 'auto||none||domain.tld');
    #   ga('create', 'UA-XXXXX-X', {'cookieDomain': 'none', 'cookiePath': '/path/'});
    $UAtracker = '';

    if (empty($this->config['cookieDomain']) && !$this->config['isLocalhost']) {
      $this->config['cookieDomain'] = 'auto';
    } else if ($this->config['isLocalhost']) {
      $this->config['cookieDomain'] = 'none';
    }

    if (!empty($this->config['cookiePath'])) {
      $cookieProps = "{'cookieDomain':'".$this->config['cookieDomain']."','cookiePath':'".$this->config['cookiePath']."'}";
    } else {
      $cookieProps = "'".$this->config['cookieDomain']."'";
    }

    $UAtracker .= "ga('create','".$this->config['webPropertyID']."',".$cookieProps.");";
    unset($cookieProps);
    $UAtracker .= empty($this->config['pagePath']) ? "ga('send','pageview');" : "ga('send','pageview','".$this->config['pagePath']."');";

    if ($this->config['forceSSL']) $UAtracker.= "ga('set','forceSSL',true);";
    if ($this->config['enhancedLinkAttribution']) $UAtracker.= "ga('require','linkid','linkid.js'};";
    if ($this->config['anonymizeIP']) $UAtracker.= "ga('set','anonymizeIp',true);";
    if ($this->config['displayfeatures']) $UAtracker.= "ga('require','displayfeatures');";

    $ua_options['ua_options'] = $UAtracker;
    return $this->getChunk('universalAnalyticsTpl',$ua_options);
  }


  /**
   * Generates a Google Analytics tracking code (ga.js).
   *
   * @access private
   * @return bool Returns the Google Analytics tracking code based on current config
   */
  private function generateGATrackingCode() {
    # string setAccount => UA-XXXX-Y
    # string setDomainName
    # string setCookiePath
    # bool   enhancedLinkAttribution
    # string trackPageview

    # [[+ga_options]]
    $ga_options = array();

    # create a GA tracker
    $GAtracker = '';

    if ($this->config['enhancedLinkAttribution']) $GAtracker .= "['_require','inpage_linkid',p],";
    $GAtracker .= "['_setAccount','".$this->config['setAccount']."'],";
    $GAtracker .= empty($this->config['trackPageview']) ? "['_trackPageview']" : "['_trackPageview', '".$this->config['trackPageview']."']";
    if (!empty($this->config['setDomainName'])) $GAtracker .= ",['_setDomainName','".$this->config['setDomainName']."']";
    if (!empty($this->config['setCookiePath'])) $GAtracker .= ",['_setCookiePath','".$this->config['setCookiePath']."']";

    $ga_options['ga_options'] = $GAtracker;
    return $this->getChunk('googleAnalyticsTpl',$ga_options);
  }


  /**
   * Strips out all white space from a string.
   *
   * @access private
   * @param string $string A string to clean up.
   * @return string Returns the input string with all white space stripped out.
   */
  private function stripWhitespace($string) {
    return preg_replace( '/\s+/', '', $string);
  }


  /**
   * Wraps a javascript string into an html script tag.
   *
   * @access private
   * @param string $js_string The javascript string.
   * @return string Returns the javascript string wrapped into an html script tag.
   */
  private function wrapIntoHTMLScriptTag($js_string) {
    return '<script>'.$js_string.'</script>';
  }


  /**
   * Gets a Chunk and caches it; also falls back to file-based templates
   * for easier debugging.
   *
   * @access public
   * @param string $name The name of the Chunk.
   * @param array $properties The properties for the Chunk.
   * @return string Returns the processed content of the Chunk.
   * @author Shaun McCormick
   */
  public function getChunk($name,$properties = array()) {
    $chunk = null;
    if (!isset($this->chunks[$name])) {
      $chunk = $this->modx->getObject('modChunk',array('name' => $this->config[$name]),true);
      if ($chunk == false) {
        $chunk = $this->_getTplChunk($this->config[$name]);
        if ($chunk == false) return false;
      }
      $this->chunks[$name] = $chunk->getContent();
    } else {
      $o = $this->chunks[$name];
      $chunk = $this->modx->newObject('modChunk');
      $chunk->setContent($o);
    }
    $chunk->setCacheable(false);
    return $chunk->process($properties);
  }


  /**
   * Returns a modChunk object from a template file.
   *
   * @access private
   * @param string $name The name of the Chunk. Will parse to name.chunk.tpl
   * @param string $postFix The postfix to append to the name.
   * @return modChunk/boolean Returns the modChunk object if found, otherwise false.
   * @author Shaun McCormick
   */
  private function _getTplChunk($name,$postFix = '.chunk.tpl') {
    $chunk = false;
    $f = $this->config['elements_path'].'chunks/'.strtolower($name).$postFix;
    if (file_exists($f)) {
      $o = file_get_contents($f);
      /* @var modChunk $chunk */
      $chunk = $this->modx->newObject('modChunk');
      $chunk->set('name',$name);
      $chunk->setContent($o);
    }
    return $chunk;
  }

}
