const {copy} = require('fs-extra');
const exstatic = require('./@exstatic/packages/dev');

const STATIC_FILES = ['favicon.ico', 'robots.txt', 'sitemap.xml', '_redirects'];
const instance = exstatic();

function copyFiles() {
	// Exstatic doesn't currently have support for 1:1 copying
	let promises = [copy('./src/assets', './built/assets')];
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
