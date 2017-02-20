<?php

namespace Drupal\wxt_bootstrap\Plugin\Preprocess;

use Drupal\bootstrap\Plugin\Preprocess\PreprocessBase;

/**
 * Pre-processes variables for the "block" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("block")
 */
class Block extends PreprocessBase {

  /**
   * {@inheritdoc}
   */
  public function preprocess(array &$variables, $hook, array $info) {
    /** @var \Drupal\wxt_library\LibraryService $wxt */
    $wxt = \Drupal::service('wxt_library.service_wxt');
    $wxt_active = $wxt->getLibraryName();
    $library_path = $wxt->getLibraryPath();

    // Language Handling.
    $language = \Drupal::languageManager()->getCurrentLanguage()->getId();
    $language_prefix = \Drupal::config('language.negotiation')->get('url.prefixes');
    $variables['language'] = $language;
    $variables['language_prefix'] = $language_prefix[$language];

    if ($wxt_active == 'ogpl') {
      $variables['logo'] = $library_path . '/assets/logo.png';
    }
    elseif ($wxt_active == 'gc_intranet') {
      $variables['logo_sttl_svg'] = $library_path . '/assets/wmms-intra.svg';
    }
    elseif ($wxt_active == 'gcwu_fegc') {
      $variables['logo_sttl_svg'] = $library_path . '/assets/wmms.svg';
      $variables['logo_sig_svg'] = $library_path . '/assets/sig-' . $language . '.svg';
    }
    elseif ($wxt_active == 'gcweb') {
      $variables['logo'] = $library_path . '/assets/sig-blk-' . $language . '.png';
      $variables['logo_svg'] = $library_path . '/assets/sig-blk-' . $language . '.svg';
      $variables['logo_bottom_svg'] = $library_path . '/assets/wmms-blk' . '.png';
      $variables['logo_bottom_svg'] = $library_path . '/assets/wmms-blk' . '.svg';
    }
    elseif ($wxt_active == 'gc_intranet') {
      $variables['logo_svg'] = $library_path . '/assets/sig-blk-' . $language . '.svg';
    }

    parent::preprocess($variables, $hook, $info);
  }

}