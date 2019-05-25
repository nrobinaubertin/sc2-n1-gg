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

window.race_icons = {
    'Z': require('../images/z.svg'),
    'P': require('../images/p.svg'),
    'T': require('../images/t.svg'),
    'R': require('../images/r.svg'),
    'S': require('../images/r.svg'),
}

window.flag_icons = {
    'AR': require('../images/flags/ar.png'),
    'AT': require('../images/flags/at.png'),
    'AU': require('../images/flags/au.png'),
    'BR': require('../images/flags/br.png'),
    'CA': require('../images/flags/ca.png'),
    'CL': require('../images/flags/cl.png'),
    'CN': require('../images/flags/cn.png'),
    'CZ': require('../images/flags/cz.png'),
    'DE': require('../images/flags/de.png'),
    'DK': require('../images/flags/dk.png'),
    'ES': require('../images/flags/es.png'),
    'FI': require('../images/flags/fi.png'),
    'FR': require('../images/flags/fr.png'),
    'HR': require('../images/flags/hr.png'),
    'HU': require('../images/flags/hu.png'),
    'IL': require('../images/flags/il.png'),
    'IN': require('../images/flags/in.png'),
    'IT': require('../images/flags/it.png'),
    'JP': require('../images/flags/jp.png'),
    'KR': require('../images/flags/kr.png'),
    'LT': require('../images/flags/lt.png'),
    'MX': require('../images/flags/dk.png'),
    'MY': require('../images/flags/my.png'),
    'NL': require('../images/flags/nl.png'),
    'NO': require('../images/flags/no.png'),
    'NZ': require('../images/flags/nz.png'),
    'PH': require('../images/flags/ph.png'),
    'PL': require('../images/flags/pl.png'),
    'RO': require('../images/flags/ro.png'),
    'RS': require('../images/flags/dk.png'),
    'RU': require('../images/flags/ru.png'),
    'SE': require('../images/flags/se.png'),
    'SG': require('../images/flags/sg.png'),
    'SK': require('../images/flags/sk.png'),
    'TH': require('../images/flags/th.png'),
    'TW': require('../images/flags/tw.png'),
    'UA': require('../images/flags/dk.png'),
    'UK': require('../images/flags/uk.png'),
    'US': require('../images/flags/us.png'),
    'VN': require('../images/flags/vn.png'),
};
