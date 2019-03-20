const path = require('path');

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

function onFileEvent({modification, absolutePath}) {
	const file = absolutePath.replace(/\//g, path.sep);
	if (isSassPath(file)) {
		const isMat = isMaterialPath(file);
		return pipeline(isMat).then(() => {
			const fileText = isMat ? 'materialize' : 'global';
			console.log(`Rebuilt ${fileText} styles because ${path.relative(sassPath, file)} was ${modification}`);
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
	return buildOverride().then(() => {
		console.log('...done');
	});
};
