<?php

namespace Drupal\custom_views\Plugin\views\style;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;
use Drupal\Component\Utility\Html;

/**
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "custom_bootstrap_grid",
 *   title = @Translation("Custom Bootstrap Grid"),
 *   help = @Translation("Displays rows in a Bootstrap Grid layout"),
 *   theme = "views_custom_bootstrap_grid",
 *   display_types = {"normal"}
 * )
 */
class CustomBootstrapGrid extends StylePluginBase {

  /**
   * Overrides \Drupal\views\Plugin\views\style\StylePluginBase::usesRowPlugin.
   *
   * @var bool
   */
  protected $usesRowPlugin = TRUE;

  /**
   * Overrides \Drupal\views\Plugin\views\style\StylePluginBase::usesRowClass.
   *
   * @var bool
   */
  protected $usesRowClass = TRUE;

  /**
   * Definition.
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
  }

}
