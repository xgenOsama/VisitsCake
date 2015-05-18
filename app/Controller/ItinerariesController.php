<?php

App::uses('AppController', 'Controller');

/**
 * Itineraries Controller
 *
 * @property Itinerary $Itinerary
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ItinerariesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');

    /**
     * index
     *
     * @return void
     */
    public function index() {
        $this->Itinerary->recursive = 0;
        if ($this->Auth->user('role') == 1) {
            $this->Paginator->settings = array('conditions' => array(
                    'User.id' => $this->Auth->user('id')
            ));
        }
        $this->set('user_role', $this->Auth->user('role'));
        $this->set('itineraries', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Itinerary->exists($id)) {
            throw new NotFoundException(__('Invalid itinerary'));
        }
        if ($this->Auth->user('role') == 1) {
            $options = array('conditions' => array(
                    'Itinerary.id' => $id, 'Itinerary.user_id' => $this->Auth->user('id')
            ));
            $itinerary = $this->Itinerary->find('first', $options);
            if (!empty($itinerary)) {
                $this->set('itinerary', $itinerary);
            } else {
                $this->Session->setFlash('CSRF sucks.!');
                $this->redirect(array('action' => 'index'));
            }
        } else {
            $options = array('conditions' => array('Itinerary.' . $this->Itinerary->primaryKey => $id));
            $this->set('itinerary', $this->Itinerary->find('first', $options));
        }
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $itinerary = $this->request->data;
            $itinerary['Itinerary']['user_id'] = $this->Auth->user('id');
            $this->Itinerary->create();
            if ($this->Itinerary->save($itinerary)) {
                $this->Session->setFlash(__('The itinerary has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The itinerary could not be saved. Please, try again.'));
            }
        }
        $users = $this->Itinerary->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Itinerary->exists($id)) {
            throw new NotFoundException(__('Invalid itinerary'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Itinerary->save($this->request->data)) {
                $this->Session->setFlash(__('The itinerary has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The itinerary could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Itinerary.' . $this->Itinerary->primaryKey => $id));
            $this->request->data = $this->Itinerary->find('first', $options);
        }
        $users = $this->Itinerary->User->find('list');
        $this->set(compact('users'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Itinerary->id = $id;
        if (!$this->Itinerary->exists()) {
            throw new NotFoundException(__('Invalid itinerary'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Itinerary->delete()) {
            $this->Session->setFlash(__('The itinerary has been deleted.'));
        } else {
            $this->Session->setFlash(__('The itinerary could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
