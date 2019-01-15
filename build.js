const {copy, move, remove} = require('fs-extra');
const Exstatic = require('exstatic');

const dirs = {
	inputDir: './src/pages',
	outputDir: './built',
	layoutsDir: './src/layouts',
	partialsDir: './src/partials'
};
const exstatic = Exstatic(dirs);
const STATIC_FILES = ['favicon.ico', 'robots.txt', 'sitemap.xml', '_redirects'];

function copyFiles() {
	// Exstatic doesn't currently have support for 1:1 copying
	let promises = [copy('./src/assets', './built/assets')];
	STATIC_FILES.forEach(file => promises.push(copy(`./src/${file}`, `./built/${file}`)));
	return Promise.all(promises);
}

async function compile() {
	await exstatic.initialize();
	await exstatic.loadFiles();
	await exstatic.write();
	// Exstatic is having issues handling explicit paths
	await move('./built/error/index.html', './built/404.html', {overwrite: true});
	await move('./built/error_403/index.html', './built/error_403.html', {overwrite: true});
	await remove('./built/error');
	await remove('./built/error_403');
}

async function run() {
	await Promise.all([compile(), copyFiles()]);
	exstatic.onBeforeExit(true);
}

run();
