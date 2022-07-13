<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Tareas Controller
 *
 * @property \App\Model\Table\TareasTable $Tareas
 *
 */

class TareasController extends AppController
{
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function index()
    {   
        $this->loadModel('TiposFactura');
        $tiposFactura = $this->TiposFactura->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('TiposPago');
        $tiposPago = $this->TiposPago->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('Servicios');
        $servicios = $this->Servicios->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('Users');
        $empleados = $this->Users->find()->where(['habilitado'=>1,'tipo_usuario'=>2])->order(['apellido'=>'ASC','nombre'=>'ASC']);
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
                    $conditions[] = array('fecha >='=>date('Y-m-d',strtotime(str_replace('/','-',$this->request->data['desde']))));
                }
                if (!empty($this->request->data['hasta'])) {
                    $conditions[] = array('fecha <='=>date('Y-m-d',strtotime(str_replace('/','-',$this->request->data['hasta']))));
                }
            }
            if (!empty($this->request->data['direccion'])) {
                $conditions[] = array('direccion like'=>'%'.$this->request->data['direccion'].'%');
            }
            if (!empty($this->request->data['cliente_id'])) {
                $conditions[] = array('Clientes.id'=>$this->request->data['cliente_id']);
            }
            if (!empty($this->request->data['empleado_id'])) {
                $conditions[] = array('empleado_id'=>$this->request->data['empleado_id']);
            }
            if (!empty($this->request->data['tipo_pago_id'])) {
                $conditions[] = array('tipo_pago_id'=>$this->request->data['tipo_pago_id']);
            }
            if (isset($this->request->data['pagado']) && ($this->request->data['pagado']!="")) {
                $conditions[] = array('pagado'=>$this->request->data['pagado']);
                $pagado = $this->request->data['pagado'];
            } else {
                $pagado = -1;
            }
            
        } else {
            $pagado = -1;
            $conditions[] = array('fecha >='=>date('Y-m-d'));
        }
        $usuario = $this->request->getSession()->read('Auth.User');
        if ($usuario['tipo_usuario']==2) {
            $conditions[] = array('empleado_id'=>$usuario['id']);
        }
        $tareas = $this->Tareas->find()->where($conditions)->contain(['Users','Clientes','TiposTarea','TiposFactura','TiposPago','Servicios','EstadosServicio']);
        //debug($tareas->toArray());
        $this->set('desde', @$this->request->data['desde']);
        $this->set('hasta', @$this->request->data['hasta']);
        $this->set('direccion', @$this->request->data['direccion']);
        $this->set('cliente', @$this->request->data['cliente']);
        //$this->set('empleado', @$this->request->data['empleado']);
        $this->set('cliente_id', @$this->request->data['cliente_id']);
        $this->set('empleado_id', @$this->request->data['empleado_id']);
        $this->set('tipo_pago_id', @$this->request->data['tipo_pago_id']);
        $this->set(compact('tareas','tiposFactura','tiposPago','servicios','pagado','empleados'));
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
        $tarea = $this->Tareas->get($id, [
            'contain' => ['Users','Clientes','TiposFactura','TiposPago','Servicios','TiposTarea'],
        ]);
        $lista_servicios = array();
        if (!empty($tarea->servicios)) {
            $i=0;   
            foreach ($tarea->servicios as $servicio) {
                $lista_servicios[$i] = $servicio->id;
                $i++;
            }
        }
        $lista_tipos = array();
        if (!empty($tarea->tipos_tarea)) {
            $i=0;  
            foreach ($tarea->tipos_tarea as $tipo) {
                $lista_tipos[$i] = $tipo->id;
                $i++;
            }
        }
        $this->loadModel('TiposTarea');
        $tiposTarea = $this->TiposTarea->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('TiposFactura');
        $tiposFactura = $this->TiposFactura->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('TiposPago');
        $tiposPago = $this->TiposPago->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('Servicios');
        $servicios = $this->Servicios->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('EstadosServicio');
        $estadosServicio = $this->EstadosServicio->find()->order(['id'=>'ASC']);
        //debug($cargado);die;    
        $this->set(compact('tarea','tiposTarea','tiposFactura','tiposPago','estadosServicio','servicios','lista_servicios','lista_tipos'));
       
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        $this->loadModel('TiposTarea');
        $tiposTarea = $this->TiposTarea->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('TiposFactura');
        $tiposFactura = $this->TiposFactura->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('TiposPago');
        $tiposPago = $this->TiposPago->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('Servicios');
        $servicios = $this->Servicios->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('Users');
        $empleados = $this->Users->find()->where(['habilitado'=>1,'tipo_usuario'=>2])->order(['apellido'=>'ASC','nombre'=>'ASC']);
        if ($this->request->is('post')) { 
            $data = @$this->request->data;
            //$data['costo'] = number_format($data['costo'],2,'.',',');
            if(strpos($data['costo'], ',') === true) { $data['costo'] = number_format($data['costo'],2,',','.'); }
            $data['fecha'] = date('Y-m-d',strtotime(str_replace('/','-',$data['fecha'])));
            $data['estado_servicio_id'] = 3;
            $tarea = $this->Tareas->newEntity($data, ['associated' => ['Users','Clientes','TiposTarea','TiposFactura','TiposPago','Servicios']]);
            //debug($data);
            //debug($tarea); die;
            if ($this->Tareas->save($tarea)) {
                $this->Flash->success(__('La tarea fue cargado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La tarea no pudo agregar. Intente más tarde.'));
        }
        
        $this->set(compact('tiposTarea','tiposFactura','tiposPago','servicios','empleados'));
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
        $this->loadModel('TiposTarea');
        $tiposTarea = $this->TiposTarea->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('TiposFactura');
        $tiposFactura = $this->TiposFactura->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('TiposPago');
        $tiposPago = $this->TiposPago->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('Servicios');
        $servicios = $this->Servicios->find()->where(['habilitado'=>1])->order(['descripcion'=>'ASC']);
        $this->loadModel('EstadosServicio');
        $estadosServicio = $this->EstadosServicio->find()->order(['id'=>'ASC']);
        $this->loadModel('Users');
        $empleados = $this->Users->find()->where(['habilitado'=>1,'tipo_usuario'=>2])->order(['apellido'=>'ASC','nombre'=>'ASC']);
        $tarea = $this->Tareas->get($id, [
            'contain' => ['Users','Clientes','TiposTarea','TiposFactura','TiposPago','Servicios','TiposTarea'],
        ]);
        
        $lista_servicios = array();
        if (!empty($tarea->servicios)) {
            $i=0;
            foreach ($tarea->servicios as $servicio) {
                $lista_servicios[$i] = $servicio->id;
                $i++;
            }
        }
        $lista_tipos = array();
        if (!empty($tarea->tipos_tarea)) {
            $i=0;
            foreach ($tarea->tipos_tarea as $tipo) {
                $lista_tipos[$i] = $tipo->id;
                $i++;
            }
        }
        if ($this->request->is('post')) {
            $data = @$this->request->data;            
            if(!empty($data['costo']) && strpos($data['costo'], ',') === true) { $data['costo'] = number_format($data['costo'],2,',','.'); }
            if (!empty($data['fecha'])) $data['fecha'] = date('Y-m-d',strtotime(str_replace('/','-',$data['fecha'])));
            //$data['estado_servicio_id'] = 1;
            $data['pagado'] = empty($data['pagado'])?0:$data['pagado'];
            /*If ($data['estado_servicio_id']==1) {
                $data['viaticos']['fecha']=date('Y-m-d');
                $usuario = $this->request->getSession()->read('Auth.User');
                $data['empleado_id']=$usuario['id'];
                $data['tarea_id']=$id;
                $this->loadModel('Clientes');
                $cliente = $this->Clientes->get($tarea->cliente_id);
                $data['descripcion']=$cliente['razonsocial']." - ".$cliente['direccion']." - ".date('d/m/Y H:i:s');
                
            }*/
            $tarea = $this->Tareas->patchEntity($tarea, $data,['associated' => ['Users','Clientes','TiposTarea','TiposFactura','TiposPago','Servicios','Viaticos']]);
            //debug($tarea); die;
            if ($this->Tareas->save($tarea)) {
                $this->Flash->success(__('Se ha modificado el registro de tarea.'));
                $usuario = $this->request->getSession()->read('Auth.User');
                If ($tarea['estado_servicio_id']==1 && $usuario['tipo_usuario']==2) { 
                    return $this->redirect(['controller'=>'viaticos','action' => 'add', $id]);
                } else {
                    return $this->redirect(['action' => 'index']);
                }              
            } else {
                $this->Flash->error(__('No se ha modificado el registro de tarea. Intente más tarde.'));
            }
        }
        $this->set(compact('tarea','tiposTarea','tiposFactura','tiposPago','estadosServicio','servicios','lista_servicios','lista_tipos','empleados'));
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
        $tarea = $this->Tareas->get($id);
        try {
            if ($this->Tareas->delete($tarea)) {
                $this->Flash->success(__('La tarea fue eliminada correctamente.'));
            } else {
                $this->Flash->error(__('La tarea no fue eliminada.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('No puede borrar pues está asociado con otros registros.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function getClientes() {
        $this->layout = null;
        $valor = $this->getRequest()->getData('valor');
        $direccion = @$this->getRequest()->getData('direccion');
        $this->loadModel('Clientes');
        //$clientes = $this->Clientes->find()->where(['razonsocial like'=>$valor.'%'])->order(['razonsocial'=>'ASC'])->toArray();
        $conditions[] = array('razonsocial like'=>$valor.'%');
        if (!empty($direccion)) $conditions[] = array('direccion'=>$direccion);
        $clientes = $this->Clientes->find()->where($conditions)->order(['razonsocial'=>'ASC'])->toArray();
        $i=0;
        $data= array();
        foreach ($clientes as $cliente) {
            $data[$i]['value'] = $cliente['id'];
            $data[$i]['label'] = $cliente['razonsocial'];
            $i++;
        }
        $this->set('data', $data);
        $this->render('/Element/ajaxreturn');
    }
    
    public function getEmpleados() {
        $this->layout = null;
        $valor = $this->getRequest()->getData('valor');
        $this->loadModel('Users');
        $empleados = $this->Users->find()->where(['OR'=>['nombre like'=>$valor.'%','apellido like'=>$valor.'%']])->order(['nombre'=>'ASC','apellido'=>'ASC']);
        $i=0;
        $data= array();
        foreach ($empleados as $empleado) {
            $data[$i]['value'] = $empleado['id'];
            $data[$i]['label'] = $empleado['nombre']." ".$empleado['apellido'];
            $i++;
        }
        $this->set('data', $data);
        $this->render('/Element/ajaxreturn');
    }
    
    public function getDirecciones() {
        $this->layout = null;
        $valor = $this->getRequest()->getData('valor');
        $this->loadModel('Clientes');
        $direcciones = $this->Clientes->find()->where(['direccion like'=>$valor.'%'])->order(['direccion'=>'ASC']);
        $i=0;
        $data= array();
        foreach ($direcciones as $direccion) {
            $data[$i]['value'] = $direccion['id'];
            $data[$i]['label'] = $direccion['direccion'];
            $data[$i]['cliente_id'] = $direccion['id'];
            $data[$i]['cliente'] = $direccion['razonsocial'];
            $i++;
        }
        $this->set('data', $data);
        $this->render('/Element/ajaxreturn');
    }
}
