<?php

if( empty( $request ) ) {
	return;
}

?>
<p>Suggestion: <?php echo esc_html( $request['contact']['comment'] ); ?></p>
<p>
<ul>
	<li>Name: <?php echo esc_html( $request['contact']['name'] ); ?></li>
	<li>Email: <?php echo esc_html( $request['contact']['email'] ); ?></li>
	<li>URL: <?php echo esc_url( $request['contact']['url'] ); ?></li>
</ul>
</p>