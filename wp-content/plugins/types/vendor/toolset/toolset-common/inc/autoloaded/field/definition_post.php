<?php

/**
 * Post field definition.
 * 
 * Warning: This is implemented only partially - the field accessor is missing, a dummy one is returned instead.
 * 
 * @since 2.0
 */
final class Toolset_Field_Definition_Post extends Toolset_Field_Definition {

	/**
	 * Get an accessor for a specific field instance.
	 *
	 * @param Toolset_Field_Instance $field_instance Instance of the field the accessor should access.
	 *
	 * @return Toolset_Field_Accessor_Abstract
	 */
	public function get_accessor( Toolset_Field_Instance $field_instance ) {
		return new Toolset_Field_Accessor_Postmeta_Field(
			$field_instance->get_object_id(),
			$this->get_meta_key(),
			$this->get_is_repetitive(),
			$field_instance
		);
	}
	

	/**
	 * Delete all field values!
	 *
	 * @return bool
	 */
	public function delete_all_fields() {
		global $wpdb;

		$meta_key = $this->get_meta_key();

		$postmeta_records = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s",
				$meta_key
			)
		);

		// Delete one by one because we (probably) want all the WP hooks to fire.
		foreach ( $postmeta_records as $postmeta ) {
			delete_post_meta( $postmeta->post_id, $meta_key );
		}

		return true;
	}
	

	/**
	 * @inheritdoc
	 *
	 * Adds properties: domain
	 *
	 * @return array
	 * @since 2.0
	 */
	public function to_json() {
		$object_data = parent::to_json();

		$additions = array(
			'domain' => 'posts'
		);

		return array_merge( $object_data, $additions );
	}


	/**
	 * Create an instance of the field for a specific element.
	 *
	 * @param int $element_id Id of the object containing the field.
	 *
	 * @return Toolset_Field_Instance
	 * @since m2m
	 * @throws InvalidArgumentException
	 */
	public function instantiate( $element_id ) {
		return new Toolset_Field_Instance_Post( $this, $element_id );
	}

}