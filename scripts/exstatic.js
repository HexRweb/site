const {performance} = require('perf_hooks');
const exstatic = require('../@exstatic/packages/dev');

const instance = exstatic();

module.exports = async function compile() {
	console.log('Compiling html');
	const start = performance.now();
	await instance.build();
	const time = performance.now() - start;
	console.log(`Build took ${(time / 1000).toFixed(3)}s`);
	instance.onBeforeExit(true);
}

if (!module.parent) {
	compile();
}
