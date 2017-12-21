/*
 * jQuery File Upload Plugin JS Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';

    $('#fileupload').fileupload({
        dataType: 'json',
        add: function (e, data) {
        	data.submit();
        },
        done: function (e, data) {

        	console.log(data.result.files[0].name);
        	$.each(data.result.files, function (index, file) {
        		/**
        		 *   <div class="col-sm-6 col-md-3">
				 *	    <div class="thumbnail">
				 *	      <img data-src="holder.js/300x200" alt="...">
				 *	      <div class="caption">
				 *	        <h3>Thumbnail label</h3>
				 *	        <p>...</p>
				 *	        <p><a href="#" class="btn btn-primary">Button</a> <a href="#" class="btn btn-default">Button</a></p>
				 *	      </div>
				 *	    </div>
				 *	  </div>
        		 * @type {String}
        		 */
        	   var remove = $('<a href="#" class="btn btn-default">Button</a>').on('click',function(ev){
        	   		ev.preventDefault();
        	   });

	           $('#listUpload').append(
	           		$('<li />')
	           			.html([
	           				//'<div class="col-sm-6 col-md-4">',
	           				//	'<div class="thumbnail">',
	           						'<img src=', '/img/upload/', encodeURIComponent(file.name),' />',
	           						'<input type="hidden" name="data[image][]" value="', encodeURIComponent(file.id), '" />',
	           						'<a href="#" class="btn btn-danger deleteImage" rel="', file.name, '">x</a>'//,
	           				//		'<div class="caption">',
	           				//			'<p><a href="#" class="btn btn-danger deleteImage">Borrar</a></p>',
	           				//		'</div>',
	           				//	'</div>',
	           				//'</div>'
	           			].join(''))
	           ).sortable()
             $('.deleteImage', '#listUpload').on('click', function(e){
	           		e.preventDefault();
	           		$.ajax({
			   			      type : 'DELETE',
			   			      url : '/admin/upload?file=' + $(this).attr('rel')
		   		      });
	           		$(this).parent().remove();
	           })
	        });
	        $('#actions').text('');
        	console.log(data);

        }
    });

    $('#listUpload').sortable();

    $('.deleteImage', '#listUpload').on('click', function(e){
       e.preventDefault();
       $.ajax({
           type : 'DELETE',
           url : '/admin/upload?file=' + $(this).attr('rel')
       });
       $(this).parent().remove();
    });
});
