<?php

if ( class_exists( 'WP_REST_Posts_Controller' ) ) {


	class Inaset_Contact_Form_Endpoint extends WP_REST_Posts_Controller {
		/**
		 * Check whether a given request has proper authorization to view feedback items.
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 * @return WP_Error|boolean
		 */
		public function get_items_permissions_check( $request ) {
			if ( ! is_user_member_of_blog( get_current_user_id(), get_current_blog_id() ) ) {
				return new WP_Error(
					'rest_cannot_view',
					esc_html__( 'Sorry, you cannot view this resource.', 'colombo-cpt' ),
					array( 'status' => 401 )
				);
			}

			return true;
		}

		/**
		 * Check whether a given request has proper authorization to view feedback item.
		 *
		 * @param  WP_REST_Request $request Full details about the request.
		 * @return WP_Error|boolean
		 */
		public function get_item_permissions_check( $request ) {
			if ( ! is_user_member_of_blog( get_current_user_id(), get_current_blog_id() ) ) {
				return new WP_Error(
					'rest_cannot_view',
					esc_html__( 'Sorry, you cannot view this resource.', 'colombo-cpt' ),
					array( 'status' => 401 )
				);
			}

			return true;
		}

		/**
		 * Checks if a given request has access to create a post.
		 *
		 * @since 4.7.0
		 * @access public
		 *
		 * @param WP_REST_Request $request Full details about the request.
		 * @return true|WP_Error True if the request has access to create items, WP_Error object otherwise.
		 */
		public function create_item_permissions_check( $request ) {
			if ( ! empty( $request['id'] ) ) {
				return new WP_Error( 'rest_post_exists', __( 'Cannot create existing post.' ), array( 'status' => 400 ) );
			}

			$nonce = $request->get_header('x_wp_nonce');
			$result = wp_verify_nonce( $nonce, 'wp_rest' );

			if ( ! $result ) {
				return new WP_Error( 'rest_cookie_invalid_nonce', __( 'Cookie nonce is invalid' ), array( 'status' => 403 ) );
			}

			if ( ! empty( $request['author'] ) ) {
				return new WP_Error( 'rest_cannot_edit_others', __( 'Sorry, you are not allowed to create posts as this user.' ), array( 'status' => rest_authorization_required_code() ) );
			}

			if ( ! empty( $request['sticky'] ) ) {
				return new WP_Error( 'rest_cannot_assign_sticky', __( 'Sorry, you are not allowed to make posts sticky.' ), array( 'status' => rest_authorization_required_code() ) );
			}

			if ( ! $this->check_assign_terms_permission( $request ) ) {
				return new WP_Error( 'rest_cannot_assign_term', __( 'Sorry, you are not allowed to assign the provided terms.' ), array( 'status' => rest_authorization_required_code() ) );
			}

			return true;
		}


		public function update_item_permissions_check( $request ) {
			return new WP_Error( 'rest_cannot_edit', __( 'Sorry, you are not allowed to edit this post.' ), array( 'status' => rest_authorization_required_code() ) );
		}

		public function delete_item_permissions_check( $request ) {
			return new WP_Error( 'rest_cannot_delete', __( 'Sorry, you are not allowed to delete this post.' ), array( 'status' => rest_authorization_required_code() ) );
		}


	}

}
