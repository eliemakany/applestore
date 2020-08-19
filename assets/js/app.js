/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// CSS
import '../css/app.scss';

// JS
import $ from 'jquery'
import 'popper.js';
import 'bootstrap';

// Input type file management for apple creation

$('.custom-file-input').on('change', function (e) {
    var input = e.currentTarget;
    $(input).parent().find('.custom-file-label').html(input.files[0].name);
});

// CKeditor integration

import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

if(document.querySelector( '.editor' ) != null)
{
    ClassicEditor.create( document.querySelector( '.editor' ) )
        .catch( error => {
            console.error( error );
        } );
}