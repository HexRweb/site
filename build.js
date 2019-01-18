const {copy, move, remove} = require('fs-extra');
const exstatic = require('@exstatic/dev');

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
	// Exstatic is having issues handling explicit paths
	await move('./built/error/index.html', './built/404.html', {overwrite: true});
	await move('./built/error_403/index.html', './built/error_403.html', {overwrite: true});
	await remove('./built/error');
	await remove('./built/error_403');
}

async function run() {
	await Promise.all([compile(), copyFiles()]);
	instance.onBeforeExit(true);
}

run();
