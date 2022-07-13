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
            $action = $this->request->getParam('action');
            if (in_array($action, ['tramites','archivos'])) {
                $this->redirect(["controller"=>"Home","action"=>"index"]);
            }
            $this->Auth->allow(["index","altaEmpresa"]);
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
        
        /*
        $email = new Email();
        $email->setTo('alexan_kid@hotmail.com')
        ->setSubject('prueba')
        ->setEmailFormat('html')
        ->send('probando...');
        debug($email);
        */
        
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
            $query = $this->Tramites->find()->where(['empresa_id'=>$empresa_id])->contain(['empresas','archivos']);
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
                        $allowed = array('txt', 'doc', 'docx', 'jpg', 'jpeg', 'xls', 'pdf');
                        $filename = $file['name'];
                        $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        if (!in_array($ext, $allowed)) {
                            $error = 1;
                            break;
                        } 
                        if ($file['size'] >= 50000000) {
                            $error = 1;
                            break;
                        }
                        $ruta = UPLOADS.$filename;
                        if (move_uploaded_file($tmp,$ruta)) {
                            $data['archivos'][$n]['nombre'] = $filename;
                            $data['archivos'][$n]['ruta'] = $ruta;
                            $data['archivos'][$n]['empresa_id'] = $empresa_id;
                            $n++;
                        } else {
                            $error = 1;
                            break;
                        }
                    }
                }
                //debug($data);
                if ($error) {
                    $this->Flash->error(__('No pudo subir archivo. por favor intente otra vez'));
                } else {
                    $errordb = 1;
                    $this->loadModel('Tramites');
                    $this->Tramites->getConnection()->begin();
                    if (!empty($data)) {
                        $tramite = $this->Tramites->newEntity();
                        $data['tipo_tramite'] = 'Subida de Archivos';
                        $data['observaciones'] = $this->request->getData('observaciones'); 
                        $data['empresa_id'] = $empresa_id; 
                        //$empresa = $this->Empresas->get($empresa_id, ['contain' => ['Archivos','Tramites']]);
                        $tramite = $this->Tramites->patchEntity($tramite, $data, ['associated' => ['Archivos']]);
                        if ($this->Tramites->save($tramite)) {
                            $this->loadModel('Empresas');
                            $empresa = $this->Empresas->get($empresa_id, ['contain' => ['Tramites'=>['Archivos']]]);
                            $datos                 = array();
                            $datos['subject']      = 'Envío de información de la empresa '.$empresa['denom_social'];
                            $datos['empresa']      = $empresa->toArray();
                            $datos['tramite']      = $tramite->toArray();
                            $datos['fecha']        = date('d/m/Y');
                            $datos['template']     = 'subida_archivos';
                            $datos['email']        = array('alejandrogajate@yahoo.com','aix_lec@hotmail.com','administracion@uecaradelinterior.org.ar','recepcion@uecaradelinterior.org.ar');
                            //$datos['email']        = array('alejandrogajate@yahoo.com');
                            /*debug($datos);
                             debug($empresa); die;*/
                            if ($this->_sendEmail($datos)) {
                                $errordb = 0;
                            } else {
                                $errordb = 1;
                                exit;
                            }
                        } else {
                            $errordb = 1;
                            exit;
                        }
                    }
                    /*$this->loadModel('Archivos');
                    $this->Archivos->getConnection()->begin();
                    if (!empty($data)) {
                        foreach ($data as $archivo) {
                            $archivos = $this->Archivos->newEntity($archivo);
                            if ($this->Archivos->save($archivos)) {
                                $errordb = 0;
                            } else {
                                //debug($archivos->getErrors());
                                $errordb = 1;
                                exit;
                            }
                        }
                    }*/
                    if ($errordb) {
                        $this->Tramites->getConnection()->rollback();
                        $this->Flash->error(__('No pudo completar. por favor intente otra vez'));
                    } else {
                        $this->Tramites->getConnection()->commit();
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
