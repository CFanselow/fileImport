{**
 * plugins/importexport/files/templates/results.tpl
 *
 * Copyright (c) 2016 Language Science Press
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING. 
 *
 *}

{if $success}
	<p>{$originalFileName} {translate key="plugins.importexport.files.success"}</p>
{else}
	<p>{$originalFileName} {translate key="plugins.importexport.files.failure"}</p>
{/if}

<form>
	<input type="button" onClick="history.go(0)" VALUE="{translate key="plugins.importexport.files.refresh"}">
</form>



