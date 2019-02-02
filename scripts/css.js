const {promisify} = require('util');
const path = require('path');
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

async function prefix(contents = false) {
	if (contents === false) {
		contents = await sass();
	}

	const prefixed = await autoprefixer.process(contents, {from: undefined});

	return prefixed.css;
}

async function uglify(contents = false) {
	if (contents === false) {
		contents = await prefix();
	}

	const uglified = await cssnano.process(contents, {from: undefined});
	return uglified.css;
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
	prefix,
	uglify,
	write
};

if (!module.parent) {
	write();
}
