import { EventEmitter } from "events";

const myEmitter = new EventEmitter();

function greetHandler(name) {
  console.log("hello " + name);
}

function goodbyeHandler(name) {
  console.log("goodbye " + name);
}

// Register event listener
myEmitter.on("greet", greetHandler);
myEmitter.on("goodbye", goodbyeHandler);

// Emit events
myEmitter.emit("greet", "hoàng");
myEmitter.emit("goodbye", "hoàng");

// Error handling
myEmitter.on("error", (err) => {
  console.log("An error occured: ", err);
});

// Simulate error
myEmitter.emit("error", new Error('Something not good!'));
