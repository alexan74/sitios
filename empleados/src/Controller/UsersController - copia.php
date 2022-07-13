<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($escliente=null)
    {
        $conditions = array();
        if ($escliente) {
            $conditions[] = array('Users.tipo_usuario'=>3);
            $this->request->session()->write('escliente',$escliente);
        } else {
            $this->request->session()->delete('escliente');
        }
        if ($this->request->is('post') || $this->request->session()->check('data'))
        {  
            $misesion = $this->request->session()->read("data");
            if (empty($this->request->data) && isset($misesion)) $this->request->data = $misesion;
            $this->request->session()->write("data",$this->request->data);

            
            /*if (!empty($this->request->data['usuario'])) {
                $conditions[] = array('Users.username like'=>'%'.$this->request->data['usuario'].'%');
            }*/
            if (!empty($this->request->data['nombre'])) {
                $conditions[] = array('Users.nombre like'=>'%'.$this->request->data['nombre'].'%');
            }
            if (!empty($this->request->data['apellido'])) {
                $conditions[] = array('Users.apellido like'=>'%'.$this->request->data['apellido'].'%');
            }
            if ($this->request->data['habilitado']!=-1) {
                $conditions[] = array('Users.habilitado'=>$this->request->data['habilitado']);
            }
            $users = $this->Users->find('all')->where($conditions);
            //$users = $this->Users->find('all')->where($conditions)->contain(['Users']);
            $this->set('habilitado', trim($this->request->data['habilitado']));
            $this->set('nombre', trim($this->request->data['nombre'])); 
            $this->set('apellido', trim($this->request->data['apellido'])); 
        }else{ 
            $this->set('habilitado', -1);
            $this->set('nombre', null);
            $this->set('apellido', null);
        } 
        
        $users = $this->Users->find('all')->where($conditions);
        $this->set(compact('users'));
        //print_r (count($users));
        $this->set('_serialize', ['users']);
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
        $this->loadModel('TiposUsuario');
        $tipos = $this->TiposUsuario->find()->toArray();
        
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user','tipos'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('TiposUsuario');
        $tipos = $this->TiposUsuario->find()->toArray();
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario fue guardado.'));
                if ($this->request->session()->read('escliente'))
                    return $this->redirect(['action' => 'index'],1);
                else
                    return $this->redirect(['action' => 'index']);
            } else {
				$this->Flash->error(__('El usuario no puede ser creado. Por favor intente de nuevo.'));
			}
        }
        $this->set(compact('user','tipos'));
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
        $this->loadModel('TiposUsuario');
        $tipos = $this->TiposUsuario->find()->toArray();
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario fue modificado.'));
                if ($this->request->session()->read('escliente'))
                    return $this->redirect(['action' => 'index'],1);
                else
                    return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('El usuario no puede ser modificado. Por favor intente de nuevo.'));
        }
        $this->set(compact('user','tipos'));
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
        $user = $this->Users->get($id);
        try { 
            //if ($this->Users->delete($user)) {
            $data['habilitado'] = 0;
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('El usuario fue eliminado.'));
            } else {
                $this->Flash->error(__('El usuario no puede ser eliminado. Por favor intente de nuevo.'));
            }
        } catch (Exception $e) {
            $this->Flash->error(__('No puede borrar pues está asociado con otros registros.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function login()
    {
        $this->layout=null;
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            $this->request->session()->write('Auth.User',$user);
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('Tu usuario o contraseña son incorrectos.');
        }
    }

    public function initialize()
{
    parent::initialize();
    $this->Auth->allow(['logout']);
    
}

public function logout()
{
    //$this->Flash->success('Ahora estas desconectado.');
    return $this->redirect($this->Auth->logout());
}



}
