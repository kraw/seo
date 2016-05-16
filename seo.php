<?php

/*

Plugin Name: Microdot SEO

*/

function microdot_seo_print_json_ld() {
  echo '<script type="application/ld+json">';

  $data = array();

  $data['@context'] = 'http://schema.org';

  $data['@type'] = 'Article';

  $data['author'] = array(
    '@type' => 'Person',
    'name' => get_the_author()
  );

  if( is_singular() ) {
    $data['name'] = get_the_title();
    $data['articleBody'] = wp_strip_all_tags(get_the_content());
  }

  // https://developers.google.com/structured-data/rich-snippets/articles#article_markup_properties

  $data['description'] = get_the_excerpt();

  // $data['headline'] = '';
  // $data['image'] = '';
  // $data['publisher'] = '';
  $data['datePublished'] = get_the_date('c');
  $data['dateModified'] = get_the_modified_date('c');
  $data['mainEntityOfPage'] = array(
    '@id' => get_permalink(),
    '@type' => 'WebPage'
  );  

  echo json_encode($data);

  echo '</script>';
}
add_action('wp_footer', 'microdot_seo_print_json_ld', 100);