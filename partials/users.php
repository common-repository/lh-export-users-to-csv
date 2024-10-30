<h1><?php echo esc_html(get_admin_page_title()); ?></h1>

<a href="<?php echo wp_nonce_url( admin_url( 'users.php?page=' ).$this->filename, self::return_plugin_namespace().'-generate_report', self::return_plugin_namespace().'-generate_report' ); ?>"> <button class="button button-blue button-bordered"><?php _e("Generate Report", self::return_plugin_namespace() ); ?></button></a>