import './bootstrap.js';

import 'bootstrap/dist/css/bootstrap.min.css';
import {Application } from 'stimulus';
import { definitionsFromContext } from 'stimulus/webpack-helpers';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

const application = Application.start();
const context = require.context('./controllers', true, /\.js$/);
application.load(definitionsFromContext(context));

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
