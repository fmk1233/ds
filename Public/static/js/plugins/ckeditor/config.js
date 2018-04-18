/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config )
{
    config.filebrowserImageUploadUrl = ds.url({service:'Public.UploadImage',path:'goods_meno',json:0});
}