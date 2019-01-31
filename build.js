const STATIC_FILES = ['favicon.ico', 'robots.txt', 'sitemap.xml', '_redirects'];
const exstatic = require('./@exstatic/packages/dev');

const instance = exstatic();

function copyFiles() {
	const {copy} = require('fs-extra');
	const {css} = require('./scripts/css');
	const {js} = require('./scripts/js')

	// Exstatic doesn't currently have support for 1:1 copying
	const promises = [copy('./src/assets', './built/assets'), css(), js()];
	STATIC_FILES.forEach(file => promises.push(copy(`./src/${file}`, `./built/${file}`)));
	return Promise.all(promises);
}

async function compile() {
	await instance.build();
}

async function run() {
	await Promise.all([compile(), copyFiles()]);
	instance.onBeforeExit(true);
}

run();
