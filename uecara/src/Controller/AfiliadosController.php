<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Afiliados Controller
 *
 * @property \App\Model\Table\AfiliadosTable $Afiliados
 *
 * @method \App\Model\Entity\Afiliado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AfiliadosController extends AppController
{
    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        
        if (in_array($action, ['index','edit',"view",'add','delete','getTipo'])) {
            /*if(\intval($user["perfil_id"]) === 1){
             return true;
             }*/
            if(\intval($user["perfil_id"]) === 3 && in_array($action, ['index',"add","edit","delete"])){
                return false;
            }
            return true;
        }
    }
    
    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);
        
        if ($this->getRequest()->is('ajax')) {
            $this->viewBuilder()->setLayout(null);
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
        $empresas = $this->Afiliados->Empresas->find('list', ['fields'=>['id','denom_social'],'order' => 'denom_social']);
        $tipos = $this->Afiliados->TiposEmpresa->find('list', ['idField' => 'id', 'valueField' => 'tipo', 'order' => 'tipo']);
        if (!empty($this->getRequest()->getData()) || $this->getRequest()->getSession()->check("#".strtolower($this->getRequest()->getParam('controller'))))
        {
            $misesion = $this->getRequest()->getSession()->read("#".strtolower($this->getRequest()->getParam('controller')));
            if (empty($this->getRequest()->getData()) && isset($misesion)) {
                $data = $misesion;
            } else {
                $data = $this->getRequest()->getData();
                $this->getRequest()->getSession()->write("#".strtolower($this->getRequest()->getParam('controller')),$data);
            }
            if (!empty($data['nro_afiliado'])) {
                $conditions[] = array('nro_afiliado'=>$data['nro_afiliado']);
            }
            if (!empty($data['nomyape'])) {
                $conditions[] = array('nomyape like'=>$data['nomyape'].'%');
            }
            if (!empty($data['empresa_id'])) {
                $conditions[] = array('empresa_id'=>$data['empresa_id']);
            }
            if (!empty($data['tipo_empresa_id'])) {
                $conditions[] = array('Afiliados.tipo_empresa_id'=>$data['tipo_empresa_id']);
            }
            if (!empty($data['tipo_contratacion'])) {
                $conditions[] = array('tipo_contratacion'=>$data['tipo_contratacion']);
            }
            if (!empty($data['retiro_carnet'])) {
                $conditions[] = array('retiro_carnet'=>$data['retiro_carnet']);
            }
            if (isset($data['baja']) && $data['baja'] != '') {
                $conditions[] = array('baja'=>$data['baja']);
            }
            $this->set('baja',@$data['baja']);
        } else {
            $conditions[] = array('baja'=>0);
            $this->set('baja',0);
        }
        //debug($data['baja']);
        //debug($conditions);
        $query = $this->Afiliados->find('all')->where($conditions);       
        
        $this->paginate = [
            'contain' => ['Empresas', 'TiposEmpresa', 'CategoriasEmpresa']
        ];
        $afiliados = $this->paginate($query);

        $this->set(compact('afiliados','tipos','empresas'));
        $this->set('nro_afiliado',@$data['nro_afiliado']);
        $this->set('nomyape',@$data['nomyape']);
        $this->set('empresa_id',@$data['empresa_id']);
        $this->set('tipo_empresa_id',@$data['tipo_empresa_id']);
        $this->set('tipo_contratacion',@$data['tipo_contratacion']);
        $this->set('retiro_carnet',@$data['retiro_carnet']);
        //$this->set('baja',@$data['baja']);
        
    }

    /**
     * View method
     *
     * @param string|null $id Afiliado id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $afiliado = $this->Afiliados->get($id, [
            'contain' => ['Empresas', 'TiposEmpresa', 'CategoriasEmpresa','Tramites'=>['Archivos']]
        ]);
        //debug($afiliado);
        $this->set('afiliado', $afiliado);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $afiliado = $this->Afiliados->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            /*$data['fecha_nac'] = date('Y-m-d',strtotime(str_replace('/','-',$data['fecha_nac'])));
            $data['fecha_ingreso_afiliado'] = date('Y-m-d',strtotime(str_replace('/','-',$data['fecha_ingreso_afiliado'])));
            $data['fecha_baja_sindicato'] = date('Y-m-d',strtotime(str_replace('/','-',$data['fecha_baja_sindicato'])));
            $data['fecha_ingreso_empresa'] = date('Y-m-d',strtotime(str_replace('/','-',$data['fecha_ingreso_empresa'])));*/
            $afiliado = $this->Afiliados->patchEntity($afiliado, $data);
            //debug($afiliado); die;
            if ($this->Afiliados->save($afiliado)) {
                $this->Flash->success(__('Ha sido grabado correctamente.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No pudo grabar afiliado. Por favor intente otra vez.'));
        }
        $empresas = $this->Afiliados->Empresas->find('list', ['fields'=>['id','denom_social'],'order' => 'denom_social']);
        $tipos = $this->Afiliados->TiposEmpresa->find('list', ['idField' => 'id', 'valueField' => 'tipo', 'order' => 'tipo']);
        $categorias = $this->Afiliados->CategoriasEmpresa->find('list', ['idField' => 'id', 'valueField' => 'nombre', 'order' => 'nombre']);
        $this->set(compact('afiliado', 'empresas', 'tipos', 'categorias'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Afiliado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $afiliado = $this->Afiliados->get($id, [
            'contain' => []
        ]);
        //debug($afiliado);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $afiliado = $this->Afiliados->patchEntity($afiliado, $this->request->getData());
            if ($this->Afiliados->save($afiliado)) {
                $this->Flash->success(__('Ha sido grabado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No pudo grabar tramites. Por favor intente otra vez.'));
        }
        $empresas = $this->Afiliados->Empresas->find('list', ['fields'=>['id','denom_social'],'order' => 'denom_social']);
        $tipos = $this->Afiliados->TiposEmpresa->find('list', ['idField' => 'id', 'valueField' => 'tipo', 'order' => 'tipo']);
        $categorias = $this->Afiliados->CategoriasEmpresa->find('list', ['idField' => 'id', 'valueField' => 'nombre', 'order' => 'nombre']);
        $this->set(compact('afiliado', 'empresas', 'tipos', 'categorias'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Afiliado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        if (!empty($id)) {
            $afiliado = $this->Afiliados->get($id, ['contain' => ['Empresas']]);
            $this->set('afiliado_id',$id);
            $this->set('empresa_id',$afiliado->empresa_id);
            if ($this->request->is(['patch', 'post', 'put'])) {
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
                                $data['archivos'][$n]['nombre'] = $filename;
                                $data['archivos'][$n]['ruta'] = $ruta;
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
                    $this->loadModel('Tramites');
                    $data['tipo_tramite']="Baja de Afiliado";
                    $tramite = $this->Tramites->newEntity();
                    $tramite = $this->Tramites->patchEntity($tramite, $data, ['associated' => ['Archivos']]);
                    $this->Tramites->getConnection()->begin();
                    if ($this->Tramites->save($tramite)) {                 
                        $data=array();
                        $data['tramite_id'] = $tramite->id;
                        $data['baja']=1;
                        $afiliado = $this->Afiliados->patchEntity($afiliado, $data);           
                        if ($this->Afiliados->save($afiliado)) {
                            $datos                 = array();
                            $datos['subject']      = 'Baja de Afiliado';
                            $datos['url']          = 'https://uecaradelinterior.org.ar';
                            $datos['aplicacion']   = 'UECARA DEL INTERIOR';
                            $datos['afiliado']     = $afiliado->nomyape;
                            $datos['empresa']      = $afiliado->empresa->denom_social;
                            $datos['tramite']      = $tramite->toArray();
                            $datos['template']     = 'baja_afiliado';
                            $datos['email']        = $afiliado->empresa->email;
                            if ($this->_sendEmail($datos)) { 
                                $this->Tramites->getConnection()->commit();
                                $this->Flash->success('Ha sido de baja correctamente');
                            } else {
                                $this->Tramites->getConnection()->rollback();
                                $this->Flash->error(__('No pudo dar de baja. Por favor intente otra vez.'));
                            }
                            return $this->redirect(['controller'=>'afiliados','action' => 'index']);
                        } else {
                            $this->Tramites->getConnection()->rollback();
                            $this->Flash->error(__('No pudo dar de baja. Por favor intente otra vez.'));
                        }
                    } else {
                        $this->Tramites->getConnection()->rollback();
                        $this->Flash->error(__('No pudo dar de baja. Por favor intente otra vez.'));
                    }
                }
            }
        }

    }
    public function getTipo()
    {
        $result=false;
        $this->viewBuilder()->setLayout(null);
        $id = $this->request->getData('empresa_id');
        if (!empty($id)) {
            $this->loadModel('Empresas');
            $empresa = $this->Empresas->get($id,['contain' => ['TiposEmpresa']]);
            
            /*$this->loadModel('TiposEmpresa');
            $tipo = $this->TiposEmpresa->find()->where(['empresa_id'=>$id])->first();*/
            if (!empty($empresa)) {
                $result['tipo_id'] = $empresa->tipo_empresa_id;
                $result['tipo'] = $empresa->tipos_empresa->tipo;
            }
        }
        $data = array('result' => $result);
        $this->set('data', $data);
        
        $this->render('/Element/ajaxreturn');
        
    }
}
