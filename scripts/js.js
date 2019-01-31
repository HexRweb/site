const path = require('path');
const {writeFile} = require('fs-extra');
const babel = require('@babel/core');
const libConcat = require('concat');
const uglify = require('terser');

const base = '../src/materialize/js/';
const components = [
	'cash.js',
	'component.js',
	'global.js',
	'anime.min.js',
	'collapsible.js',
	'dropdown.js',
	'modal.js',
	'materialbox.js',
	'parallax.js',
	'tabs.js',
	'tooltip.js',
	'waves.js',
	'toasts.js',
	'sidenav.js',
	'scrollspy.js',
	'autocomplete.js',
	'forms.js',
	'slider.js',
	'cards.js',
	'chips.js',
	'pushpin.js',
	'buttons.js',
	'datepicker.js',
	'timepicker.js',
	'characterCounter.js',
	'carousel.js',
	'tapTarget.js',
	'select.js',
	'range.js'
]

components.forEach((component, index) => components[index] = path.resolve(__dirname, `${base}${component}`));

async function concat() {
	return libConcat(components);
}

async function compile(bundle = false) {
	if (!bundle) {
		bundle = await concat();
	}

	const {code} = await babel.transformAsync(bundle);

	return code;
}

async function minify(compiled = false) {
	if (!compiled) {
		compiled = await compile();
	}

	return uglify.minify(compiled, {output: {comments: 'some'}}).code;
}

async function write(contents = false) {
	if (!contents) {
		contents = await minify();
	}

	return writeFile('./src/assets/js/material-slim.min.js', contents);
}

module.exports = {
	js: write,
	concat,
	compile,
	minify,
	write,
}

if (!module.parent) {
	write();
}
