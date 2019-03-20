const path = require('path');
const readline = require('readline');
const {performance} = require('perf_hooks');

const sassPath = path.resolve(__dirname, './src/sass');
const isSassPath = absPath => absPath.indexOf(sassPath) >= 0;
const isMaterialPath = absPath => absPath.indexOf('material') >= 0;
const buildMaterial = require('./scripts/css');
const buildOverride = require('./scripts/hexr-styles');

const pipeline = (material) => {
	if (material) {
		return buildMaterial();
	}

	return buildOverride();
}

const elapsedTime = startTime => ((performance.now() - startTime) / 1000).toFixed(3);

function onFileEvent({modification, absolutePath}) {
	const file = absolutePath.replace(/\//g, path.sep);
	if (isSassPath(file)) {
		const isMat = isMaterialPath(file);
		const start = performance.now();
		return pipeline(isMat).then(() => {
			const fileText = isMat ? 'materialize' : 'global';
			console.log(`Rebuilt ${fileText} styles because ${path.relative(sassPath, file)} was ${modification} in ${elapsedTime(start)}s`);
		}).catch(error => {
			console.warn('Failed to rebuild css', error);
		});
	}
}

module.exports = (instance) => {
	if (!instance.events) {
		console.log('No event listener set up');
		return;
	}

	instance.events.on('file_modified', onFileEvent);

	console.log('Building css');
	const start = performance.now();
	return buildOverride().then(() => {
		readline.moveCursor(process.stdout, 0, -1);
		readline.clearLine(process.stdout, 0);
		console.log(`Building css...done [${elapsedTime(start)}s]`);
	});
};
