const {promisify} = require('util');
const {rename, rmdir} = require('fs');
const Exstatic = require('exstatic');

const move = promisify(rename);
const del = promisify(rmdir);

const dirs = {
    inputDir: './src/pages',
    outputDir: './built',
    layoutsDir: './src/layouts',
    partialsDir: './src/partials'
};
const exstatic = Exstatic(dirs);

async function run() {
    await exstatic.initialize();
    await exstatic.loadFiles();
    await exstatic.write();
    // Exstatic is having issues handling explicit paths
    await move('./built/error/index.html', './built/error.html');
    await move('./built/error_403/index.html', './built/error_403.html');
    await del('./built/error');
    await del('./built/error_403');
    exstatic.onBeforeExit(true);
}

run();
