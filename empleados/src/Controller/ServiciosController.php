<?php
namespace App\Controller;

use App\Controller\AppController;

class ServiciosController extends AppController
{
    
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
                $conditions[] = array('Servicios.descripcion like'=>'%'.$this->request->data['descripcion'].'%');
            }
            if ($this->request->data['habilitado']!=-1) {
                $conditions[] = array('Servicios.habilitado'=>$this->request->data['habilitado']);
            } else {
                $conditions[] = array('Servicios.habilitado'=>1);
            }
            $this->set('descripcion', trim($this->request->data['descripcion']));
            $this->set('habilitado', trim($this->request->data['habilitado']));
        }else{
            $conditions[] = array('Servicios.habilitado'=>1);
            $this->set('descripcion', null);
            $this->set('habilitado', -1); 
       }
       $servicios = $this->Servicios->find()->where($conditions);
       $this->set(compact('servicios'));
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
        $servicio = $this->Servicios->get($id);     
        $this->set('servicio', $servicio);
       
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        $servicio = $this->Servicios->newEntity();
        if ($this->request->is('post')) {
            $servicio = $this->Servicios->patchEntity($servicio, $this->request->getData());
            if ($this->Servicios->save($servicio)) {
                $this->Flash->success(__('El servicio fue cargado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El servicio no pudo agregar. Intente más tarde.'));
        }
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
        $servicio = $this->Servicios->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $servicio = $this->Servicios->patchEntity($servicio, $this->request->getData());
            if ($this->Servicios->save($servicio)) {
                $this->Flash->success(__('Se ha modificado el servicio.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('No se ha modificado el servicio. Intente más tarde.'));
            }
        }
        $this->set(compact('servicio'));
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
        
        $servicio = $this->Servicios->get($id);
        try {
            //if ($this->Planillas->delete($planilla)) {
            $data['habilitado'] = 0;
            $servicio = $this->Servicios->patchEntity($servicio, $data);
            if ($this->Servicios->save($servicio)) {
                $this->Flash->success(__('El servicio fue eliminado correctamente.'));
            } else {
                $this->Flash->error(__('El servicio no fue eliminada.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('No puede borrar pues está asociado con otros registros.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
