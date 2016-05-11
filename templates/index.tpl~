{**
 * plugins/importexport/files/templates/index.tpl
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING. 
 *
 * List of operations this plugin can perform
 *}

{strip}
{assign var="pageTitle" value="plugins.importexport.files.displayName"}
{include file="common/header.tpl"}
{/strip}

{if !$errorMessage}

<script type="text/javascript">
	// Attach the JS file tab handler.
	$(function() {ldelim}
		$('#importTabs').pkpHandler('$.pkp.controllers.TabHandler');
	{rdelim});
</script>

<div id="importTabs" class="pkp_controllers_tab">
	<ul>
		<li><a href="#import-tab">{translate key="plugins.importexport.files.importButton"}</a></li>
	</ul>
	<div id="import-tab">
		<script type="text/javascript">
			$(function() {ldelim}
				// Attach the form handler.
				$('#fileImportForm').pkpHandler('$.pkp.controllers.form.FileUploadFormHandler',
					{ldelim}
						$uploader: $('#plupload'),
							uploaderOptions: {ldelim}
								uploadUrl: '{plugin_url path="uploadFile"}',
								baseUrl: '{$baseUrl|escape:javascript}'
							{rdelim}
					{rdelim}
				);
			{rdelim});
		</script>

		<h4>{translate key="plugins.importexport.files.directory"}</h4>

		{if $files}
			<ul>
			{foreach from=$files item=file}
				{assign var=firstchar value=$file|substr:0:1}
				{if $firstchar!=='.'}
				<li>{$file}</li>
				{/if}
			{/foreach}
			</ul>
		{else}
			<p>{translate key="plugins.importexport.files.noFiles"}</p>
		{/if}

		<form id="fileImportForm" class="pkp_form" action="{plugin_url path="import"}" method="post">
			{fbvFormArea id="importForm"}

				{* Container for uploaded file *}
				<input type="hidden" name="temporaryFileId" id="temporaryFileId" value="" />

				<p>{translate key="plugins.importexport.files.import.instructions"}</p>

				{fbvFormArea id="file"}
					{fbvFormSection title="common.file"}
						{include file="controllers/fileUploadContainer.tpl" id="plupload"}
					{/fbvFormSection}
				{/fbvFormArea}

				{fbvFormButtons hideCancel="true"}
			{/fbvFormArea}
		</form>
	</div>
</div>

{else}
	{$errorMessage}
{/if}

{include file="common/footer.tpl"}
