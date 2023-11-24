<?php

namespace Controller;

class DashboardResponse extends AbstractResponse
{
    public function execute($token = "")
    {
        // If token is used access page without session
        if (!empty($token)) {
            $content = $this->templateEngine->createDiv('<span id="role">Research Group Manager: Admin</span>', 'col-6 col-m-12');
            $content .= $this->templateEngine->createDiv('<span id="email">Email: valid_email@example.com </span>', 'col-6 col-m-12');
            $role_id = 1;
        } else {
            // Access page with session
            $this->session = new Session();
            $this->authentication = new Authentication();
            //Run authorization
            $this->auth();
            $content = $this->templateEngine->createDiv('<span id="role">' . $this->session->get('role_name') . ': ' . $this->session->get('user') . '</span>', 'col-6 col-m-12');
            $content .= $this->templateEngine->createDiv('<span id="email">Email: ' . $this->session->get('email') . '</span>', 'col-6 col-m-12');
            $role_id = $this->session->get('role_id');
        }

        // Create header for page
        $header = $this->templateEngine->createDiv('<img src="research.png" alt="Research Logo" width="50" height="50">', 'col-2 col-m-2');
        $header .= $this->templateEngine->createDiv('<!-- Empty cell --!>', 'col-7 col-m-5');
        $header .= $this->templateEngine->createDiv('<a href="?logout=true" class="logout">Log Out</a>', 'col-3 col-m-5');

        // Create user div

        $userRow = $this->templateEngine->createDiv($content, 'user row');
        $userDIV = $this->templateEngine->createDiv($userRow, 'user-container');

        // Assign template variables
        $this->templateEngine->assign('header', $header);
        $this->templateEngine->assign('title', 'Dashboard');
        $this->templateEngine->assign('user', $userDIV);


        $content = "";

        //Create views for each role
        if ($role_id) {
            $flexItem = $this->templateEngine->createDiv('<a href="#">Create New Study</a>', 'flex-item');
            $flexItem .= $this->templateEngine->createDiv('<a href="#">View All Studies</a>', 'flex-item');
            $flex = $this->templateEngine->createDiv($flexItem, 'flex-container');
            $content = $flex;
        } else {
            $flexItem = $this->templateEngine->createDiv('<a href="#">View All Studies</a>', 'flex-item');
            $flex = $this->templateEngine->createDiv($flexItem, 'flex-container');
            $content = $flex;
        }
        if ($role_id) {
            $flexItem = $this->templateEngine->createDiv('<a href="#">Delete Previous Study</a>', 'flex-item');
            if ($role_id) {
                $href = !empty($token)? '"CreateUser.php?user='. $token . '"' : '"CreateUser.php"';
                $flexItem .= $this->templateEngine->createDiv("<a href=$href>Create New Researchers</a>", 'flex-item');
            }
            $flex = $this->templateEngine->createDiv($flexItem, 'flex-container');
            $content .= $flex;
        }

        // Assign view to template and render
        $this->templateEngine->assign('content', $content);
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
    }
}
