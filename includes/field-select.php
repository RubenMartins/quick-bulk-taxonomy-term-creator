<?php
/**
 * Manages and renders a select settings field.
 *
 * @uses QBTTC_Field
 */
class QBTTC_Field_Select extends QBTTC_Field {
  
	/**
	 * Render this field.
	 *
	 * @access public
	 */
	public function render() {
    
		$field_value = $this->get_value();
		?>
		<select name="<?php echo $this->get_id(); ?>" id="<?php echo $this->get_id(); ?>" class="postform">
			<?php foreach ($this->get_options() as $value => $text): ?>
				<option value="<?php echo esc_attr($value); ?>" <?php selected($field_value, $value); echo $this->render_required(); ?>><?php echo $text; ?></option>
			<?php endforeach ?>
		</select>    
		<?php
		$this->render_help();
    
    wp_register_script( 
        'js_field_select', 
        plugins_url('../assets/js/field-select.js', __FILE__), 
        array( 'jquery' ),
        '2.1'
    );
    
    // Localize the script with new data
    $data_array = array(
      'id' => $this->get_id(),
      'siteurl' => get_option('siteurl')
    );
    
    wp_localize_script( 'js_field_select', 'data_php', $data_array );
    
    wp_enqueue_script( 'js_field_select' );
	}

	/**
	 * Retrieve the field options.
	 *
	 * @access public
	 *
	 * @return array $options The options of this field.
	 */
	public function get_options() {
		return $this->options;
	}

	/**
	 * Modify the options of this field.
	 *
	 * @access public
	 *
	 * @param array $options The new options.
	 */
	public function set_options($options) {
		$this->options = $options;
	}
  
}