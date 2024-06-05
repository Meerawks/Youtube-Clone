<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    background-color:  #0e0e0e;
    color: #fff;
    font-family: sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}

.container {
    background-color: #181818;
    padding: 60px;
    width: 400px;
    border-radius: 5px;
    text-align: center;
}

h1 {
    font-size: 2em;
    margin-bottom: 20px;
}

.input-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="email"], input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

button {
    background-color: #c4302b;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

button:hover {
    background-color: #b72b1e;
}
</style>
<body>
    <div class="container">
        <form action="userauthentication.php" method="post"> <h1>Log in</h1>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Log in</button>
        </form>
    </div>
</body>
</html>
