// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

$ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

$(document).ready(function() {
	$('[data-toggle="popover"]').popover();
});

Highcharts = require('highcharts');
