<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */


	public function index() {
        //$this->render('/Itineraries/add');
        //$this->redirect('http://www.google.com');
        //$this->redirect(array('controller'=>'itineraries','action'=> 'view',$this->Auth->user('id')));
        //echo $this->referer(array('controller'=>'itineraries','action' => 'index'));
        $this->User->recursive = 0;
        //$check = $this->User->findByUsername('xg'.'*');
        //print_r($check);
        //exit();
        if($this->Auth->user('role') == 1){
            $this->Paginator->settings = array('conditions'=> array(
                'User.id'=> $this->Auth->user('id')
            ));
        }
        $this->set('users',$this->Paginator->paginate());
        //$this->set('title','Hell');
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if($this->Auth->user('id') !== $id){
            $this->Session->setFlash('CSRF sucks');
            $this->redirect(array('action' => 'index'));
        }else{
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->set('user', $this->User->find('first', $options));
        }
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
        if($this->Auth->user('id')!= $id){
            $this->Session->setFlash('CSRF sucks.!');
            $this->redirect(array('action'=>'index'));
        }else{
		if ($this->request->is(array('post', 'put'))) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
            //$this->User->recursive = 0;
            //print_r($data = $this->User->read(null,$id));
            //unset($data['User']['password']);
            //echo "_________________________________";
            //print_r($data);
            //exit();
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
       /* if($this->referer() == 'http://localhost/Visites/users'){
            return $this->redirect(array('controller'=>'itineraries','action'=>'index'));
        }*/
        if($this->Auth->user('id') != $id && $this->Auth->user('role') != 0){
            $this->Session->setFlash('CSRF sucks .! ');
            $this->redirect(array('action' => 'index'));
        }else {
            $this->request->allowMethod('post', 'delete');
            if ($this->User->delete()) {
                $this->Session->setFlash(__('The user has been deleted.'));
            } else {
                $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
        }
	}

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','login');
    }
    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}
