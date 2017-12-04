<?php

if( empty( $request ) ) {
	return;
}

?>
<p>Subject: <?php echo esc_html( inaset_get_contact_topic_label( $request['contact']['subject'] ) ); ?></p>
<p>Remarks: <?php echo esc_html( $request['contact']['comment'] ); ?></p>
<p>
	<ul>
		<li>Language: <?php echo esc_html( strtoupper( $request['contact']['language'] ) ); ?></li>
		<li>Name: <?php echo esc_html( $request['contact']['name'] ); ?></li>
		<li>Email: <?php echo esc_html( $request['contact']['email'] ); ?></li>
		<li>Phone Number: <?php echo esc_html( $request['contact']['phone'] ); ?></li>
		<li>Country: <?php echo esc_html( $request['contact']['country'] ); ?></li>
		<li>City: <?php echo esc_html( $request['contact']['city'] ); ?></li>
		<li>Company: <?php echo esc_html( $request['contact']['company'] ); ?></li>
		<li>Job Title: <?php echo esc_html( $request['contact']['job'] ); ?></li>
	</ul>
</p>