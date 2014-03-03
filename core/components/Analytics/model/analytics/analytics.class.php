<?php
/**
 * @package Analytics
 */

// bool   debug
// string hideFromContexts (comma separated list of contexts => mgr,web,custom)

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
  function __construct(modX &$modx, array $config = array())
  {
    $this->modx =& $modx;

    $basePath = $this->modx->getOption('analytics.core_path',$config,$this->modx->getOption('core_path').'components/analytics/');
    $this->config = array_merge(array(
      'base_path' => $basePath,
      'core_path' => $basePath,
      'model_path' => $basePath.'model/',
      'elements_path' => $basePath.'elements/',
      'guaTpl' => 'guaTpl',
      'gaqTpl' => 'gaqTpl',
    ), $config);

  }

  public function run()
  {
    // Should we track? filter by context
    // No => exit
    // Yes
    //    optionnaly generate tracking code for UA
    //    optionnaly generate tracking code for GA

    $output = 'output from the class';

    return $output;
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
