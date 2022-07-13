<?php
namespace App\Controller;

use App\Controller\AppController;

class ViaticosController extends AppController
{
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function index()
    {   
        $this->loadModel('Users');
        $users = $this->Users->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('Tareas');
        $tareas = $this->Tareas->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('Users');
        $empleados = $this->Users->find()->where(['habilitado'=>1,'tipo_usuario'=>2])->order(['apellido'=>'ASC','nombre'=>'ASC']);
        $usuario = $this->request->getSession()->read('Auth.User');
        $conditions = array();
        if ($this->request->is('post') || $this->request->getSession()->check('data'))
        {   //debug($this->request->session()->read("data"));die;
            $misesion = $this->request->session()->read("data");
            if (empty($this->request->data) && isset($misesion)) $this->request->data = $misesion;
            $this->request->session()->write("data",$this->request->data);
            //debug($this->request->data);
            /*$user = $this->Users->find()->where(['OR' => ['razonsocial like'=>'%'.$this->request->data['razonsocial'].'%','direccion like'=>'%'.$this->request->data['direccion'].'%']])->toArray();*/ 
            /*$planillas = $this->paginate($this->Planillas->find()->where(['cliente_id'=> $user['0']['id'] ]));*/
            
            /*if (!empty($this->request->data['cliente'])) {
                $conditions[] = array('Clientes.razonsocial like'=>$this->request->data['razonsocial'].'%');
            }
            if (!empty($this->request->data['empleado'])) {
                $conditions[] = array('Users.razonsocial like'=>$this->request->data['empleado'].'%');
            }*/
            if (!empty($this->request->data['desde']) || !empty($this->request->data['desde'])) {
                if (!empty($this->request->data['desde'])) {
                    $conditions[] = array('Viaticos.fecha >='=>date('Y-m-d',strtotime(str_replace('/','-',$this->request->data['desde']))));
                }
                if (!empty($this->request->data['hasta'])) {
                    $conditions[] = array('Viaticos.fecha <='=>date('Y-m-d',strtotime(str_replace('/','-',$this->request->data['hasta']))));
                }
            }
            if (!empty($this->request->data['empleado_id'])) {
                $conditions[] = array('Users.id'=>$this->request->data['empleado_id']);
            }
            if (isset($this->request->data['carga']) && ($this->request->data['carga']!="")) {
                $conditions[] = array('carga'=>$this->request->data['carga']);
                $carga = $this->request->data['carga'];
            }else {
                $carga = -1;
            }
            if (isset($this->request->data['pagado']) && ($this->request->data['pagado'])!="") {
                $conditions[] = array('Viaticos.pagado'=>$this->request->data['pagado']);
                $pagado = $this->request->data['pagado'];
            } else {
                $pagado = -1;
            }
        } else {
            if ($usuario['tipo_usuario']==1) $pagado = 0; else $pagado = -1;
            $carga=-1;
            $conditions[] = array('Viaticos.fecha >='=>date('Y-m-d'));
            if ($usuario['tipo_usuario']==1) $conditions[] = array('Viaticos.pagado'=>0); 
           
        }
        if ($usuario['tipo_usuario']==2) $conditions[] = array('Viaticos.empleado_id'=>$usuario['id']);
        //debug($conditions);
        $viaticos = $this->Viaticos->find()->where($conditions)->contain(['Users','Tareas']);
        //debug($tareas->toArray());
        $this->set('desde', @$this->request->data['desde']);
        $this->set('hasta', @$this->request->data['hasta']);
        //$this->set('empleado', @$this->request->data['empleado']);
        $this->set('empleado_id', @$this->request->data['empleado_id']);
        //$this->set('carga', @$this->request->data['carga']);
        //$this->set('pagado', @$this->request->data['pagado']);
        $this->set(compact('tareas','users','viaticos','pagado','carga','empleados'));
        //debug($tareas->toArray());
        
    }
    
    public function limpiar(){
        $this->request->session()->delete('data');
        return $this->redirect(['action' => 'index']);
    }

    /**
     * View method
     *
     * @param string|null $id Certificado id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {   
        $viatico = $this->Viaticos->get($id, [
            'contain' => ['Users','Tareas'],
        ]);
        $this->set(compact('viatico'));
       
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($tarea_id = null)
    {   
        if (!empty($tarea_id)) {
            $this->loadModel('Tareas');
            $tarea = $this->Tareas->get($tarea_id, [
                'contain' => ['Users','Clientes'],
            ]);
        } else {
            $tarea = null;
        }
            //if (!empty($tarea)) {
                $this->set(compact('tarea'));
                if ($this->request->is('post')) {
                    $data = @$this->request->data;
                    if(strpos($data['valor'], ',') === true) { $data['valor'] = number_format($data['valor'],2,',','.'); }
                    $data['fecha'] = !empty($data['fecha'])?date('Y-m-d',strtotime(str_replace('/','-',$data['fecha']))):date('Y-m-d');
                    //$data['carga'] = empty($data['carga'])?1:$data['carga'];
                    //$data['carga'] = 1;
                    //$data['fecha'] = date('Y-m-d');
                    $data['pagado'] = empty($data['pagado'])?0:$data['pagado'];
                    $viatico = $this->Viaticos->newEntity($data, ['associated' => ['Users','Tareas']]);
                    //debug($viatico); die;
                    if ($this->Viaticos->save($viatico)) {
                        $this->Flash->success(__('ha sido cargado correctamente.'));
                        if (!empty($tarea_id)) {
                            return $this->redirect(['controller'=>'tareas', 'action' => 'index']);
                        } else {
                            return $this->redirect(['action' => 'index']);
                        }
                    } else {
                        $this->Flash->error(__('No pudo grabar correctamente'));
                    }
                }
            //}
        /*} else {
            $this->Flash->error(__('No encuetra la tarea relacionada antes de completar el viatico'));
            return $this->redirect($this->referer());
        }*/
    }

    /**
     * Edit method
     *
     * @param string|null $id Certificado id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $viatico = $this->Viaticos->get($id, [
            'contain' => ['Users','Tareas'],
        ]);
        if ($this->request->is('post')) {
            $data = @$this->request->data;
            //$data['costo'] = number_format($data['costo'],2,'.',',');
            if(strpos($data['valor'], ',') === true) { $data['valor'] = number_format($data['valor'],2,',','.'); }
            //$data['fecha'] = date('Y-m-d',strtotime(str_replace('/','-',$data['fecha'])));
            //$data['estado_servicio_id'] = 1;
            $data['carga'] = empty($data['carga'])?0:$data['carga'];
            $data['pagado'] = empty($data['pagado'])?0:$data['pagado'];
            $tarea = $this->Viaticos->patchEntity($viatico, $data,['associated' => ['Users','Tareas']]);
            if ($this->Viaticos->save($viatico)) {
                $this->Flash->success(__('Se ha modificado el registro de viatico.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se ha modificado el registro de viatico. Intente más tarde.'));
        }
        $this->set(compact('viatico'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Certificado id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $viatico = $this->Viaticos->get($id);
        try {
            if (!$viatico->pagado || empty($viatico->tarea_id)) {
                if ($this->Viaticos->delete($viatico)) {
                    $this->Flash->success(__('El viatico fue eliminado correctamente.'));
                } else {
                    $this->Flash->error(__('El viatico no fue eliminada.'));
                }
            } else {
                $this->Flash->error(__('No pudo borrar pues esta relacionado con otros datos o ya esta pagado.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('No puede borrar pues está asociado con otros registros.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function setPagado() {
        $this->layout = null;
        $valor = $this->getRequest()->getData('valor');
        $id = $this->getRequest()->getData('id');
        $result = false;
        $viatico = $this->Viaticos->get($id);
        $data['pagado'] = $valor;
        $viatico = $this->Viaticos->patchEntity($viatico, $data);
        //debug($viatico); die;
        if ($this->Viaticos->save($viatico)) {
            $result = true;
        }
        $this->set('data', $result);
        $this->render('/Element/ajaxreturn');
    }
    
    public function aPagar() {
        $this->layout = null;
        $result = false;
        $empleado_id = $this->getRequest()->getData('empleado_id');  
        //$viaticos = TableRegistry::get('Viaticos');
        if (!empty($empleado_id)) $conditions[] = array('empleado_id'=>$empleado_id);
        $conditions[] = array('Viaticos.fecha >='=>date('Y-m-d'));
        $conditions[] = array('pagado'=>0);      
        //debug($conditions); die;
        $query = $this->Viaticos->query();
        if ($query->update()->set(['pagado'=>1])->where($conditions)->execute()) {
            $result = true;
        }
        $this->set('data', $result);
        $this->render('/Element/ajaxreturn');
    }
    
}
