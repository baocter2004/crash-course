// import fs from 'fs';
import fs from "fs/promises";

// readFile() - callback
// this is asynchronous and non-blocking, meaning it will not stop the execution of the rest of the code while it reads the file.
// fs.readFile('./test.txt', 'utf8', (err, data) => {
//     if (err) {
//         console.error(err);
//         return;
//     }
//     console.log(data);
// });

// readFileSync() - synchronous version
// this is synchronous and blocking, meaning it will stop the execution of the rest of the code until it finishes reading the file.
// const data = fs.readFileSync('./test.txt', 'utf8');
// console.log(data);

// readFile() - promise version / .then() / async/await
// this is asynchronous and non-blocking, meaning it will not stop the execution of the rest of the code while it reads the file.

// readFile Promise .then()
// fs.readFile('./test.txt', 'utf8')
//     .then(data => console.log(data))
//     .catch(err => console.error(err));

// readFile Async / Await
// const readFile = async () => {
//   try {
//     const data = await fs.readFile("./test.txt", "utf-8");
//     console.log(data);
//   } catch (error) {
//     console.log(error);
//   }
// };

// readFile();


// writeFile()
// const writeFile = async () => {
//     try {
//         await fs.writeFile('./test.txt', 'Hello i am writing to this file');
//         console.log('done');
//     } catch (error) {
//         console.log(error);
//     }
// }
// writeFile();


// appendFile()

const appendFile = async () => {
    try {
        await fs.appendFile('./test.txt', '\n This is appended text');
        console.log('done');
    } catch (error) {
        console.log(error);
    }
}

appendFile();