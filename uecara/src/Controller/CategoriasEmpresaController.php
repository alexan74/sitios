<?php
namespace App\Controller;

use App\Controller\AppController;

class CategoriasEmpresaController extends AppController
{

    public function isAuthorized($user)
    {        
        $action = $this->request->getParam('action');

        if (in_array($action, ['index','edit',"view",'add','delete'])) {
            //so pode ter acesso se o usuario for admin
            /*if(\intval($user["perfil_id"]) === 1){
                return true;
            }*/
            if(\intval($user["perfil_id"]) === 3 && in_array($action, ['index',"add","delete"])){
                return false;
            }
            return true;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        //$this->paginate = array('limit',2);
        $limite = 10;
        $query = $this->CategoriasEmpresa->find()->where(['activo' => 1]);
        $this->paginate = array('limit' => $limite);
        $categorias = $this->paginate($query);

        $this->set(compact('categorias'));
    }

    /**
     * View method
     *
     * @param string|null $id Perfil id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $categoria = $this->CategoriasEmpresa->get($id);

        $this->set(compact('categoria'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $categoria = $this->CategoriasEmpresa->newEntity();
        if ($this->request->is('post')) {
            $categoria = $this->CategoriasEmpresa->patchEntity($categoria, $this->request->getData());
            if ($this->CategoriasEmpresa->save($categoria)) {
                $this->Flash->success(__('Ha sido grabado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No pudo grabar. Por favor intente otra vez.'));
        }
        $this->set(compact('categoria'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Perfil id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $categoria = $this->CategoriasEmpresa->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $categoria = $this->CategoriasEmpresa->patchEntity($categoria, $this->request->getData());
            if ($this->CategoriasEmpresa->save($categoria)) {
                $this->Flash->success(__('Ha sido grabado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No pudo grabar. Por favor intente otra vez.'));
        }
        $this->set(compact('categoria'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Perfil id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $categoria = $this->CategoriasEmpresa->get($id);
        if ($this->hay_relacion($id)) {
            $this->Flash->error(__('No puede borrar por las relaciones de otras tablas'));
        } else {
            if ($this->CategoriasEmpresa->delete($categoria)) {
                $this->Flash->success(__('Ha sido eliminado correctamente.'));
            } else {
                $this->Flash->error(__('No pudo eliminar. Por favor intente otra vez'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function hay_relacion($id){
        $this->loadModel('TiposEmpresa');
        $registros = $this->TiposEmpresa->find()->where(['OR'=>['categoria_id'=>$id,'subcategoria_id'=>$id]]);
        return $registros->count();
    }
}
