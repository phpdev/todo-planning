// start the Stimulus application
import './bootstrap';

import './styles/global.scss';

import { registerVueControllerComponents } from '@symfony/ux-vue';

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));