<?php

/**
 * @file plugins/importexport/files/FilesImportPlugin.inc.php
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING. 
 *
 * @class FilesImportPlugin
 */

import('lib.pkp.classes.plugins.ImportExportPlugin');

class FilesImportPlugin extends ImportExportPlugin {
	/**
	 * Constructor
	 */
	function FilesImportPlugin() {
		parent::ImportExportPlugin();
	}

	/**
	 * Called as a plugin is registered to the registry
	 * @param $category String Name of category plugin was registered to
	 * @param $path string
	 * @return boolean True iff plugin initialized successfully; if false,
	 * 	the plugin will not be registered.
	 */
	function register($category, $path) {
		$success = parent::register($category, $path);
		$this->addLocaleData();
		return $success;
	}

	/**
	 * @see Plugin::getTemplatePath($inCore)
	 */
	function getTemplatePath($inCore = false) {
		return parent::getTemplatePath($inCore) . 'templates/';
	}

	/**
	 * Get the name of this plugin. The name must be unique within
	 * its category.
	 * @return String name of plugin
	 */
	function getName() {
		return 'FilesImportPlugin';
	}

	/**
	 * Get the display name.
	 * @return string
	 */
	function getDisplayName() {
		return __('plugins.importexport.files.displayName');
	}

	/**
	 * Get the display description.
	 * @return string
	 */
	function getDescription() {
		return __('plugins.importexport.files.description');
	}

	/**
	 * Display the plugin.
	 * @param $args array
	 * @param $request PKPRequest
	 */
	function display($args, $request) {

		$templateMgr = TemplateManager::getManager($request);
		$press = $request->getPress();
		$context = $request->getContext();		
		$contextId = $context->getId();

		parent::display($args, $request);
		$templateMgr->assign('plugin', $this);

		switch (array_shift($args)) {
			case 'index':
			case '':
				$files =  scandir(getcwd().'/public/importedFiles');
				$templateMgr->assign('files',$files);
				$templateMgr->assign('baseUrl',$request->getBaseUrl());
				$templateMgr->display($this->getTemplatePath() . 'index.tpl');
				break;

			case 'uploadFile':

				$user = $request->getUser();
				import('lib.pkp.classes.file.TemporaryFileManager');
				$temporaryFileManager = new TemporaryFileManager();
				$temporaryFile = $temporaryFileManager->handleUpload('uploadedFile', $user->getId());

				if ($temporaryFile) {

					$json = new JSONMessage(true);
					$json->setAdditionalAttributes(array(
						'temporaryFileId' => $temporaryFile->getId()
					));
				} else {
					$json = new JSONMessage(false, __('common.uploadFailed'));
				}

				return $json->getString();

			case 'import':

				// get data from file
				$temporaryFileId = $request->getUserVar('temporaryFileId');
				$temporaryFileDao = DAORegistry::getDAO('TemporaryFileDAO');
				$user = $request->getUser();
				$temporaryFile = $temporaryFileDao->getTemporaryFile($temporaryFileId, $user->getId());
				if (!$temporaryFile) {
					$json = new JSONMessage(true, __('plugins.inportexport.files.noTemporaryFile'));
					return $json->getString();
				}
				$temporaryFilePath = $temporaryFile->getFilePath();
				$sucess = false;

				if (!file_exists(getcwd().'/public/importedFiles')) { //$request->getBaseUrl().
					mkdir(getcwd().'/public/importedFiles', 0777, true);
				}

				$sucess = rename($temporaryFilePath,
						getcwd().'/public/importedFiles/' .$temporaryFile->getOriginalFileName());

				// prepare and load template
				$templateMgr->assign('success',$sucess);
				$templateMgr->assign('originalFileName',$temporaryFile->getOriginalFileName());
				$json = new JSONMessage(true, $templateMgr->fetch($this->getTemplatePath() . 'results.tpl'));
				return $json->getString();

			default:
				$dispatcher = $request->getDispatcher();
				$dispatcher->handle404();
		}
	}

	/**
	 * @copydoc ImportExportPlugin::executeCLI
	 */
	function executeCLI($scriptName, &$args) {
		fatalError('Not implemented.');
	}

	/**
	 * @copydoc ImportExportPlugin::usage
	 */
	function usage($scriptName) {
		fatalError('Not implemented.');
	}
}

?>
