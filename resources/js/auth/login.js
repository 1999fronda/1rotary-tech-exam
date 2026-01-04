console.log("Test login", $);

$.post("/login", {
    email: "smurf@example.com",
    password: "secret",
});
