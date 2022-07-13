<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Clientes Controller
 *
 * @property \App\Model\Table\ClientesTable $Clientes
 *
 * @method \App\Model\Entity\Cliente[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientesController extends AppController
{
    
    public function index()
    {
        if ($this->request->is('post') || $this->request->session()->check('data'))
        {  //debug($this->request->data);die;
            $misesion = $this->request->session()->read("data");
            if (empty($this->request->data) && isset($misesion)) $this->request->data = $misesion;
            $this->request->session()->write("data",$this->request->data);
            /*$users = $this->paginate($this->Users->find()->where(['direccion like'=>'%'.$this->request->data['direccion'] .'%',
            'razonsocial like'=>'%'.$this->request->data['razonsocial'].'%']));*/
            $conditions = array();
            if (!empty($this->request->data['razonsocial'])) {
                $conditions[] = array('Clientes.razonsocial like'=>'%'.$this->request->data['razonsocial'].'%');
            }
            if (!empty($this->request->data['direccion'])) {
                $conditions[] = array('Clientes.direccion like'=>'%'.$this->request->data['direccion'].'%');
            }
            $clientes = $this->Clientes->find('all')->where($conditions);
            $this->set('razonsocial', trim($this->request->data['razonsocial']));
            $this->set('direccion', trim($this->request->data['direccion'])); 
        }else{ 
            if (!$this->request->session()->check('data')) {
               //$this->request->data['apellido']='';
              $this->set('direccion', null);
              $this->set('razonsocial', null);
            } else {
                $misesion = $this->request->session()->read("data");
                $this->request->data = $misesion;
            }
            $conditions = array();
            if (!empty($this->request->data['razonsocial'])) {
                $conditions[] = array('Clientes.razonsocial like'=>'%'.$this->request->data['razonsocial'].'%');
            }
            if (!empty($this->request->data['direccion'])) {
                $conditions[] = array('Clientes.direccion like'=>'%'.$this->request->data['direccion'].'%');
            }
            /*$users = $this->paginate($this->Users->find('all')->where(['direccion like'=>'%'.isset($this->request->data['direccion']).'%',
            'razonsocial like'=>'%'.isset($this->request->data['razonsocial']).'%']));*/
            $clientes = $this->Clientes->find('all')->where($conditions);
            //$users = $this->paginate('Users');
            //$users = $this->Users->find('all');
        } 
        $this->set(compact('clientes'));
        //print_r (count($users));
        $this->set('_serialize', ['clientes']);
    }
    
    public function limpiar(){
        $this->request->session()->delete('data');
        return $this->redirect(['action' => 'index']);
    }

    
    public function view($id = null)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => [],
        ]);

        $this->set('cliente', $cliente);
    }

   
    public function add()
    {
        $cliente = $this->Clientes->newEntity();
        if ($this->request->is('post')) {
            $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
            if ($this->Clientes->save($cliente)) {
                $this->Flash->success(__('El cliente fue guardado.'));
                return $this->redirect(['action' => 'index']);
            } else {
				$this->Flash->error(__('El cliente no puede ser creado. Por favor intente de nuevo.'));
			}
        }
        $this->set(compact('cliente'));
    }

    
    public function edit($id = null)
    {
        $cliente = $this->Clientes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cliente = $this->Clientes->patchEntity($cliente, $this->request->getData());
            if ($this->Clientes->save($cliente)) {
                $this->Flash->success(__('El cliente fue modificado.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El cliente no puede ser modificado. Por favor intente de nuevo.'));
        }
        $this->set(compact('cliente'));
    }

    
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $cliente = $this->Clientes->get($id);
        try { 
            $data['habilitado'] = 0;
            $cliente = $this->Clientes->patchEntity($cliente, $data);
            //if ($this->Users->delete($user)) {
            if ($this->Clientes->save($cliente)) {
                $this->Flash->success(__('El cliente fue eliminado.'));
            } else {
                $this->Flash->error(__('El cliente no puede ser eliminado. Por favor intente de nuevo.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('No puede borrar pues está asociado con otros registros.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
