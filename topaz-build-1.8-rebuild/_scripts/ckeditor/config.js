/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	config.toolbar = 'Licence';
 	config.height = 130;
	config.toolbar_Licence =
	[
		{ name: 'clipboard', items : [ 'Cut','Copy','Maximize' ] }
	];
	
	config.toolbar = 'Full';
	config.toolbar_Full =
	[
		{ name: 'document', items : [ 'Source','-','DocProps','Preview','Print','-','Templates' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		{ name: 'tools', items : [ 'Maximize', 'ShowBlocks' ] },
		'/',
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
		'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar' ] },
		'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'styles', items : [ 'Format','Font','FontSize' ] }
	];

	config.toolbar = 'User'; 
	config.toolbar_User =
	[
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'styles', items : [ 'Format' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord' ] }
	];
	
	config.toolbar = 'Limited'; 
	config.toolbar_Limited =
	[
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline' ] }
	];
	
	config.toolbar = 'Source'; 
	config.toolbar_Source =
	[
		{ name: 'document', items : [ 'Source','-','SelectAll','-','Maximize' ] }
	];
	
	config.filebrowserBrowseUrl = MEDIA_URL+'_modules/kcfinder/browse.php?type=files';
	config.filebrowserImageBrowseUrl = MEDIA_URL+'_modules/kcfinder/browse.php?type=images';
	config.filebrowserFlashBrowseUrl = MEDIA_URL+'_modules/kcfinder/browse.php?type=flash';
	config.filebrowserUploadUrl = MEDIA_URL+'_modules/kcfinder/upload.php?type=files';
	config.filebrowserImageUploadUrl = MEDIA_URL+'_modules/kcfinder/upload.php?type=images';
	config.filebrowserFlashUploadUrl = MEDIA_URL+'_modules/kcfinder/upload.php?type=flash';

};