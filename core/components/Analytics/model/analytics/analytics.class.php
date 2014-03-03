<?php
/**
 * @package Analytics
 */

// bool   debug
// string excludeContextList (comma separated list of contexts => mgr,web,custom)
// string excludeLoggedUserContextList (comma separated list of contexts => mgr,web,custom)


## UA
// string webPropertyID => UA-XXXX-Y
// bool isLocalhost => set cookie domain to none
// string cookieDomain => Cookie Domain Configuration => auto||none||domain.tld - default = auto
// string cookiePath => Subdirectory Tracking
// bool forceSSL => force Google Analytics to always send data using SSL even from insecure pages
// bool enhancedLinkAttribution => enable enhanced link attribution
// bool anonymizeIP => anonymize the IP addresses for all the hits sent from a page

## GA
// string setAccount => UA-XXXX-Y
// string setDomainName
// string setCookiePath
// bool   enhancedLinkAttribution
// string trackPageview  //enabled by default and deprecated as of 1.2.0-pl

class Analytics {

  public $modx;
  public $config = array();


  function __construct(modX &$modx, array $config = array()) {

    $this->modx =& $modx;

    $basePath = $this->modx->getOption('analytics.core_path',$config,$this->modx->getOption('core_path').'components/analytics/');
    $this->config = array_merge(array(
      'base_path' => $basePath,
      'core_path' => $basePath,
      'model_path' => $basePath.'model/',
      'elements_path' => $basePath.'elements/',
    ), $config);

    if (empty($this->config['universalAnalyticsTpl'])) $this->config['universalAnalyticsTpl'] = 'ua_tracking';
    if (empty($this->config['googleAnalyticsTpl'])) $this->config['googleAnalyticsTpl'] = 'ga_racking';
  }

  /**
   *
   * @access public
   *
   */
  public function run(){
    $output = '';
    $d_output = '';

    # Should we track? filter by context
    if ( empty($this->config['webPropertyID']) && empty($this->config['setAccount']) ) {
      $track = false;
      if ($this->config['debug']) $d_output .= '// Whoops, did you forget to set your tracking ID?'."\n";
    } else {
      if (!$this->track()) { # Don't track
        if ($this->config['debug']) $d_output .= '// Do not track';
      } else { # Track
        $output .= $this->generateUATrackingCode();
        $output .= $this->generateGATrackingCode();
        if ($this->config['debug']) $d_output .= '// Do track';
      }
    }


    # return the resulting tracking code or debug output
    if ($this->config['debug']) $output = '<script>'.$d_output.'</script>'."\n".$output;
    return $output;
  }


  /**
   * Returns the status of tracking depending of the current context and user's session(s)
   *
   * @author Jerome Perrin
   * @access private
   * @return bool Returns the status of tracking depending of the current context and user's session(s)
   */
  private function track() {
    $currentContext = $this->modx->context->get('key');

    # track current context?
    $trackCurrentContext = true;
    if (!empty($this->config['excludeContextList'])) {
      $excludeContexts = explode(',', $this->sanitizeList($this->config['excludeContextList']));
      $trackCurrentContext = !in_array($currentContext, $excludeContexts, true);
    }

    # track logged in user?
    $trackLoggedUser = true;
    if (!empty($this->config['excludeLoggedUserContextList'])) {
      $excludeLoggedUserContexts = explode(',', $this->sanitizeList($this->config['excludeLoggedUserContextList']));
      if ($this->modx->user instanceof modUser) {
        $userSessionContexts = array_keys($this->modx->user->getSessionContexts()); // array("mgr" => 1) => array("mgr")
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
   * Returns the Universal Analytics tracking code based on current config.
   *
   * @author Jerome Perrin
   * @access private
   * @return bool Returns the Universal Analytics tracking code based on current config
   */
  private function generateUATrackingCode() {
    // string webPropertyID
    // bool isLocalhost
    // string cookieDomain => auto||none||domain.tld - default = auto
    // string cookiePath
    // bool forceSSL
    // bool enhancedLinkAttribution
    // bool anonymizeIP

    // [[+gua_options]]

    if ($this->config['universalAnalyticsTpl'] != 'ua_tracking') {
      # pass the webPropertyID to the user's provided chunk (override the default chunk)
      $gua_options = array('gua_options' => $this->config['webPropertyID']);
    } else {
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


      if ($this->config['forceSSL']) $UAtracker.= "ga('set','forceSSL',true);";
      if ($this->config['enhancedLinkAttribution']) $UAtracker.= "ga('require','linkid','linkid.js'};";
      if ($this->config['anonymizeIP']) $UAtracker.= "ga('set','anonymizeIp',true);";

      $gua_options = array('gua_options' => $UAtracker);
    }

    return $this->getChunk('universalAnalyticsTpl',$gua_options);
  }


  /**
   * Returns the Google Analytics tracking code based on current config.
   *
   * @author Jerome Perrin
   * @access private
   * @return bool Returns the Google Analytics tracking code based on current config
   */
  private function generateGATrackingCode() {
    // string setAccount => UA-XXXX-Y
    // string setDomainName
    // string setCookiePath
    // bool   enhancedLinkAttribution
    // string trackPageview  //enabled by default and deprecated as of 1.2.0-pl

    # [[+gua_options]]

  }



  /**
   * Returns the input string with all white space stripped out.
   *
   * @access private
   * @param string $string The input string.
   * @return string Returns the input string with all white space stripped out.
   */
  private function sanitizeList($string) {
    return preg_replace( '/\s+/', '', $string);
  }


  /**
     * Gets a Chunk and caches it; also falls back to file-based templates
     * for easier debugging.
     *
     * @author Shaun McCormick
     * @access public
     * @param string $name The name of the Chunk
     * @param array $properties The properties for the Chunk
     * @return string The processed content of the Chunk
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
     * @author Shaun McCormick
     * @access private
     * @param string $name The name of the Chunk. Will parse to name.chunk.tpl
     * @param string $postFix The postfix to append to the name
     * @return modChunk/boolean Returns the modChunk object if found, otherwise
     * false.
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
