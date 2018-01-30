<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Recipient;
use App\Repositories\TransactionRepository;

use App\Configuration;

class TransactionController extends Controller
{
    protected $transactionRepository;

    protected $nbrPerPage = 50;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->middleware('auth')->except(['index']);
    }

    public function index()
    {

        //Retrieve configuration
        $configuration = Configuration::take(1)->get();

        if($configuration->count() > 0)
        {
            $configuration = $configuration[0];

            $transactions = $this->transactionRepository->getPaginate($this->nbrPerPage);
            $links = $transactions->render();
            $recipients = Recipient::all();

            return view('transaction.index', compact('transactions','recipients', 'links', 'configuration'));
        }
        else
        {
            return view('transaction.index')->with('error', 'Failed to connect to the API');
        }         
    }

    public function create()
    {
        return view('create');
    }

    public function store(TransactionRequest $request)
    {
        $transaction = $this->transactionRepository->store($request->all());

        return redirect('transaction')->withOk("La transaction " . $transaction->name . " a été créée.");
    }

    public function show($id)
    {
        $transaction = $this->transactionRepository->getById($id);

        return view('show',  compact('transaction'));
    }

    public function edit($id)
    {
        $transaction = $this->transactionRepository->getById($id);

        return view('edit',  compact('transaction'));
    }

    public function update(TransactionRequest $request, $id)
    {
        $this->transactionRepository->update($id, $request->all());
        
        return redirect('transaction')->withOk("La transaction " . $request->input('note') . " a été modifiée.");
    }

    public function destroy($id)
    {
        $this->transactionRepository->destroy($id);

        return back();
    }

}
