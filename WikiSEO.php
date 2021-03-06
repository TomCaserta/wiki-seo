<?php
/**
 * WikiSEO extension - Allows per page meta settings (keywords, description) and to change the title.
 * @version 1.2.1 - 2014/12/11 (based on the work of Vladimir Radulovski and Jim Wilson)
 *
 * @link https://www.mediawiki.org/wiki/Extension:WikiSEO Documentation
 * @link https://www.mediawiki.org/wiki/Extension_talk:WikiSEO Support
 * @link https://github.com/tinymighty/wiki-seo/issues Bug tracker
 * @link https://github.com/andru/wiki-seo Source Code
 *
 * @file
 * @ingroup Extensions
 * @package MediaWiki
 * @author Andru Vallance (Andrujhon)
 * @copyright (C) 2013 Andru Vallance
 * @license https://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

// Confirm MediaWiki environment.
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This file is a MediaWiki extension and thus not a valid entry point.' );
}

global $wgExtensionCredits, $wgAutoloadClasses, $wgExtensionMessagesFiles, $wgHooks;

// Display extension properties on MediaWiki.
$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'WikiSEO',
	'author' => array(
		'Andru Vallance', '...'
		),
	'url' =>'https://www.mediawiki.org/wiki/Extension:WikiSEO',
	'descriptionmsg' => 'seo-desc',
	'license-name' => 'GPL-2.0+',
	'version'=>'1.2.1'
);

// Register extension class.
$wgAutoloadClasses['WikiSEO'] = dirname(__FILE__) . '/WikiSEO.body.php';

// Register extension messages and other localisation.
$wgExtensionMessagesFiles['WikiSEOMagic'] = dirname( __FILE__ ) . '/WikiSEO.i18n.magic.php';
$wgExtensionMessagesFiles['WikiSEO'] = dirname( __FILE__ ) . '/WikiSEO.i18n.php';

//init the parser function & tag extension
$wgHooks['ParserFirstCallInit'][] = 'WikiSEO::init';
//check the wikitext for cached values
$wgHooks['OutputPageBeforeHTML'][] = 'WikiSEO::loadParamsFromWikitext';
//$wgHooks['OutputPageBeforeHTML'][] = 'WikiSEO::modifyHTML';

//set the tags
$wgHooks['BeforePageDisplay'][] = 'WikiSEO::modifyHTML';
