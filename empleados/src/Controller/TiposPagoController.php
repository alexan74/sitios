<?php
namespace App\Controller;

use App\Controller\AppController;

class TiposPagoController extends AppController
{
    
    public function initialize() {
        parent::initialize();
        //$this->loadModel('TiposUsuario');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $conditions = array();
        if ($this->request->is('post') || $this->request->session()->check('data'))
        {  
            $misesion = $this->request->session()->read("data");
            if (empty($this->request->data) && isset($misesion)) $this->request->data = $misesion;
            $this->request->session()->write("data",$this->request->data);
            if (!empty($this->request->data['descripcion'])) {
                $conditions[] = array('TiposPago.descripcion like '=>'%'.$this->request->data['descripcion'].'%');
            }
            if (!empty($this->request->data['habilitado']!=-1)) {
                $conditions[] = array('TiposPago.habilitado'=>$this->request->data['habilitado']);
            } else {
                $conditions[] = array('TiposPago.habilitado'=>1);
            }
            $this->set('descripcion', trim($this->request->data['descripcion']));
            $this->set('habilitado', trim($this->request->data['habilitado']));
        }else{
            $conditions[] = array('TiposPago.habilitado'=>1);
            $this->set('descripcion', null);
            $this->set('habilitado', -1);
        } 
        //$this->loadModel('TiposUsuario');
        $tipos = $this->TiposPago->find('all')->where($conditions);
        $this->set(compact('tipos'));
        //print_r (count($users));
        $this->set('_serialize', ['tipos']);
    }
    
    public function limpiar(){
        $this->request->session()->delete('data');
        return $this->redirect(['action' => 'index']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {        
        $tipo = $this->TiposPago->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('tipo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tipo = $this->TiposPago->newEntity();
        if ($this->request->is('post')) {
            $tipo = $this->TiposPago->patchEntity($tipo, $this->request->getData());
            if ($this->TiposPago->save($tipo)) {
                $this->Flash->success(__('El tipo de pago fue guardado.'));

                return $this->redirect(['action' => 'index']);
            } else {
				$this->Flash->error(__('El tipo de pago no puede ser creado. Por favor intente de nuevo.'));
			}
        }
        $this->set(compact('tipo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tipo = $this->TiposPago->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipo = $this->TiposPago->patchEntity($tipo, $this->request->getData());
            if ($this->TiposPago->save($tipo)) {
                $this->Flash->success(__('El tipo de pago fue modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El tipo de pago no puede ser modificado. Por favor intente de nuevo.'));
        }
        $this->set(compact('tipo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $tipo = $this->TiposPago->get($id);
        try { 
            //if ($this->TiposUsuario->delete($tipo)) {
            $data['habilitado'] = 0;
            $tipo = $this->TiposPago->patchEntity($tipo, $data);
            if ($this->TiposPago->save($tipo)) {
                $this->Flash->success(__('El tipo de pago fue eliminado.'));
            } else {
                $this->Flash->error(__('El tipo de pago no puede ser eliminado. Por favor intente de nuevo.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('No puede borrar pues está asociado con otros registros.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
