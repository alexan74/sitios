<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    var $web;
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');


        $this->loadComponent('Auth', [
            'authorize'=> 'Controller',//adicionado essa linha
            //'authError'    => '¡No está autorizado para acceder a este contenido!',
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Access',
                'action' => 'login'
            ],
            /*'logoutRedirect' => [
                'controller' => 'Access',
                'action' => 'login'
            ],*/
            'unauthorizedRedirect' => $this->referer()
        ]);

        $this->Auth->allow(['display']);
        $this->web = Configure::read('App.fullBaseUrl').DIRHOST;
        //$this->web = Configure::read('App.fullBaseUrl')."/sistema_uecara";
        
    }

    public function beforeFilter(Event $event) {
        //$this->getEventManager()->off($this->Csrf);
        if($this->Auth->user()){
            $this->set("user", $this->Auth->user());
        }else{
			if ($this->request->getParam('controller') != "Home") {
				return $this->redirect($this->web."/login");
			}
        }
        $session = $this->request->getSession();
        $inicio = $this->getRequest()->getQuery('inicio');
        if (isset($inicio) && $inicio == 1) {
            $session->delete("#".strtolower($this->request->getParam('controller')));
            $this->redirect(array('action'=>'index'));
        }  
    }

    public function isAuthorized($user)
    {
        return false;
    }
    
    public function generateToken($length = 24)
    {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $token = base64_encode(openssl_random_pseudo_bytes($length, $strong));
            if ($strong == TRUE) {
                return strtr(substr($token, 0, $length), '+/=', '-_,');
            }
            
        }
        
        //php < 5.3 or no openssl
        $characters = '0123456789';
        $characters .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz+';
        $charactersLength = strlen($characters) - 1;
        $token            = '';
        
        //select some random characters
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[mt_rand(0, $charactersLength)];
        }
        
        return $token;
    }
    
    public function _sendEmail($datos)
    {
        $email = new Email();
        $email->setTo($datos['email'])
        ->setSubject($datos['subject'])
        ->setTemplate($datos['template'])
        ->setViewVars(['url' => @$datos['url'],
            'aplicacion' => @$datos['aplicacion'],
            'cuit'=> @$datos['cuit'],
            'denom_social'=>@$datos['denom_social'],
            'password'=>@$datos['password'],
            'empresa'=>@$datos['empresa'],
            'tramite'=>@$datos['tramite'],
            'fecha'=>@$datos['fecha'],
            'afiliado'=>@$datos['afiliado'],
        ])
        ->setEmailFormat('html')
        ->send();
        
        if (!$email) {
            return FALSE;
        } else {
            return TRUE;
        }
        
    }
    
    public function random_passw($length)
    {
        $string = "";
        $chars = "abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $string .= $chars[rand(0, $size - 1)];
        }
        return $string;
    }
}
