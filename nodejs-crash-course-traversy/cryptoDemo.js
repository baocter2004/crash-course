import crypto, { randomBytes } from "crypto";

// createHash()
const hash = crypto.createHash('sha256');
hash.update('password123');
console.log(hash.digest('hex'));

// randomBytes
crypto.randomBytes(16, (error, buffer) => {
    if (error) throw error;
    console.log(buffer.toString('hex'));
})
