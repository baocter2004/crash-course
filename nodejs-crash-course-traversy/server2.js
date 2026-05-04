import { createServer } from "http";
const PORT = process.env.PORT || 8000;

const users = [
  { id: 1, name: "John Doe" },
  { id: 2, name: "Jane Doe" },
  { id: 3, name: "Jim Doe" },
  { id: 4, name: "Jack Doe" },
];

// Logger middleware
const logger = (req, res, next) => {
  console.log(`${req.method} ${req.url}`);
  next();
};

// Json middleware
const jsonMiddleware = (req, res, next) => {
  res.setHeader("Content-Type", "application/json");
  next();
};

// Route Handlers for Get /api/users
const getUsersHandler = (req, res) => {
  res.write(JSON.stringify(users));
  res.end();
};

// Route Handlers for Get /api/users/:id
const getUserByIdHandler = (req, res) => {
  const userId = parseInt(req.url.split("/")[3]);
  const user = users.find((user) => user.id === parseInt(userId));
  if (user) {
    res.write(JSON.stringify(user));
  } else {
    res.statusCode = 404;
    res.write(JSON.stringify({ message: "User not found" }));
  }
  res.end();
};

// Route Handlers for Post /api/users
const createUserHandler = (req, res) => {
  let body = "";
  // Listen for data event to receive the request body
  req.on("data", (chunk) => {
    console.log('raw chunk received:', chunk);
    console.log("Received chunk:", chunk.toString());
    body += chunk.toString();
  });

  req.on("end", () => {
    const newUser = JSON.parse(body);
    console.log("Parsed new user:", newUser);
    // Add to memory array
    users.push(newUser);
    res.statusCode = 201;
    res.write(JSON.stringify(newUser));
    res.end();
  });
};

// Not Found Handler
const notFoundHandler = (req, res) => {
  res.statusCode = 404;
  res.write(JSON.stringify({ message: "Route not found" }));
  res.end();
};

const server = createServer((req, res) => {
  logger(req, res, () => {
    jsonMiddleware(req, res, () => {
      if (req.url === "/api/users" && req.method === "GET") {
        getUsersHandler(req, res);
      } else if (req.url.match(/\/api\/users\/\d+/) && req.method === "GET") {
        getUserByIdHandler(req, res);
      } else if (req.url === "/api/users" && req.method === "POST") {
        createUserHandler(req, res);
      } else {
        notFoundHandler(req, res);
      }
    });
  });

  //   if (req.url === "/api/users" && req.method === "GET") {
  //     res.setHeader("Content-Type", "application/json");
  //     res.write(JSON.stringify(users));
  //     res.end();
  //   } else if (req.url.match(/\/api\/users\/([0-9]+)/) && req.method === "GET") {
  //     const userId = parseInt(req.url.split("/")[3]);
  //     const user = users.find((user) => user.id === parseInt(userId));
  //     if (user) {
  //       res.setHeader("Content-Type", "application/json");
  //       res.write(JSON.stringify(user));
  //       res.end();
  //     } else {
  //       res.setHeader("Content-Type", "application/json");
  //       res.statusCode = 404;
  //       res.write(JSON.stringify({ message: "User not found" }));
  //       res.end();
  //     }
  //   } else {
  //     res.setHeader("Content-Type", "application/json");
  //     res.statusCode = 404;
  //     res.write(JSON.stringify({ message: "Route not found" }));
  //     res.end();
  //   }
});

server.listen(PORT, () => console.log(`Server running on port ${PORT}`));
