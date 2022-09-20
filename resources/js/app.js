require('./bootstrap');
import fontawesome from '@fortawesome/fontawesome-free'
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

require('./components/Cash');
require('./components/IncomeExpenditure');
require('./components/Search');
require('./components/Sales');
require('./Account');

