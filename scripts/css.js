const {promisify} = require('util');
const path = require('path');
const postcss_ = require('postcss');
const autoprefixer = require('autoprefixer');
const {writeFile} = require('fs-extra');
const nodeSass = require('node-sass');
const cssnano = require('cssnano');

const render = promisify(nodeSass.render);

async function sass(component = 'materialize') {
	const absolutePath = path.resolve(__dirname, `../src/sass/${component}.scss`);
	const result = await render({file: absolutePath});

	return result.css;
}

async function postcss(contents = false) {
	if (contents === false) {
		contents = await sass();
	}

	const prefixed = await postcss_([autoprefixer, cssnano]).process(contents, {from: undefined});

	return prefixed.css;
}

async function write(contents = false, file = 'material-slim.min') {
	if (contents === false) {
		contents = await uglify();
	}

	return writeFile(`./src/assets/css/${file}.css`, contents);
}

module.exports = {
	css: write,
	sass,
	postcss,
	write
};

if (!module.parent) {
	write();
}
