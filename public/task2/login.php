<?php
ob_start();
session_start();
?>

<?php
$msg = '';

function getUsers()
{
    $file = fopen(__DIR__ . "/user.csv", "r");
    $users = [];
    while (!feof($file)) {
        $users[] = fgetcsv($file);
    }
    fclose($file);

    return $users;
}

if (isset($_POST['username']) && !empty($_POST['password'])) {
    //
    $userName = $_POST['username'];
    $password = $_POST['password'];

    //
    $i = 0;
    $users = getUsers();
    $userFound = null;

    //
    while ($userFound == null && $i < count($users)) {
        $userData = $users[$i];
        if ($userName == $userData[0] &&
            $password === $userData[1]) {
            $userFound = $userData;
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();;
        }
        $i++;
    }

    if ($userFound !== null) {
        header("Location: /success.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
        <a class="navbar-brand" href="#">LOGIN TEST</a>
    </div>
</nav>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mt-5">LOGIN FILE TEST</h1>

            <form role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">User Name</label>
                    <input type="text" class="form-control" name="username" id="username"
                           aria-describedby="userNameHelp"
                           placeholder="Enter User Name">
                    <small id="userNameHelp" class="form-text text-muted">We'll never share your User Name with anyone
                        else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.slim.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
