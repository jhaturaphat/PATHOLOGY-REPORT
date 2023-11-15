/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		// { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		// { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		// { name: 'links' },
		// { name: 'insert' },
		// { name: 'forms' },
		// { name: 'tools' },
		// { name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		// { name: 'others' },
		'/', 
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup'] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ,'paragraph','liststyle'] },
		{ name: 'tools' },
		{ name: 'styles'},
		// { name: 'colors' },
		// { name: 'about' }
	];
	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	// config.format_tags = 'p;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	config.extraPlugins = 'liststyle,justify';
	config.autoGrow_onStartup = true;
	config.stylesSet = [        
        { name: '12px', element: 'span', attributes: { 'style': 'font-size: 12px;' } },
		{ name: '14px', element: 'span', attributes: { 'style': 'font-size: 14px;' } },
		{ name: '16px', element: 'span', attributes: { 'style': 'font-size: 16px;' } },
		{ name: '18px', element: 'span', attributes: { 'style': 'font-size: 18px;' } },
		{ name: '20px', element: 'span', attributes: { 'style': 'font-size: 20px;' } },
        // เพิ่มรูปแบบอื่น ๆ ตามที่คุณต้องการ
    ];
};
