<?php

namespace Controller;

use \Model\UserModel;
use \Model\ORM;
use \Model\Validator;

class CreateUserResponse extends AbstractResponse
{
    public function execute($token = "")
    {
        if (!empty($token)) {
            $content = $this->templateEngine->createDiv('<span id="role">Research Group Manager: Admin</span>', 'col-7 col-m-12');
            $content .= $this->templateEngine->createDiv('<span id="email">Email: valid_email@example.com </span>', 'col-5 col-m-12');
        } else {
            $this->session = new Session();
            $this->authentication = new Authentication();
            //Run authorization
            $this->auth();
            $content = $this->templateEngine->createDiv('<span id="role">' . $this->session->get('role_name') . ': ' . $this->session->get('user') . '</span>', 'col-7 col-m-12');
            $content .= $this->templateEngine->createDiv('<span id="email">Email: ' . $this->session->get('email') . '</span>', 'col-5 col-m-12');
            if ($this->session->has("errors")) {
                $this->session->remove("errors");
            }

            // If form submitted register user
            if (isset($_POST['submit'])) {

                

                $validator = new Validator($_POST, $this->errorHandler);
                $validator->runValidation();

                $errors = $validator->getErrors();
                $this->errorHandler->setErrors($errors);
                $errors = $this->session->get('errors');
                $error = "<ul>";

                //Create DIV to display success Message
                $successDIV = $this->templateEngine->createDiv("<ul><li>User successfully created</li></ul>", "success");

                //If there are errors create error <ul> and assign to template
                if (!empty($errors)) {
                    foreach ($errors as $category => $msg) {
                        $error .= "<li>" . $category . ": " . $msg . "<br></li>";
                    }
                    $error .= "</ul>";
                    $errorDIV = $this->templateEngine->createDiv($error, "error");
                    $this->templateEngine->assign("error", $errorDIV);
                } else { //Insert user into database
                    $orm = new ORM(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                    $user = new UserModel();
                    $user->setUserAsArray($_POST);

                    $data = [
                        'email' => $user->getEmail(),
                        'AccessLevel' => ($user->getRole() == 2) ? 'Research Group Manager' : 'Researcher',
                    ];
                    $orm->create($user->getUserAsArray(), 'users');
                    $orm->create($data, 'user_access_levels');
                    $this->templateEngine->assign("success", $successDIV);
                }
            }
        }



        // Create header for page
        $header = $this->templateEngine->createDiv('<img src="research.png" alt="Research Logo" width="50" height="50">', 'col-2 col-m-2');
        $header .= $this->templateEngine->createDiv('<!-- Empty cell --!>', 'col-7 col-m-5');
        $header .= $this->templateEngine->createDiv('<a href="?logout=true" class="logout">Log Out</a>', 'col-3 col-m-5');


        $userRow = $this->templateEngine->createDiv($content, 'user row');
        $userDIV = $this->templateEngine->createDiv($userRow, 'user-container');

        // Assign template variables
        $this->templateEngine->assign('header', $header);
        $this->templateEngine->assign('title', 'Create User');
        $this->templateEngine->assign('user', $userDIV);


        $content = "";

        //Create form elements
        $this->formGenerator->addInput("username", "Username", 'text', '', ['col-5', 'col-5'], true, ['required']);
        $this->formGenerator->addInput('email', 'Email', 'email', '', ['col-5', 'col-5'], true, ['email', 'required']);
        $this->formGenerator->addInput('password', 'Password', 'password', '', ['col-5', 'col-5'], true, ['required', 'upper_case', 'min_length:10']);
        $this->formGenerator->addSelect('AccessLevel', 'Role', ['2' => 'Research Study Manager', '3' => 'Researcher'], ['col-5', 'col-5'], true);
        $this->formGenerator->addButton('submit', 'submit', "Register", ["col-12 center"], true);


        //Assign form to template and render page
        $this->templateEngine->assign('content', $this->formGenerator->generateForm('CreateUser.php', 'POST'));
        $this->templateEngine->render(TPL_DIR . '/' . 'Template.php');
    }

    public function auth()
    {

        // Check to see if logout is set, redirect if true
        if (isset($_GET['logout'])) {
            $this->authentication->logout();
            header('Location: Login.php');
            return;
        }
        // Check if user is not logged, redirect if true
        if (
            !$this->authentication->isLoggedIn() &&
            strtolower(basename($_SERVER['PHP_SELF'])) != "login.php"
        ) {
            // Redirect to the login page
            header('Location: Login.php');
            return;
        }
        // Check if session has timed out, redirect if true
        if ($this->session->checkTimeout()) {
            $this->authentication->logout();
            header('Location: Login.php?timeout=true');
            return;
        }
        // check to make sure user is Research Group Manager
        if ($this->session->get('role_id') != 1) {
            header('Location: Dashboard.php');
        }
    }
}
