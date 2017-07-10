<?php
/**
 * Manages and renders a select taxonomy settings field.
 *
 * @uses QBTTC_Field
 */
class QBTTC_Field_SelectTaxonomies extends QBTTC_Field {

	/**
	 * Render this field.
	 *
	 * @access public
	 */
	public function render($no_help=false) {
		$field_value = $this->get_value();

    $dropdown_args = array(
      'hide_empty'        => 0,
      'hide_if_empty'     => false,
      'taxonomy'          => $this->get_taxonomy(),
      'id'                => $this->get_id(),
      'name'              => $this->get_id(),
      'orderby'           => 'name',
      'hierarchical'      => true,
      'selected'          => $field_value,
      'show_option_none'  => __( 'None' ),
    );

    $dropdown_args = apply_filters( 'taxonomy_parent_dropdown_args', $dropdown_args, $this->get_taxonomy(), 'new' );

    $terms = wp_dropdown_categories( $dropdown_args );
    if(!$no_help):
      $this->render_help();
    endif;
	}

	/**
	 * Retrieve the field taxonomy.
	 *
	 * @access public
	 *
	 * @return array $taxonomy The taxonomy of this field.
	 */
	public function get_taxonomy() {
		return $this->taxonomy;
	}

	/**
	 * Modify the taxonomy of this field.
	 *
	 * @access public
	 *
	 * @param array $taxonomy The new taxonomy.
	 */
	public function set_taxonomy($taxonomy) {
		$this->taxonomy = $taxonomy;
	}
  
  
  public function qbt_select_change() {
    $taxonomy = $_POST['taxonomy'];
    $this->set_taxonomy($taxonomy);
    
    echo $response = $this->render($no_help=true);
    wp_die(); 
  }

}