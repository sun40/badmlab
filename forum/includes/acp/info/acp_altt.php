<?php
/**
*
* @package - NV Advanced Last Topic Titles
* @version $Id: acp_altt.php 37 2009-11-18 22:05:28Z nickvergessen $
* @copyright (c) 2007 nickvergessen nickvergessen@gmx.de http://www.flying-bits.org
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* @package module_install
*/
class acp_altt_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_altt',
			'title'		=> 'ALTT_TITLE',
			'version'	=> '1.2.9',
			'modes'		=> array(
				'config_altt'	=> array(
					'title'			=> 'ALTT_CONFIG',
					'auth'			=> 'acl_a_board',
					'cat'			=> array('ALTT_TITLE'),
				),
			),
		);
	}
}

?>