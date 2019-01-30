<?php

namespace Drupal\schema_product\Plugin\metatag\Tag;

use Drupal\schema_metatag\Plugin\metatag\Tag\SchemaImageBase;

/**
 * Provides a plugin for the 'image' meta tag.
 *
 * - 'id' should be a globally unique id.
 * - 'name' should match the Schema.org element name.
 * - 'group' should match the id of the group that defines the Schema.org type.
 *
 * @MetatagTag(
 *   id = "schema_product_image",
 *   label = @Translation("image"),
 *   description = @Translation("REQUIRED BY GOOGLE. The primary image for this item."),
 *   name = "image",
 *   group = "schema_product",
 *   weight = 2,
 *   type = "image",
 *   secure = FALSE,
 *   multiple = FALSE
 * )
 */
class SchemaProductImage extends SchemaImageBase {
  // Nothing here yet. Just a placeholder class for a plugin.
}
