<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;

class HomeController extends AppController {
    
    public function beforeFilter(\Cake\Event\Event $event)
    {
        //$this->Auth->allow(["index","altaEmpresa","tramites","archivos","boleta"]);
        if ($this->request->getSession()->check('UserFront')) {
            $this->Auth->allow();
        } else {
            $this->Auth->allow(["index","altaEmpresa"]);
			//$this->redirect(["controller"=>"Home","action"=>"index"]);
        }
        $this->viewBuilder()->setLayout("home");
    }

    public function index()
    {
        
		if (!$this->request->getSession()->check('UserFront')) {
		    if ($this->request->is(array('post', 'put'))) {
                $this->loadModel("Empresas");
                $password = $this->getRequest()->getData('password');
                //$contraseniaActualEncrypt = hash('sha256', $seed . $contraseniaActual);
                $hasher = new DefaultPasswordHasher();
                
                $empresa = $this->Empresas->find()->where(['cuit'=>@$this->getRequest()->getData('cuit')])->first();
                if (!empty($empresa)) {
                    if ($hasher->check($password, $empresa['password'])) {
                        $this->request->getSession()->write('UserFront',$empresa);
                        return $this->redirect(["controller"=>"Home","action"=>"index"]);
                    }else{
                        $this->request->getSession()->delete('UserFront');
                        return $this->Flash->error('Cuit o contraseña invalida.');
                    } 
                }
                $this->Flash->error('usuario o contraseña incorrecta.');
            }
        }
        
        //$this->Flash->error('No pudo generar token antes de enviar confirmacion de contraseña');
        /*$email = new Email();
        $email->setTo('alexan_kid@hotmail.com')
        ->setSubject('prueba')
        ->setEmailFormat('html')
        ->send('probando...');
        debug($email);*/
        
    }
    
    public function logout()
    {
        $this->request->getSession()->delete('UserFront');
        return $this->redirect(["controller"=>"Home","action"=>"index"]);
    }
    
    public function altaEmpresa()
    {
        $this->loadModel("Empresas");
        $empresa = $this->Empresas->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //$data['fecha'] = date('Y-m-d');
            $data['password'] = $this->random_passw(8);
            $empresa = $this->Empresas->patchEntity($empresa, $data);
			//var_dump($empresa); die;
            $datos                 = array();
            $datos['subject']      = 'Alta de empresa desde web UECARA';
            $datos['url']          = 'https://uecaradelinterior.org.ar';
            $datos['aplicacion']   = 'UECARA DEL INTERIOR';
            $datos['cuit']         = $data['cuit'];
            $datos['denom_social'] = $data['denom_social'];
            $datos['password']     = $data['password'];
            $datos['template']     = 'alta_empresa';
            $datos['email']        = $this->request->getData('email');
                      
            $this->Empresas->getConnection()->begin();
            if ($this->Empresas->save($empresa)) {
                if ($this->_sendEmail($datos)) {
                    $this->Empresas->getConnection()->commit();
                    $this->Flash->success(__('Ha sido guardado correctamente.'));
                    return $this->redirect(['controller'=>'Home','action' => 'index']);
                } else {
                    $this->Empresas->getConnection()->rollback();
                    $this->Flash->error($this->Email->smtpError);
                }
            } else {
                $this->Empresas->getConnection()->rollback();
                $this->Flash->error(__('No pudo guardar correctamente. Por favor intente otra vez.'));
            }
        }
        $this->set(compact('empresa'));
    }
    

    public function tramites($empresa_id = null)
    {
        if (!empty($empresa_id)) {
            $this->loadModel('Tramites');
            $query = $this->Tramites->find()->where(['empresa_id'=>$empresa_id])->contain(['empresas'=>['archivos']]);
            //debug($tramites->toArray());
            $tramites = $this->paginate($query,array('limit'=>10));
            $this->set(compact('tramites'));
        }
    }
    
    public function archivos($empresa_id = null)
    {
        if (!empty($empresa_id)) {
            if ($this->request->is('post')) {
                //debug($this->request->getData()); die;
                //$data = $this->request->getData();
                $data = array();
                $error=0;
                if (!empty($this->request->getData('files'))) {
                    $n=0;
                    foreach ($this->request->getData('files') as $file) {
                        $tmp = $file['tmp_name'];
                        $allowed = array('txt', 'doc', 'docx', 'jpg', 'jpeg', 'xls');
                        $filename = $file['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        if (!in_array($ext, $allowed)) {
                            $error = 1;
                            exit;
                        } 
                        if ($file['size'] >= 50000) {
                            $error = 1;
                            exit;
                        }
                        $ruta = UPLOADS.$filename;
                        if (move_uploaded_file($tmp,$ruta)) {
                            $data[$n]['nombre'] = $filename;
                            $data[$n]['ruta'] = $ruta;
                            $data[$n]['empresa_id'] = $empresa_id;
                            $n++;
                        } else {
                            $error = 1;
                            exit;
                        }
                    }
                }
                //debug($data);
                if ($error) {
                    $this->Flash->error(__('No pudo subir archivo. por favor intente otra vez'));
                } else {
                    $this->loadModel('Archivos');
                    $errordb = 1;
                    $this->Archivos->getConnection()->begin();
                    if (!empty($data)) {
                        foreach ($data as $archivo) {
                            $archivos = $this->Archivos->newEntity($archivo);
                            //$archivos = $this->Archivos->patchEntity($archivos, $data);
                            //debug($archivos); die;
                            if ($this->Archivos->save($archivos)) {
                                $errordb = 0;
                            } else {
                                //debug($archivos->getErrors());
                                $errordb = 1;
                                exit;
                            }
                        }
                    }
                    if ($errordb) {
                        $this->Archivos->getConnection()->rollback();
                        $this->Flash->error(__('No pudo completar. por favor intente otra vez'));
                    } else {
                        $this->Archivos->getConnection()->commit();
                        $this->Flash->success(__('Ha subido correctamente.'));
                        return $this->redirect(['controller'=>'Home','action' => 'index']);
                    }
                }
            }
        } else {
            $this->Flash->error(__('No encuetras la id de empresa antes de subir archivos'));
        }
        $this->set(compact('empresa_id'));
    }
    
    public function boleta()
    {
        
    }
}
