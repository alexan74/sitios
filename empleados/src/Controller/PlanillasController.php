<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Planillas Controller
 *
 * @property \App\Model\Table\PlanillasTable $Planillas
 *
 * @method \App\Model\Entity\Certificado[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */

class PlanillasController extends AppController
{
    
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    
    public function index()
    {   
        $this->loadModel('Users');
        $this->paginate = [
        'contain' => ['Users']
        ];
        //$users = $this->paginate($this->Users);
        //$this->set(compact('users'));
        if ($this->request->is('post') || $this->request->session()->check('data'))
        {   //debug($this->request->session()->read("data"));die;
            $misesion = $this->request->session()->read("data");
            if (empty($this->request->data) && isset($misesion)) $this->request->data = $misesion;
            $this->request->session()->write("data",$this->request->data);
            /*$user = $this->Users->find()->where(['OR' => ['razonsocial like'=>'%'.$this->request->data['razonsocial'].'%','direccion like'=>'%'.$this->request->data['direccion'].'%']])->toArray();*/ 
            /*$planillas = $this->paginate($this->Planillas->find()->where(['cliente_id'=> $user['0']['id'] ]));*/
            $conditions = array();
            if (!empty($this->request->data['razonsocial'])) {
                $conditions[] = array('Users.razonsocial like'=>'%'.$this->request->data['razonsocial'].'%');
            }
            if (!empty($this->request->data['direccion'])) {
                $conditions[] = array('Users.direccion like'=>'%'.$this->request->data['direccion'].'%');
            }
            if($this->request->session()->read('Auth.User.role')!="administrador") {
                $conditions[] = array('cliente_id'=> $this->request->session()->read('Auth.User.id'));
            }
            $planillas = $this->Planillas->find()->where($conditions)->contain(['Users']);
            /*$planillas = $this->Planillas->find()->where(['cliente_id'=> $user['0']['id']])->contain(['Users']);*/
            $this->set('razonsocial', trim($this->request->data['razonsocial']));
            $this->set('direccion', trim($this->request->data['direccion']));
        }else{ 
            if (!$this->request->session()->check('data')) {
              $this->set('razonsocial', null);
              $this->set('direccion', null);
            } else {
                $misesion = $this->request->session()->read("data");
                $this->request->data = $misesion;
            }
            $conditions = array();
            if (!empty($this->request->data['razonsocial'])) {
                $conditions[] = array('Users.razonsocial like'=>'%'.$this->request->data['razonsocial'].'%');
            }
            if (!empty($this->request->data['direccion'])) {
                $conditions[] = array('Users.direccion like'=>'%'.$this->request->data['direccion'].'%');
            }
            if($this->request->session()->read('Auth.User.role')!="administrador") {
                $conditions[] = array('cliente_id'=> $this->request->session()->read('Auth.User.id'));
            }
            /*$planillas = $this->paginate($this->Planillas->find()->where(['Users.razonsocial like'=>'%'.isset($this->request->data['razonsocial']).'%','Users.direccion like'=>'%'.isset($this->request->data['direccion']).'%']));*/
            $planillas = $this->Planillas->find()->where($conditions)->contain(['Users']);
        } 
       $this->set(compact('planillas'));
       $this->set('_serialize', ['planillas']);
       $this->set('cliente_id',$this->Auth->user('id'));
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
        $planilla = $this->Planillas->get($id, [
            'contain' => ['Users'],
        ]); 
        $this->loadModel('Users');    
        $cargado = $this->Users->find()->where(['id'=> $planilla['created_by']])->toArray(); 
        $modificado = $this->Users->find()->where(['id'=> $planilla['modified_by']])->toArray(); 
        //debug($cargado);die;    
        $this->set('planilla', $planilla);
        $this->set('cargado', $cargado);
        $this->set('modificado', $modificado);
       
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($cliente=null)
    {   
        $carga = $this->Auth->user('id');
        $planilla = $this->Planillas->newEntity();
        $planilla['created_by'] = $carga;
        if (isset($cliente)) {
            $planilla['cliente_id']=$cliente;
            $this->set(compact('cliente'));
        }
        if ($this->request->is('post')) {
            $planilla = $this->Planillas->patchEntity($planilla, $this->request->getData());
            if ($this->Planillas->save($planilla)) {
                $this->Flash->success(__('La planilla fue cargado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('La planilla no pudo agregar. Intente más tarde.'));
        }
        $this->loadModel('Users');
        $clientes = $this->Users->find()->where(['role !='=>'administrador'])->toArray(); 
        $this->set(compact('clientes'));
        $this->set(compact('planilla'));
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
        $planilla = $this->Planillas->get($id, [
            'contain' => ['Users'],
        ]);
        $modificado = $this->Auth->user('id');
        $this->set(compact('modificado'));
        //debug($modificado);die;
        //debug($this->Auth->user('id'));die;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $planilla = $this->Planillas->patchEntity($planilla, $this->request->getData());
           // debug( $certificado);die;
            if ($this->Planillas->save($planilla)) {
                $this->Flash->success(__('Se ha modificado el registro de planilla.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No se ha modificado el registro de planilla. Intente más tarde.'));
        }
        $this->set(compact('planilla'));
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
        //$this->request->allowMethod(['post', 'delete']);
        $planilla = $this->Planillas->get($id);
        try {
            if ($this->Planillas->delete($planilla)) {
                $this->Flash->success(__('La planilla fue eliminada correctamente.'));
            } else {
                $this->Flash->error(__('La planilla no fue eliminada.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('No puede borrar pues está asociado con otros registros.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
