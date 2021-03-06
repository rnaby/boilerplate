<?php # -*- coding: utf-8 -*-

namespace TheDramatistBoilerplate\Task;

use
	BrightNucleus\Boilerplate\Scripts\Task,
	Composer\Util;

/**
 * Renames the plugin file to {{package}}.php,
 * removes it, if the package is not of type wordpress-plugin
 *
 * @package TheDramatistBoilerplate\Task
 */
class SanitizePluginFile extends Task\AbstractTask {

	/**
	 * Renames the plugin file to {{package}}.php,
	 * removes it, if the package is not of type wordpress-plugin
	 */
	public function complete() {

		$fs          = new Util\Filesystem;
		$base_dir    = $this->getConfigKey( 'BaseDir' );
		$type        = $this->getConfigKey( 'Placeholders', 'type' )[ 'value' ];
		$package     = $this->getConfigKey( 'Placeholders', 'package_key' )[ 'value' ];
		$plugin_file = "{$base_dir}/plugin.php";

		if ( 'wordpress-plugin' === $type ) {
			$fs->copyThenRemove(
				$plugin_file,
				"{$base_dir}/{$package}.php"
			);

			return;
		}

		$this->io->write( "Removing plugin file" );
		$fs->remove( $plugin_file );
	}
}