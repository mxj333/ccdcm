<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Sends Controller
 *
 * @property \App\Model\Table\SendsTable $Sends
 *
 * @method \App\Model\Entity\Send[] paginate($object = null, array $settings = [])
 */
class SendsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Actions']
        ];
        $sends = $this->paginate($this->Sends);

        $this->set(compact('sends'));
        $this->set('_serialize', ['sends']);
    }

    /**
     * View method
     *
     * @param string|null $id Send id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $send = $this->Sends->get($id, [
            'contain' => ['Actions']
        ]);

        $this->set('send', $send);
        $this->set('_serialize', ['send']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $send = $this->Sends->newEntity();
        if ($this->request->is('post')) {
            $send = $this->Sends->patchEntity($send, $this->request->getData());
            if ($this->Sends->save($send)) {
                $this->Flash->success(__('The send has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The send could not be saved. Please, try again.'));
        }
        $actions = $this->Sends->Actions->find('list', ['limit' => 200]);
        $this->set(compact('send', 'actions'));
        $this->set('_serialize', ['send']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Send id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $send = $this->Sends->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $send = $this->Sends->patchEntity($send, $this->request->getData());
            if ($this->Sends->save($send)) {
                $this->Flash->success(__('The send has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The send could not be saved. Please, try again.'));
        }
        $actions = $this->Sends->Actions->find('list', ['limit' => 200]);
        $this->set(compact('send', 'actions'));
        $this->set('_serialize', ['send']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Send id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $send = $this->Sends->get($id);
        if ($this->Sends->delete($send)) {
            $this->Flash->success(__('The send has been deleted.'));
        } else {
            $this->Flash->error(__('The send could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
