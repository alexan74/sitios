<?php
namespace App\Controller;

use App\Controller\AppController;

class EstadosServicioController extends AppController
{
    
    public function initialize() {
        parent::initialize();
        $this->loadModel('TiposUsuario');
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
                $conditions[] = array('EstadosServicio.descripcion like '=>'%'.$this->request->data['descripcion'].'%');
            }
            if (!empty($this->request->data['habilitado']!=-1)) {
                $conditions[] = array('EstadosServicio.habilitado'=>$this->request->data['habilitado']);
            } else {
                $conditions[] = array('EstadosServicio.habilitado'=>1);
            }
            $this->set('descripcion', trim($this->request->data['descripcion']));
            $this->set('habilitado', trim($this->request->data['habilitado']));
        }else{
            $conditions[] = array('EstadosServicio.habilitado'=>1);
            $this->set('descripcion', null);
            $this->set('habilitado', -1);
        } 
        //$this->loadModel('TiposUsuario');
        $estados = $this->EstadosServicio->find('all')->where($conditions);
        $this->set(compact('estados'));
        //print_r (count($users));
        $this->set('_serialize', ['estados']);
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
        $estado = $this->EstadosServicio->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('estado'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $estado = $this->EstadosServicio->newEntity();
        if ($this->request->is('post')) {
            $estado = $this->EstadosServicio->patchEntity($estado, $this->request->getData());
            if ($this->EstadosServicio->save($estado)) {
                $this->Flash->success(__('El estado de usuario fue guardado.'));

                return $this->redirect(['action' => 'index']);
            } else {
				$this->Flash->error(__('El estado de usuario no puede ser creado. Por favor intente de nuevo.'));
			}
        }
        $this->set(compact('estado'));
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
        $estado = $this->EstadosServicio->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estado = $this->EstadosServicio->patchEntity($estado, $this->request->getData());
            if ($this->EstadosServicio->save($estado)) {
                $this->Flash->success(__('El estado de usuario fue modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El estado de usuario no puede ser modificado. Por favor intente de nuevo.'));
        }
        $this->set(compact('estado'));
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
        $estado = $this->EstadosServicio->get($id);
        try { 
            //if ($this->TiposUsuario->delete($tipo)) {
            $data['habilitado'] = 0;
            $estado = $this->EstadosServicio->patchEntity($estado, $data);
            if ($this->EstadosServicio->save($estado)) {
                $this->Flash->success(__('El estado de usuario fue eliminado.'));
            } else {
                $this->Flash->error(__('El estado de usuario no puede ser eliminado. Por favor intente de nuevo.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('No puede borrar pues está asociado con otros registros.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
