<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Validate input fields (e.g., check for empty fields)
    if (empty($_POST['email'])) {
        $errors[] = 'An email is required.';
    }
    if (empty($_POST['password'])) {
        $errors[] = 'A password is required.';
    }

    // Add more validation rules as needed

    if (empty($errors)) {
        // No validation errors, proceed to store user
        $userData = [
            'email' => $_POST['email'],
            'telephone' => $_POST['telephone'],
            'password' => $_POST['password'], // Include the password field
            // Add more fields as needed
        ];

        // Load existing users from JSON file
        $users = json_decode(file_get_contents('users.json'), true);

        // Add new user data to the array
        $users['users'][] = $userData;

        // Save updated user data back to JSON file
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));

        // Redirect or display success message
        header('Location: login.php');
        exit;
    } else {
        // There are validation errors, store them in session for display
        $_SESSION['errors'] = $errors;
        $_SESSION['input'] = $_POST; // Store user input to repopulate form fields
        header('Location: register.php');
        exit;
    }
}
?>
<!-- Your HTML form goes here -->


<!doctype html>
<html lang="en" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Example</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-full">

<div class="min-h-full flex">
    <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div>
                <img class="h-12 w-auto" src="https://tailwindui.com/img/logos/workflow-mark.svg?color=indigo&shade=600" alt="Workflow">
                <h2 class="mt-6 text-3xl tracking-tight font-bold text-gray-900">Register Today</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Or
                    <a href="/login.php" class="font-medium text-indigo-600 hover:text-indigo-500"> login </a>
                </p>
            </div>

            <div class="mt-8">
                <div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">Sign in with</p>

                        <!-- ... (remaining code remains unchanged) ... -->

                    </div>

                    <div class="mt-6 relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500"> Or continue with </span>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <form action="register.php" method="post" class="space-y-6">
                        <div>
                                <span class="text-red-500">
                                    <?php
                                    if (isset($_SESSION['email_error'])) {
                                        echo $_SESSION['email_error'];
                                        unset($_SESSION['email_error']);
                                    }
                                    ?>
                                </span>
                            <label for="email" class="block text-sm font-medium text-gray-700"> Email
                                address </label>
                            <div class="mt-1">
                                <input id="email" name="email" type="text" autocomplete="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="space-y-1">
                                <span class="text-red-500">
                                    <?php
                                    if (isset($_SESSION['telephone_error'])) {
                                        echo $_SESSION['telephone_error'];
                                        unset($_SESSION['telephone_error']);
                                    }
                                    ?>
                                </span>
                            <label for="telephone" class="block text-sm font-medium text-gray-700">
                                Telephone </label>
                            <div class="mt-1">
                                <input id="telephone" name="telephone" type="text" value="<?php echo isset($_SESSION['telephone']) ? $_SESSION['telephone'] : '' ?>" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="space-y-1">
                                <span class="text-red-500">
                                    <?php
                                    if (isset($_SESSION['password_error'])) {
                                        echo $_SESSION['password_error'];
                                        unset($_SESSION['password_error']);
                                    }
                                    ?>
                                </span>
                            <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" autocomplete="current-password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember
                                    me </label>
                            </div>

                            <div class="text-sm">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> Forgot your
                                    password? </a>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden lg:block relative w-0 flex-1">
        <img class="absolute inset-0 h-full w-full object-cover" src="https://images.unsplash.com/photo-1505904267569-f02eaeb45a4c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1908&q=80" alt="">
    </div>
</div>

</body>

</html>
