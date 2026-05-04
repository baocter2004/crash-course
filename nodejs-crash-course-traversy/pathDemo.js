import path from "path";
import url from "url";

const filePath = "./dir1/dir2/test.txt";

// baseName()
console.log("baseName: ", path.basename(filePath));

// dirName()
console.log("dirName: ", path.dirname(filePath));

// extName()
console.log("extName: ", path.extname(filePath));

// parse()
console.log("parse: ", path.parse(filePath));

const __filename = url.fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

console.log("__filename", __filename);
console.log("__dirname", __dirname);


// join()

const filePath2 = path.join(__dirname, 'dir1','dir2', 'test.txt');
console.log("join : ", filePath2);

// resolve()
const filePath3 = path.resolve(__dirname, 'dir1','dir2', 'test.txt');
console.log("resolve : ", filePath3);