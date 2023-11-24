<?php

namespace Controller;

class LoginResponse extends AbstractResponse
{

    /**
     * Function used to create the Login.php page.
     */
    public function execute($token = "")
    {
        if (empty($token)) {
            $this->session = new Session();
            $this->authentication = new Authentication();
            //Run authorization
            $this->auth();
            // If form submitted login user
            if (isset($_POST['submit'])) {
                array_pop($_POST); // Remove submit index from array
                $data = $_POST;

                // Create and run validator 
                $this->validator = new \Model\Validator($data, $this->errorHandler);
                $this->validator->runValidation();

                //Get errors
                $errors = $this->session->get('errors');
                $error = "<ul>";

                //If there are errors create error <ul> and assign to template
                if (!empty($errors)) {
                    foreach ($errors as $category => $msg) {

                        $error .= "<li>" . $category . ": " . $msg . "<br></li>";
                    }
                    $error .= "</ul>";
                    $errorDIV = $this->templateEngine->createDiv($error, "error");
                    $this->templateEngine->assign("error", $errorDIV);
                } else { //Login user
                    $this->authentication->setUserModel(new \Model\UserModel());

                    if ($this->authentication->login($_POST["email"], $_POST["password"])) {
                        //redirect to dashboard on success
                        $this->session->remove('errors');
                        header("Location: Dashboard.php");
                    } else {
                        // display errors
                        $this->errorHandler->setErrors(['Email/Password' => "Invalid email/password"]);
                    }
                }
            }
            $this->session->remove('errors');
        }
        //Create form elements
        $this->formGenerator->addInput('email', 'Email:', 'email', '', ['col-5', 'col-5'], true, ['required', 'email']);
        $this->formGenerator->addInput('password', 'Password:', 'password', '', ['col-5', 'col-5'], true, ['required', 'min_length:10', 'uppercase']);
        $this->formGenerator->addButton('submit', 'submit', 'Log In', ["col-12 center"], true);


        // Assign template variables
        $this->templateEngine->assign('title', 'Login');
        $header = $this->templateEngine->createDiv('<img src="research.png" alt="Research Logo" width="50" height="50">', 'col-2');
        $this->templateEngine->assign('header', $header);
        $this->templateEngine->assign('content', $this->formGenerator->generateForm('login.php', 'POST'));



        // Render the page
        $this->templateEngine->render(TPL_DIR . '/' . 'Template.php');
    }

   

    public function auth()
    {
        // stop login page from timeout

        $this->session->set("last_activity", time());

        // Display message if session has timed out
        if (isset($_GET['timeout'])) {
            $timeoutDIV = $this->templateEngine->createDiv("<span>Your session has timed out. Please Log back in.</span>", "error");
            $this->templateEngine->assign('error', $timeoutDIV);
            return;
        }
        // Check if user is not logged, redirect if true
        if (
            $this->authentication->isLoggedIn() &&
            strtolower(basename($_SERVER['PHP_SELF'])) == "login.php"
        ) {
            // If logged in and on the login page, redirect to the dashboard
            header('Location: Dashboard.php');
            return;
        }
    }
}
