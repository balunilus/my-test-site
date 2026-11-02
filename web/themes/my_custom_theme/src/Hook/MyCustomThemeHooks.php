<?php

namespace Drupal\my_custom_theme\Hook;

use Drupal\Core\Hook\Attribute\Hook;
use Drupal\node\NodeInterface;

/**
 * Hook implementations for my_custom_theme.
 */
class MyCustomThemeHooks {
  /**
   * @file
   * Functions to support theming.
   */

  /**
   * Implements hook_preprocess_image_widget().
   */
  #[Hook('preprocess_image_widget')]
  public function preprocessImageWidget(array &$variables): void {
    $data = &$variables['data'];
    // This prevents image widget templates from rendering preview container
    // HTML to users that do not have permission to access these previews.
    // @todo revisit in https://drupal.org/node/953034
    // @todo revisit in https://drupal.org/node/3114318
    if (isset($data['preview']['#access']) && $data['preview']['#access'] === FALSE) {
      unset($data['preview']);
    }
  }

  /**
   * Prepares article fields for the card component on article pages.
   */
  #[Hook('preprocess_page')]
  public function preprocessPage(array &$variables): void {
    if (
      !isset($variables['node'])
      || !($variables['node'] instanceof NodeInterface)
      || $variables['node']->bundle() !== 'article'
    ) {
      return;
    }

    $node = $variables['node'];
    $variables['card'] = [
      'title' => $node->label(),
      'field_image' => $node->hasField('field_image')
        ? $node->get('field_image')->view()
        : [],
      'field_url' => $node->hasField('field_url')
        ? $node->get('field_url')->view()
        : [],
    ];
  }

}
