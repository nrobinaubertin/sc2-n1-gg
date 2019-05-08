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

// Race picto
z_picto = require('../images/z.svg');
t_picto = require('../images/t.svg');
p_picto = require('../images/p.svg');
