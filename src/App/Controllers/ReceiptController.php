<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{TransactionService, ReceiptService};

class ReceiptController
{
  private TemplateEngine $view;
  private TransactionService $transactionService;
  private ReceiptService $receiptService;
  public function __construct(
    TemplateEngine $view,
    TransactionService $transactionService,
    ReceiptService $receiptService
  ) {
    $this->view = $view;
    $this->transactionService = $transactionService;
    $this->receiptService = $receiptService;
  }

  public function uploadView(array $params)
  {
    $transaction = $this->transactionService->getUserTransaction($params['transaction']);

    if (!$transaction) {
      redirectTo("/");
    }

    echo $this->view->render("receipts/create.php");
  }

  public function upload(array $params)
  {
    $transaction = $this->transactionService->getUserTransaction($params['transaction']);

    if (!$transaction) {
      redirectTo("/");
    }

    $receiptFile = $_FILES['receipt'] ?? null;

    $this->receiptService->validateFile($receiptFile);

    $this->receiptService->upload($receiptFile, $transaction['id']);

    redirectTo("/");
  }

  public function download(array $params)
  {
    $transaction = $this->transactionService->getUserTransaction($params['transaction']);

    if (empty($transaction)) {
      redirectTo('/');
    }

    $receipt = $this->receiptService->getReceipt($params['receipt']);

    if (empty($receipt)) {
      redirectTo('/');
    }

    if ($receipt['transaction_id'] !== $transaction['id']) {
      redirectTo('/');
    }

    $this->receiptService->read($receipt);
  }

  public function delete(array $params)
  {
    $transaction = $this->transactionService->getUserTransaction($params['transaction']);

    if (empty($transaction)) {
      redirectTo('/');
    }

    $receipt = $this->receiptService->getReceipt($params['receipt']);

    if (empty($receipt)) {
      redirectTo('/');
    }

    if ($receipt['transaction_id'] !== $transaction['id']) {
      redirectTo('/');
    }

    $this->receiptService->delete($receipt);

    redirectTo('/');
  }
}