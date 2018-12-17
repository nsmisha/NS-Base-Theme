<?php

//function neversettle_repeater_callback( $args ) {
//	$menu = $args['menu'];
//	$id   = $args['id'];
//
//	$options = get_option( $menu );
//	if ( isset( $options[ $id ] ) ) {
//		$current = $options[ $id ];
//	} else {
//		$current = isset( $args['default'] ) ? $args['default'] : '';
//	}
//	echo '<pre>';
//	var_dump( $options );
//	echo '</pre>';
//	$linkedin_url = $options[ $id . '_linkedin' ] ? $options[ $id . '_linkedin' ] : '';
//	?>
	<!--    <script type="text/javascript">-->
	<!--        jQuery(document).ready(function ($) {-->
	<!--            $('#add-row').on('click', function () {-->
	<!--                var row = $('.empty-row.screen-reader-text').clone(true);-->
	<!--                row.removeClass('empty-row screen-reader-text');-->
	<!--                row.insertBefore('#repeatable-fieldset-one tbody>tr:last');-->
	<!--                return false;-->
	<!--            });-->
	<!---->
	<!--            $('.remove-row').on('click', function () {-->
	<!--                $(this).parents('tr').eq(0).remove();-->
	<!--                return false;-->
	<!--            });-->
	<!--        });-->
	<!--    </script>-->
	<!--    <label for="linkedin---><?php //echo $id; ?><!--">Linkedin URL:</label><br>-->
	<!--    <input name="name[linkedin]" type="text" id="linkedin---><?php //echo $id; ?><!--"-->
	<!--           value="--><?php //echo esc_attr( $linkedin_url ); ?><!--" class="regular-text"/>-->
	<!--    <table id="repeatable-fieldset-one" width="100%">-->
	<!--        <thead>-->
	<!--        <tr>-->
	<!--            <th width="50%">Role</th>-->
	<!--        </tr>-->
	<!--        </thead>-->
	<!--        <tbody>-->
	<!--		--><?php
//		if ( $current ) :
//			foreach ( $current as $group_role ) :
//				?>
	<!--                <tr>-->
	<!--                    <td>-->
	<!--                        <input type="text" class="widefat" name="name[]" value="--><?php //if ( $group_role['name'] != '' ) {
//							echo esc_attr( $group_role['name'] );
//						} ?><!--"/>-->
	<!--                    </td>-->
	<!--                    <td><a class="button remove-row" href="#">Remove</a></td>-->
	<!--                </tr>-->
	<!--			--><?php //endforeach;
//		else :
//			// show a blank one
//			?>
	<!--            <tr>-->
	<!--                <td><input type="text" class="widefat" name="name[]"/></td>-->
	<!--                <td><a class="button remove-row" href="#">Remove</a></td>-->
	<!--            </tr>-->
	<!--		--><?php //endif; ?>
	<!---->
	<!--        <!-- empty hidden one for jQuery -->-->
	<!--        <tr class="empty-row screen-reader-text">-->
	<!--            <td><input type="text" class="widefat" name="name[]"/></td>-->
	<!--            <td><a class="button remove-row" href="#">Remove</a></td>-->
	<!--        </tr>-->
	<!--        </tbody>-->
	<!--    </table>-->
	<!---->
	<!--    <p><a id="add-row" class="button" href="#">Add Role</a></p>-->
	<!--	--><?php
//}
//
//add_action( 'update_option_neversettle_general', 'um_check_settings', 10, 2 );
//
//function um_check_settings( $old_value, $new_value )
//{
//	echo '<pre>';
//	var_dump($_POST);
////    var_dump($old_value);
////    var_dump($new_value);
//	echo '</pre>';
//	$old = get_post_meta( $post_id, 'cu_group_roles', true );
//	$new = array();
//
//	$names   = $_POST['name'];
//	$selects = $_POST['select'];
//	$urls    = $_POST['url'];
//
//	$count = count( $names );
//
//	for ( $i = 0; $i < $count; $i ++ ) {
//		if ( $names[ $i ] != '' ) :
//			$new[ $i ]['name'] = stripslashes( strip_tags( $names[ $i ] ) );
//
//
//		endif;
//	}
//	if ( ! empty( $new ) && $new != $old ) {
//		update_post_meta( $post_id, 'cu_group_roles', $new );
//	} elseif ( empty( $new ) && $old ) {
//		delete_post_meta( $post_id, 'cu_group_roles', $old );
//	}
//	die;
//}
