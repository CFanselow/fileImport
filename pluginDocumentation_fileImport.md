Key data
============

- name of the plugin: File Import Plugin
- author: Carola Fanselow
- current version: 1.0.0.0
- tested on OMP version: 1.2.0
- github link: https://github.com/langsci/fileImport.git
- community plugin: yes, 1.0.0.0
- date: 11.5.2016

Description
============

Plugin for importing files to the directory 'public/importedFiles'. 

 
Implementation
================

Hooks
-----
- used hooks: 0

New pages
------
- new pages: 1

		[press]/management/importexport/plugin/FileImportPlugin

Templates
---------
- templates that substitute other templates: 0
- templates that are modified with template hooks: 0
- new/additional templates: 2

		index.tpl
		results.tpl

Database access, server access
-----------------------------
- reading access to OMP tables: 1

		temporary_files

- writing access to OMP tables: 1

		temporary_files

- new tables: 0
- nonrecurring server access: yes

		creating folder 'importedFiles' in folder 'public'

- recurring server access: yes

		saving files to folder 'public/importedFiles'
 
Classes, plugins, external software
-----------------------
- OMP classes used (php): 2
	
		ImportExportPlugin
		TemporaryFileManager

- OMP classes used (js, jqeury, ajax): 1

		FileUploadFormHandler
		TabHandler

- necessary plugins: 0
- optional plugins: 0
- use of external software: no
- file upload: yes
 
Metrics
--------
- number of files 8
- lines of code: 440

Settings
--------
- settings: no

Plugin category
----------
- plugin category: importexport

Other
=============
- does using the plugin require special (background)-knowledge?: no
- access restrictions: access restricted to admins and managers
- adds css: no


