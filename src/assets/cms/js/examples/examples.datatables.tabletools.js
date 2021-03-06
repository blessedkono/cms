/*
Name: 			Tables / Advanced - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	2.1.1
*/

(function($) {

	'use strict';

	var datatableInit = function() {
		var $table = $('#tendering_actions-tabletools');

		var table = $table.dataTable({
			sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			buttons: [ 'print', 'excel', 'pdf' ]
		});

		$('<div />').addClass('dt-buttons mb-2 pb-1 text-right').prependTo('#tendering_actions-tabletools_wrapper');

		$table.DataTable().buttons().container().prependTo( '#tendering_actions-tabletools_wrapper .dt-buttons' );

		$('#tendering_actions-tabletools_wrapper').find('.btn-secondary').removeClass('btn-secondary').addClass('btn-default');
	};

	$(function() {
		datatableInit();
	});

}).apply(this, [jQuery]);
