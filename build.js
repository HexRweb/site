const STATIC_FILES = ['favicon.ico', 'robots.txt', '_redirects'];
const argString = process.argv.join('  ');
const hasArg = arg => Boolean(new RegExp(`-?-${arg}`).test(argString));

async function buildAssets() {
	const {css} = require('./scripts/css');
	const overCss = require('./scripts/hexr-styles');
	const {js} = require('./scripts/js')
	console.log('Building assets');
	return Promise.all([css(), js(), overCss()]);
}

async function copyFiles() {
	const {copy} = require('fs-extra');

	if (hasArg('build')) {
		await buildAssets();
	}

	// Exstatic doesn't currently have support for 1:1 copying
	const promises = [copy('./src/assets', './built/assets')];
	STATIC_FILES.forEach(file => promises.push(copy(`./src/${file}`, `./built/${file}`)));
	console.log('Copying assets');
	return Promise.all(promises);
}

function compile() {
	const runCompile = require('./scripts/exstatic');
	return runCompile();
}

async function run() {
	await copyFiles();
	return compile();
}

if (hasArg('compile')) {
	compile();
} else if (hasArg('copy') || hasArg('build')){
	copyFiles();
} else {
	run();
}

