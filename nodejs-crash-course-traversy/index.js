import getPosts, { getPostLength } from "./PostController.js";

// const { generateRandomNumber, celciusToFahrenheit } = require("./utils");

console.log("Posts:", getPosts());
console.log("Number of Posts:", getPostLength());

// console.log("Random Number:", generateRandomNumber());
// console.log("Temperature in Fahrenheit:", celciusToFahrenheit(25));
