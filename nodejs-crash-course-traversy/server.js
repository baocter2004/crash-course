// Importing the built-in 'http' module to create an HTTP server
import http from "http";
// Importing the built-in 'fs/promises' module to work with the file system, allowing us to read and write files
import fs from "fs/promises";
// Importing the 'url' and 'path' modules to work with URLs and file paths, respectively
import url from "url";
import path from "path";
// Define the port to listen on, using an environment variable if available, or defaulting to 8000
const PORT = process.env.PORT || 8000;

/**
 * Get current path
 * __dirname : gives the directory name of the current module. This is useful for constructing paths to files relative to the current file.
 * __filename : gives the full path of the current file, including the filename itself. This is useful for getting the directory of the current file by using path.dirname(__filename).
 */
const __filename = url.fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
// console.log("Import Meta URL:", import.meta.url);
// console.log("Filename:", __filename);
// console.log("Directory:", __dirname);

// Using NodeMon for development to automatically restart the server on file changes
// Without NodeMon, you would run the server with: node --watch server.js to enable auto-restart on changes in Node 18+
// In older versions, you would simply run: node server.js and manually restart on changes

const server = http.createServer(async (req, res) => {
  // res.setHeader("Content-Type", "text/html");
  // res.statusCode = 404;

  // Log the request URL and method to the console - this is useful for debugging and understanding incoming requests
  // console.log(req.url);
  // console.log(req.method);

  try {
    // Check if the Get request
    if (req.method === "GET") {
      let filePath = "";
      if (req.url === "/") {
        filePath = path.join(__dirname, "public", "index.html");
      } else if (req.url === "/about") {
        filePath = path.join(__dirname, "public", "about.html");
      } else {
        throw new Error("Page not found");
      }

      const data = await fs.readFile(filePath, "utf8");
      res.setHeader("Content-Type", "text/html");
      res.writeHead(200);
      res.end(data);
    } else {
      throw new Error("Method not supported");
    }
  } catch (error) {
    res.writeHead(500, { "Content-Type": "text/html" });
    res.end("<h1>Internal Server Error</h1>");
  }

  // res.writeHead(200, { "Content-Type": "application/json" });
  // res.end(JSON.stringify({ message: "Hello, World!" }));
});

server.listen(PORT, () => {
  console.log(`Server running on port ${PORT}`);
});
