const Exstatic = require('exstatic');

const dirs = {
    inputDir: './src/pages',
    outputDir: './built',
    layoutsDir: './src/layouts',
    partialsDir: './src/partials'
};
const exstatic = Exstatic(dirs);

async function run() {
    await exstatic.initialize();
    return exstatic.run();
}

run();
