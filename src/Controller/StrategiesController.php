<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Strategies Controller
 *
 * @property \App\Model\Table\StrategiesTable $Strategies
 *
 * @method \App\Model\Entity\Strategy[] paginate($object = null, array $settings = [])
 */
class StrategiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $strategies = $this->paginate($this->Strategies);

        $this->set(compact('strategies'));
        $this->set('_serialize', ['strategies']);
    }

    /**
     * View method
     *
     * @param string|null $id Strategy id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $strategy = $this->Strategies->get($id, [
            'contain' => ['Actions']
        ]);

        $this->set('strategy', $strategy);
        $this->set('_serialize', ['strategy']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $strategy = $this->Strategies->newEntity();
        if ($this->request->is('post')) {
            $strategy = $this->Strategies->patchEntity($strategy, $this->request->getData());
            if ($this->Strategies->save($strategy)) {
                $this->Flash->success(__('The strategy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The strategy could not be saved. Please, try again.'));
        }
        $this->set(compact('strategy'));
        $this->set('_serialize', ['strategy']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Strategy id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $strategy = $this->Strategies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $strategy = $this->Strategies->patchEntity($strategy, $this->request->getData());
            if ($this->Strategies->save($strategy)) {
                $this->Flash->success(__('The strategy has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The strategy could not be saved. Please, try again.'));
        }
        $this->set(compact('strategy'));
        $this->set('_serialize', ['strategy']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Strategy id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $strategy = $this->Strategies->get($id);
        if ($this->Strategies->delete($strategy)) {
            $this->Flash->success(__('The strategy has been deleted.'));
        } else {
            $this->Flash->error(__('The strategy could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
