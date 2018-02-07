<?php

/**
 * @file
 * This plugin generates a inspiration list on a Inspiration list node. It's
 * mainly used to override the default page for this node type (node/%node).
 */
$plugin = array(
  'title' => t('Krimi linked data'),
  'description' => t('Show Linked data browser'),
  'single' => TRUE,
  'edit form' => 'oc_krimi_siden_linked_data_content_type_edit_form',
  'render callback' => 'oc_krimi_siden_linked_data_content_type_render',
  'category' => t('Ting'),
  //'required context' => array(new ctools_context_required(t('Argument 1'), 'node')),
);

/**
 * Render the inspiration list block.
 */
function oc_krimi_siden_linked_data_content_type_render($subtype, $conf, $panel_args, $context) {
  // Define the return block.
  $entity = ding_entity_load($panel_args[0]);
  $block = new stdClass();
  if(in_array ('krimi',$entity->subjects))
  {
      //add entity information to bootstrap javascript.
      $data = array();
      $data["faust"] = isset($entity->localId) ? $entity->localId : null;
      $data["author"] = isset($entity->creators) ? $entity->creators[0] : null;
      $data["isbn"] = isset($entity->record["dc:identifier"]["dkdcplus:ISBN"][0]) ? $entity->record["dc:identifier"]["dkdcplus:ISBN"][0] : 0 ;
      $data["subjects"] = $entity->subjects;
      drupal_add_js(array(
        'oc_krimi_siden' => $data,
      ), 'setting');
      // Check if context exists.
      drupal_add_js('https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js', 'external');
      drupal_add_js('https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.3.3/backbone-min.js', 'external');
      
      drupal_add_js(drupal_get_path('module', 'oc_krimi_siden') .'/js/backbone_models.js');
      drupal_add_js(drupal_get_path('module', 'oc_krimi_siden') .'/js/backbone_collections.js');
      drupal_add_js(drupal_get_path('module', 'oc_krimi_siden') .'/js/backbone_views.js');
      drupal_add_js(drupal_get_path('module', 'oc_krimi_siden') .'/js/oc_krimi_siden.js');
      drupal_add_css(drupal_get_path('module', 'oc_krimi_siden') .'/css/oc_krimi_siden.css');
      $block->content = theme("krimi_linked_block");
  }
  
  return $block;
}


/**
 * Enable admin settings page.
 */
function oc_krimi_siden_linked_data_content_type_edit_form($form, &$form_state) {
  return $form;
}