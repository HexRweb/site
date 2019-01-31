const STATIC_FILES = ['favicon.ico', 'robots.txt', 'sitemap.xml', '_redirects'];
const exstatic = require('./@exstatic/packages/dev');
const {performance} = require('perf_hooks');

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
	const start = performance.now();
	await instance.build();
	const time = performance.now() - start;
	console.log(`Build took ${(time / 1000).toFixed(3)}s`);
	instance.onBeforeExit(true);
}

async function run() {
	console.log('Copying assets');
	await copyFiles();
	console.log('Building exstatic');
	return compile();
}

if (process.argv.join(' ').match(/-?-exstatic/)) {
	compile();
} else {
	run();
}

