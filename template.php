<?php
/**
* Template engine
* @author  Ruslan Ismagilov <ruslan.ismagilov.ufa@gmail.com>
*/
class Template {
	/**
	 * Content variables
	 * @access private
     * @var array
	 */
	private $vars = array();

	/**
 	 * Set template property in template file
 	 * @access public
 	 * @param string $key property name
 	 * @param string $value property value
	 */
	public function assign( $key, $value ) {
		$this->vars[$key] = $value;
	}

	/**
 	 * Parce template file
 	 * @access public
 	 * @param string $template_file
	 */
	public function parse( $template_file ) {
		if ( file_exists( $template_file ) ) {
			$content = file_get_contents($template_file);

			foreach ( $this->vars as $key => $value ) {
				if ( is_array( $value ) ) {
					foreach ( $value as $key_loop => $val_loop ) {
						foreach ($val_loop as $k_loop => $v_loop) {
							$content = preg_replace( '/{' . $k_loop . '}/', $v_loop, $content );
						}
					}
				} else {
					$content = preg_replace( '/{' . $key . '}/', $value, $content );
				}
			}

			eval( '?> ' . $content . '<?php ' );
		} else {
			exit( '<h1>Template error</h1>' );
		}
	}
}