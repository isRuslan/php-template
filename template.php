<?php
/**
* 
*/
class Template {
	/**
	* 
	*/	
	private $vars = array();

	/**
	* 
	*/
	public function assign( $key, $value ) {
		$this->vars[$key] = $value;
	}

	/**
	* 
	*/
	public function parse( $template_file ) {
		if ( file_exists( $template_file ) ) {
			$content = file_get_contents($template_file);

			foreach ( $this->vars as $key => $value ) {
				$content = preg_replace( '/{' . $key . '}/', $value, $content );
				// $content = preg_replace('/{loop', replacement, subject);
			}

			eval( '?> ' . $content . '<?php ' );
		} else {
			exit( '<h1>Template error</h1>' );
		}
	}
}