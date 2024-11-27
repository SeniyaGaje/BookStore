<?php
include "./shared/DBconnection.php";
include "./shared/common.php";
if ($_SESSION["logged"] == "") {
    die("You have to login to edit profile");
}
if (isset($_POST['submit'])) {
    $newPassword = $_POST['pass'];
    $userName = $_POST['name'];

    $updateQuery = "UPDATE users SET userName = '$userName', userPass = '$newPassword' WHERE userEmail = '{$_SESSION['logged']}';";

    if ($connection->query($updateQuery) === TRUE) {
        die("<h1>Profile updated successfully.</h1> <a href='./index.php'>Click</a> to redirect to homepage");
    } else {
        die("<h1>Error updating account.</h1>Error: {$connection->error}<br /> <br /><a href='./index.php'>Click</a> to redirect to homepage");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profile Update</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montagu+Slab:wght@500&family=Montserrat:wght@400;500;600&display=swap");

        body {}

        form {


            display: flex;
            flex-direction: column;
            font-family: "Montserrat", sans-serif;
            gap: 35px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(64, 64, 64, 0.1);
            background-color: hsl(230, 100%, 97%);
            padding: 2rem 1.5rem;
            border: 2px solid hsl(230, 50%, 90%);
            row-gap: 1.25rem;
        }

        h2 {
            margin: 0;
            line-height: 100%;
            text-align: center;
            color: hsl(230, 62%, 56%);
        }

        div {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        td {
            height: 35px;
            vertical-align: center;
        }

        button {
            padding: 7px 15px;
            border-radius: 4px;
            border: none;
            background-color: hsl(230, 16%, 45%);
            color: white;
        }

        input {
            padding: 5px 10px;
        }

        /* 520 */
    </style>
</head>

<body style="display: flex; justify-content: center; align-items: center; min-height: 75vh; padding: 50px;">
    <form onSubmit="return editValidation();" method="post">
        <h2>
            Update your account
        </h2>
        <table>
            <tr>
                <td>Email:</td>
                <td><input type="email" maxlength="45" value="<?php echo $_SESSION["logged"]; ?>" disabled required></td>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" maxlength="45" value="<?php
                                                                $query = "SELECT userName FROM users WHERE userEmail = '{$_SESSION['logged']}';";
                                                                $result = $connection->query($query);

                                                                if ($result->num_rows > 0) {
                                                                    while ($row = $result->fetch_assoc()) {
                                                                        echo $row["userName"];
                                                                    }
                                                                } else {
                                                                    echo "N/A";
                                                                }
                                                                ?>" name="name" id="name" required></td>
            </tr>
            <tr>
                <td>New Password:</td>
                <td><input type="password" name="pass" id="pass" maxlength="16" required></td>
            </tr>
            <tr>
                <td>Confirm Password:&nbsp;&nbsp;</td>
                <td><input type="password" name="confPass" id="confPass" maxlength="16" required></td>
            </tr>
        </table>
        <div>
            <a href="./index.php">
                <button type="button">
                    Cancel
                </button>
            </a>
            <a href="./actions/deleteAcc.php" onclick="return confirm('Are you sure?');">
                <button style="background-color: rgb(128, 0, 0);" type="button">
                    Delete Account
                </button>
            </a>
            <button type="submit" style="background-color: hsl(230, 62%, 56%);" name="submit">
                Update
            </button>
        </div>
    </form>

    <script>
        const editValidation = () => {
            const pass = document.getElementById("pass").value;
            const confPass = document.getElementById("confPass").value;

            if (pass != confPass) {
                alert("Password Missmatch");
                return false;
            }
            return confirm("This can't be undone. wish to go ahead?");
        }
    </script>


</body>

</html>