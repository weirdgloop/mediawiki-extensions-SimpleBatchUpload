<?php
/**
 * File containing the SimpleBatchUpload class
 *
 * @copyright (C) 2016 - 2019, Stephan Gambke
 * @license   GNU General Public License, version 2 (or any later version)
 *
 * This software is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * This software is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, see <http://www.gnu.org/licenses/>.
 *
 * @file
 * @ingroup SimpleBatchUpload
 */

namespace SimpleBatchUpload;

use MediaWiki\Hook\MakeGlobalVariablesScriptHook;
use MediaWiki\Hook\ParserFirstCallInitHook;
use Parser;

/**
 * Class ExtensionManager
 *
 * @package SimpleBatchUpload
 */
class SimpleBatchUpload implements
	MakeGlobalVariablesScriptHook,
	ParserFirstCallInitHook
{

	/**
	 * @param \Parser $parser
	 * @throws \MWException
	 */
	public function onParserFirstCallInit( $parser ) {
		$parser->setFunctionHook( 'batchupload', [ new UploadButtonRenderer(), 'renderParserFunction' ], Parser::SFH_OBJECT_ARGS );
	}

	/**
	 * @param array &$vars
	 * @param \OutputPage $out
	 */
	public function onMakeGlobalVariablesScript( &$vars, $out ) {
		global $wgSimpleBatchUploadMaxFilesPerBatch;
		$vars['simpleBatchUploadMaxFilesPerBatch'] = $wgSimpleBatchUploadMaxFilesPerBatch;
	}
}
