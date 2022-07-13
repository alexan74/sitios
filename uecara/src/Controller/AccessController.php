<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccessController extends AppController {
    
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->loadModel("Users");
        $action = $this->request->getParam('action');
        if (in_array($action, ['login'])) {
            if($this->Auth->user()){
                return $this->redirect($this->web."/admin");
            }
        }
        //$this->Auth->allow(['logout',"login","registrar","recuperar"]);
        $this->Auth->allow();
        $this->viewBuilder()->setLayout("home");
    }

    public function login()
    {    
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                if($user['activo']){
                    $this->Auth->setUser($user);
                    //return $this->redirect($this->web."/admin");
                    if ($this->Auth->redirectUrl()=="/")
                        $redirect = $this->web."/admin";
                    else 
                        $redirect = $this->Auth->redirectUrl();
                    return $this->redirect($redirect);
                    //return $this->redirect($this->web.$this->Auth->redirectUrl());
                }else{
                    return $this->Flash->error('Usuario invalido.');
                }
                
            }
            $this->Flash->error('usuario o contraseña incorrecta.');
        }
    }

    public function logout()
    {
        /*$this->Auth->setUser(null);
        return $this->redirect($this->web."/login");*/
        return $this->redirect($this->Auth->logout());
    }
    
    public function  registrar(){
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $data['perfil_id'] = 2;
            $data['activo'] = true;
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Ha sido grabado correctamente.'));

                return $this->redirect($this->web."/login");
            }
            foreach($user->errors() as $key => $value){
                foreach($value as $k => $text){
                    if($k == "_isUnique"){
                        $this->Flash->error(strtoupper($key) .", ya existe. ");
                    }else{
                        $this->Flash->error(strtoupper($key) ." ". $text);
                    }
                    
                    
                    //var_dump($text);
                }
                //
                //var_dump($value);
                //var_dump($key);
            }
        }
        $this->set(compact('user'));
    }
    
    public function recuperar() {
        if ($this->request->is('post')) {
            $usuario = $this->Users->find()->where(['email' => $this->request->getData('email')])->first();
            //->contain(['RbacPerfiles' => ['RbacAcciones']])
            if (!empty($usuario)) {
                $token  = $this->generateToken();
                $data['token']      = $token;
                $data['user_id'] = $usuario->id;
                $data['validez']    = 1440;
                
                $url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
                $datos               = array();
                $datos['subject']    = 'Confirmación de contraseña para la administración UECARA';
                $datos['url']        = $url . DIRHOST . "recuperarPass/" . $token;
                $datos['aplicacion'] = 'UECARA';
                $datos['template']   = 'recuperar_contrasenia';
                $datos['email']      = $this->request->getData('email');
                
                /*debug($datos);
                 debug($data);
                 die;*/
                $this->loadModel('Token');
                $this->Token->getConnection()->begin();
                $Token = $this->Token->newEntity();
                $Token = $this->Token->patchEntity($Token, $data);
                if ($this->Token->save($Token)) {
                    if ($this->_sendEmail($datos)) {
                        $this->Token->getConnection()->commit();
                        $this->Flash->success(
                            'Se ha enviado la información para recuperar la clave al usuario ingresado a la dirección ' . $this->request->getData('email')
                        );
                        $this->redirect($this->web.'/login');
                        //$this->redirect(array('action'=>'index'));
                    } else {
                        $this->Token->getConnection()->rollback();
                        $this->Flash->error($this->Email->smtpError);
                        // $this->request->getSession()->setFlash($this->Email->smtpError, 'flash_custom');
                    }
                } else {
                    $this->Token->getConnection()->rollback();
                    $this->Flash->error('No pudo generar token antes de enviar confirmacion de contraseña');
                }
 
            } else {
                // ver cesar
                $this->Flash->error('No encuentra correo para enviar la informacón de recuperar contraseña');
                //$this->redirect(array('controller' => 'users', 'action' => 'login'));
                $this->redirect($this->web.'/login');
            }
        }
    }
    
    

}