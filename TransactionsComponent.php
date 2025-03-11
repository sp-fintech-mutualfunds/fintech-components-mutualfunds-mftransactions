<?php

namespace Apps\Fintech\Components\Mf\Transactions;

use Apps\Fintech\Packages\Adminltetags\Traits\DynamicTable;
use Apps\Fintech\Packages\Mf\Transactions\MfTransactions;
use System\Base\BaseComponent;

class TransactionsComponent extends BaseComponent
{
    use DynamicTable;

    protected $mfTransactionsPackage;

    public function initialize()
    {
        $this->mfTransactionsPackage = $this->usePackage(MfTransactions::class);
    }

    /**
     * @acl(name=view)
     */
    public function viewAction()
    {
        if (isset($this->getData()['id'])) {
            if ($this->getData()['id'] != 0) {
                $transaction = $this->mfTransactionsPackage->getById((int) $this->getData()['id']);

                if (!$transaction) {
                    return $this->throwIdNotFound();
                }

                $this->view->transaction = $transaction;
            }

            $this->view->pick('transactions/view');

            return;
        }

        $controlActions =
            [
                // 'disableActionsForIds'  => [1],
                'actionsToEnable'       =>
                [
                    'edit'      => 'mf/transactions',
                    'remove'    => 'mf/transactions/remove'
                ]
            ];

        $conditions =
            [
                'conditions'    => '-|user_id|equals|' . $this->access->auth->account()['id'] . '&'
            ];

        $this->generateDTContent(
            $this->mfTransactionsPackage,
            'mf/transactions/view',
            $conditions,
            ['date', 'amount', 'type', 'user_id', 'portfolio_id'],
            true,
            ['date', 'amount', 'type', 'user_id', 'portfolio_id'],
            $controlActions,
            null,
            null,
            'date'
        );

        $this->view->pick('transactions/list');
    }

    /**
     * @acl(name=add)
     */
    public function addAction()
    {
        $this->requestIsPost();

        //$this->package->add{?}($this->postData());

        $this->addResponse(
            $this->package->packagesData->responseMessage,
            $this->package->packagesData->responseCode
        );
    }

    /**
     * @acl(name=update)
     */
    public function updateAction()
    {
        $this->requestIsPost();

        //$this->package->update{?}($this->postData());

        $this->addResponse(
            $this->package->packagesData->responseMessage,
            $this->package->packagesData->responseCode
        );
    }

    /**
     * @acl(name=remove)
     */
    public function removeAction()
    {
        $this->requestIsPost();

        //$this->package->remove{?}($this->postData());

        $this->addResponse(
            $this->package->packagesData->responseMessage,
            $this->package->packagesData->responseCode
        );
    }
}