<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Empresas Controller
 *
 * @property \App\Model\Table\EmpresasTable $Empresas
 *
 * @method \App\Model\Entity\Empresa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EmpresasController extends AppController
{
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        
        if (in_array($action, ['index','edit',"view",'add','delete','borrarArchivo','download'])) {
            /*if(\intval($user["perfil_id"]) === 1){
             return true;
             }*/
            if(\intval($user["perfil_id"]) === 3 && in_array($action, ['index',"add","edit","delete"])){
                return false;
            }
            return true;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $conditions = array();
        $limite = 10;
        //debug($this->getRequest()->getSession()->read("#".strtolower($this->getRequest()->getParam('controller'))));
        if (!empty($this->getRequest()->getData()) || $this->getRequest()->getSession()->check("#".strtolower($this->getRequest()->getParam('controller'))))
        {
            $misesion = $this->getRequest()->getSession()->read("#".strtolower($this->getRequest()->getParam('controller')));
            if (empty($this->getRequest()->getData()) && isset($misesion)) {
                $data = $misesion;
            } else {
                $data = $this->getRequest()->getData();
                $this->getRequest()->getSession()->write("#".strtolower($this->getRequest()->getParam('controller')),$data);
            }
            if (!empty($data['denom_social'])) {
                $conditions[] = array('denom_social like'=>$data['denom_social'].'%');
            }
        }
        $query = $this->Empresas->find('all')->where($conditions);
        
        $this->paginate = array('contain' => array('tramites'=>array('archivos'),'tiposempresa'), 'limit' => $limite);
        
        $empresas = $this->paginate($query);
        $this->set(compact('empresas'));
        $this->set('denom_social',@$data['denom_social']);
    }

    /**
     * View method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $empresa = $this->Empresas->get($id, [
            'contain' => ['Nominas','TiposEmpresa','Tramites'=>['Archivos']]
        ]);
        

        $this->set(compact('empresa'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('CategoriasEmpresa');
        $categorias = $this->CategoriasEmpresa->find()->where(['activo'=>1])->order(['nombre'])->toArray();
        $this->loadModel('TiposEmpresa');
        $tipos = $this->TiposEmpresa->find()->where(['activo'=>1])->order(['tipo'])->toArray();
        $empresa = $this->Empresas->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $error=0;
            if (!empty($data['files'])) {
                $n=0;
                foreach ($data['files'] as $file) {
                    if ($file['tmp_name']!='') {
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
                            $data_tram['archivos'][$n]['nombre'] = $filename;
                            $data_tram['archivos'][$n]['ruta'] = $ruta;
                            $n++;
                        } else {
                            $error = 1;
                            break;
                        }
                    }
                }      
            }
            if ($error) {
                $this->Flash->error(__('No pudo subir archivo. por favor intente otra vez'));
            } else {
                //$data['fecha'] = date('Y-m-d');
                $data['password'] = $this->random_passw(8);
                $empresa = $this->Empresas->patchEntity($empresa, $data);
                //debug($empresa); die;
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
                    $this->loadModel('Tramites');
                    $tramite = $this->Tramites->newEntity();
                    $data_tram['tipo_tramite'] = "Alta de empresa";
                    $data_tram['observaciones'] = $data['observaciones'];
                    $data_tram['empresa_id']=$empresa->id;
                    $tramite = $this->Tramites->patchEntity($tramite, $data_tram, ['associated' => ['Archivos']]);
                    if ($this->Tramites->save($tramite)) {
                        if ($this->_sendEmail($datos)) { 
                            $this->Empresas->getConnection()->commit();
                            //$this->Flash->success(__('Ha sido guardado correctamente.'));
                            $this->Flash->success('Se ha notificado a la empresa “'.$data['denom_social'].'” al ALTA correspondiente');
                            return $this->redirect(['controller'=>'Empresas','action' => 'index']);
                        } else {
                            $this->Empresas->getConnection()->rollback();
                            $this->Flash->error($this->Email->smtpError);
                        }
                    } else {
                        $this->Empresas->getConnection()->rollback();
                        $this->Flash->error(__('No pudo grabar tramites. Por favor intente otra vez.'));
                    }
                } else {
                    $this->Empresas->getConnection()->rollback();
                    $this->Flash->error(__('No pudo guardar correctamente. Por favor intente otra vez.'));
                }
            }
        }
        $this->set(compact('empresa','categorias','tipos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('CategoriasEmpresa');
        $categorias = $this->CategoriasEmpresa->find()->where(['activo'=>1])->order(['nombre'])->toArray();
        $this->loadModel('TiposEmpresa');
        $tipos = $this->TiposEmpresa->find()->where(['activo'=>1])->order(['tipo'])->toArray();
        $empresa = $this->Empresas->get($id, [
            'contain' => ['Nominas','Tramites'=>['Archivos']]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $error=0;
            $data = $this->request->getData();
            //debug($data); die;
            if (!empty($data['files'])) {
                $n=0;
                foreach ($data['files'] as $file) {
                    if ($file['tmp_name']!='') {
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
                            $data_tram['archivos'][$n]['nombre'] = $filename;
                            $data_tram['archivos'][$n]['ruta'] = $ruta;
                            $n++;
                        } else {
                            $error = 1;
                            break;
                        }
                    }
                }
            }
            if ($error) {
                $this->Flash->error(__('No pudo subir archivo. por favor intente otra vez'));
            } else {
                $empresa = $this->Empresas->patchEntity($empresa, $data, ['associated' => ['Nominas']]);
                //debug($empresa); die;
                $this->Empresas->getConnection()->begin();
                if ($this->Empresas->save($empresa)) {
                    if (!empty($data_tram['archivos'])) {
                        $this->loadModel('Tramites');
                        $tramite = $this->Tramites->newEntity();
                        $data_tram['tipo_tramite'] = "Modificacion de empresa";
                        $data_tram['observaciones'] = $data['observaciones'];
                        $data_tram['empresa_id']=$empresa->id;
                        $tramite = $this->Tramites->patchEntity($tramite, $data_tram, ['associated' => ['Archivos']]);
                        if ($this->Tramites->save($tramite)) {
                            $this->Empresas->getConnection()->commit();
                            $this->Flash->success(__('Ha sido grabado correctamente.'));   
                            return $this->redirect(['controller'=>'Empresas','action' => 'index']);
                        } else {
                            $this->Empresas->getConnection()->rollback();
                            $this->Flash->error(__('No pudo guardar archivos, Por favor intente otra vez'));
                        }
                    } else {
                        $this->Empresas->getConnection()->commit();
                        $this->Flash->success(__('Ha sido grabado correctamente.'));
                        return $this->redirect(['controller'=>'Empresas','action' => 'index']);
                    }
                } else {
                    $this->Empresas->getConnection()->rollback();
                    $this->Flash->error(__('No pudo guardar, Por favor intente otra vez'));
                }
            }
        }
        $this->set(compact('empresa','categorias','tipos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Empresa id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $empresa = $this->Empresas->get($id,['contain' => ['Nominas','Tramites'=>['Archivos']]]);
        if ($this->Empresas->delete($empresa)) {
            $this->Flash->success(__('Ha sido borrado correctamente.'));
        } else {
            $this->Flash->error(__('No pudo borrar. Por favor intente otra vez'));
        }

        return $this->redirect(['controller'=>'Empresas','action' => 'index']);
    }
    
    public function borrarArchivo()
    {
        $result=false;
        $this->viewBuilder()->setLayout(null);
        $id = $this->request->getData('archivo_id');
        if (!empty($id)) {
            $this->loadModel('Archivos');
            $archivo = $this->Archivos->get($id,[]);
            if (unlink($archivo['ruta'])) {
                if ($this->Archivos->delete($archivo)) {
                    $result = true;
                } 
            } 
        }
        $data = array('result' => $result);
        $this->set('data', $data);
        
        $this->render('/Element/ajaxreturn');

    }
    
    public function download($id = null) {
        $this->viewBuilder()->setLayout(false);
        if (!empty($id)) {
            $this->loadModel('Archivos');
            $archivo = $this->Archivos->get($id,[]);
            if (!empty($archivo)) {
                $this->response->file(
                    $archivo['ruta'],
                    array('download' => true, 'name' => $archivo['nombre'])
                );
            }
        }
        return $this->response;
    }
    
}
