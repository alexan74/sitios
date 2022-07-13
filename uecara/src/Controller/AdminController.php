<?php

namespace App\Controller;

use App\Controller\AppController;

class AdminController extends AppController {
    
    public function isAuthorized($user)
    {

        $action = $this->request->getParam('action');

        // As ações add e index são permitidas sempre.
        if (in_array($action, ['index'])) {
            return true;
        }
    }

    public function index()
    {
        
    }
}