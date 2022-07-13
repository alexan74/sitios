<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    private $user;

    public function isAuthorized($user)
    {
        $this->user = $user;

        $action = $this->request->getParam('action');

        if (in_array($action, ['index','edit',"view",'add','delete'])) {
            //so pode ter acesso se o usuario for admin
            /*if ($action == "changePass" || $action=="recuperarPass") {
                return true;
            }*/
            if(\intval($user["perfil_id"]) === 3 && in_array($action, ['index',"add","delete"])) {
                return false;
            }
            return true;
        }
        
    }
    
    public function beforeFilter(\Cake\Event\Event $event)
    {
        $this->Auth->allow(["changePass","recuperarPass"]);
        //$this->Auth->allow();
        $this->viewBuilder()->setLayout("default");
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Perfil']
        ];
        $query = $this->Users->find()->where(['activo' => 1]);
        $users = $this->paginate($query,array('limit'=>10));

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Perfil']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Ha sido grabado correctamente.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('TNo pudo grabar, por favor intente otra vez.'));
        }
        $perfil = $this->Users->Perfil->find('list',['keyField' => 'id', 'valueField' => 'nombre_perfil'])->toArray();
        $usuario = $this->Auth->user();
        if ($usuario['perfil_id']!==1) {
            unset($perfil[1]);
        }
       
        $this->set(compact('user', 'perfil'));
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
        if((intval($this->user['perfil_id']) == 3) && intval($this->user['id']) != $id){
            $this->Flash->error($this->Auth->_config['authError']);
            return $this->redirect($this->referer());
        }

        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Ha sido grabado correctamente. '));
                //return $this->redirect($this->referer());
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('No pudo grabar, por favor intente otra vez.'));
        }
        $perfil = $this->Users->Perfil->find('list',['keyField' => 'id', 'valueField' => 'nombre_perfil'])->toArray();
        /*$usuario = $this->Auth->user();
        if ($usuario['perfil_id']!==1) {
            unset($perfil[1]);
        }*/
        $this->set(compact('user', 'perfil'));
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
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('Ha sido borrado correctamente.'));
            return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('No pudo borrar. Por favor intente otra vez.'));
        }
    }
    
    public function changePass()
    {
        
        $usuario = $this->Auth->user();
        if (!empty($usuario)) {
            $error=0;
            if ($this->getRequest()->is('post')) {
                $this->Users->recursive = -1;
                //$user = $this->RbacUsuarios->findById($usuario['id'])->toArray();
                $user = $this->Users->get($usuario['id']);
                $contrasenia = $user->password;
                
                $contraseniaActual = $this->getRequest()->getData('contraseniaActual');
                //$contraseniaActualEncrypt = hash('sha256', $seed . $contraseniaActual);
                $hasher = new DefaultPasswordHasher();                
               
                if (!$hasher->check($contraseniaActual, $contrasenia)) {
                    $this->Flash->error('La contraseña actual no es correcta.');
                    return $this->redirect(array('action' => 'changePass'));
                }
                
                $contraseniaNueva = $this->getRequest()->getData('contraseniaNueva');
                $contraseniaNuevaConfirm = $this->getRequest()->getData('contraseniaNuevaConfirm');
                
                if ($contraseniaNueva != $contraseniaNuevaConfirm) {
                    $this->Flash->error('La confirmación de nueva contraseña es incorrecta.');
                    return $this->redirect(array('action' => 'changePass'));
                }
                
                if (!$error) {
                    //$user['password'] = hash('sha256', $seed . $contraseniaNueva);
                    $data['password'] = $contraseniaNueva;
                    $user = $this->Users->patchEntity($user, $data);
                    if ($this->Users->save($user)) {
                        $this->Flash->success('La contraseña ha sido cambiada correctamente.');
                        $this->redirect(array('controller' => 'admin', 'action' => 'index'));
                    }
                }
            }
        } else {
            $this->Flash->error('No encuentra usuario antes de cambiar contraseña.');
            return $this->redirect(array('action' => 'changePass'));
        }
    }
    
    public function recuperarPass($token)
    {
        $this->viewBuilder()->setLayout("home");
        $this->loadModel('Token');
        $result = $this->Token->find()->where(['token' => $token])->first();
        //debug($result); die;
        if (!empty($result)) {
            $fecha_actual   = strtotime('now');
            $fecha_creacion = strtotime($result->created);
            $minutos        = ($fecha_actual - $fecha_creacion) / 60;
            //debug($minutos); die;
            if ($minutos < strtotime($result->validez)) {
                $id   = $result->user_id;
                $user = $this->Users->get($id);
                if ($this->request->is('post')) {
                    $this->Users->recursive = -1;
                    $contraseniaNueva        = $this->request->getData('contrasenia');
                    //$contraseniaNuevaConfirm = $this->request->getData('contraseniaConfirm');
                    
                    $usuario['id']       = $id;
                    $usuario['password'] = $contraseniaNueva;
                    //$usuario['password'] = $this->Users->_setPassword($contraseniaNueva);
                    $usuario = $this->Users->patchEntity($user, $usuario);
                    if ($this->Users->save($usuario)) {
                        $this->Flash->success('Ha sido restablecido correctamente');
                        //$this->redirect(array('controller' => 'rbac_usuarios', 'action' => 'login'));
                        $this->redirect(['controller'=>'Access','action'=>'login']);
                    } else {
                        $this->Flash->error('No pudo cambiar contraseña. Por favor contacto con el administrador');
                    }
                }
                $this->set(compact('user','token'));
            } else {
                //$this->redirect(array('controller' => 'rbac_usuarios', 'action' => 'login'));
                //$this->redirect('login');
                $this->Flash->error('Error. Token vencido');
                $this->redirect(['controller'=>'Access','action'=>'login']);
            }
        } else {
            // $this->redirect(array('controller' => 'rbac_usuarios', 'action' => 'login'));
            //$this->redirect('login');
            $this->Flash->error('Error. No encuentra token antes de cambiar contraseña');
            //$this->redirect($this->web.'/login');
            $this->redirect(['controller'=>'Access','action'=>'login']);
        }
    }

}
?>
