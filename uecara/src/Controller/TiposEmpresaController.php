<?php
namespace App\Controller;

use App\Controller\AppController;

class TiposEmpresaController extends AppController
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
        //$this->TiposEmpresa->recursive=2;
        $query = $this->TiposEmpresa->find()->where(['TiposEmpresa.activo' => 1])->contain(['CategoriasEmpresa','SubCategoriasEmpresa']);
        //debug($query->toArray());
        $tipos = $this->paginate($query,array('limit'=>10));

        $this->set(compact('tipos'));
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
        $tipo = $this->TiposEmpresa->get($id, ['contain' => ['CategoriasEmpresa','SubCategoriasEmpresa']]);

        $this->set(compact('tipo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tipo = $this->TiposEmpresa->newEntity();
       
        if ($this->request->is('post')) {
            $tipo = $this->TiposEmpresa->patchEntity($tipo, $this->request->getData());
            if ($this->TiposEmpresa->save($tipo)) {
                $this->Flash->success(__('Ha sido grabado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No pudo grabar. Por favor intente otra vez.'));
        }
        $this->loadModel('CategoriasEmpresa');
        $categorias = $this->CategoriasEmpresa->find('list',['keyField' => 'id', 'valueField' => 'nombre'])->toArray();
        $this->set(compact('tipo','categorias'));
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

        $tipo = $this->TiposEmpresa->get($id, [
            'contain' => ['CategoriasEmpresa','SubCategoriasEmpresa']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipo = $this->TiposEmpresa->patchEntity($tipo, $this->request->getData());
            if ($this->TiposEmpresa->save($tipo)) {
                $this->Flash->success(__('Ha sido grabado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No pudo grabar. Por favor intente otra vez.'));
        }
        $this->loadModel('CategoriasEmpresa');
        $categorias = $this->CategoriasEmpresa->find('list',['keyField' => 'id', 'valueField' => 'nombre'])->toArray();
        $this->set(compact('tipo','categorias'));
    }

    public function delete($id = null)
    {
        //$this->request->allowMethod(['post', 'delete']);
        $tipo = $this->TiposEmpresa->get($id);
        if ($this->hay_relacion($id)) {
            $this->Flash->error(__('No puede borrar por las relaciones de otras tablas'));
        } else {
            if ($this->TiposEmpresa->delete($tipo)) {
                $this->Flash->success(__('Ha sido eliminado correctamente.'));
            } else {
                $this->Flash->error(__('No pudo eliminar. Por favor intente otra vez'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function hay_relacion($id){
        $this->loadModel('Empresa');
        $registros = $this->Empresa->find()->where(['tipo_empresa_id'=>$id]);
        return $registros->count();
    }
}
