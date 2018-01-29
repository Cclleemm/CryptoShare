<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipientRequest;
use App\Repositories\RecipientRepository;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    protected $recipientRepository;

    protected $nbrPerPage = 4;

    public function __construct(RecipientRepository $recipientRepository)
    {
        $this->recipientRepository = $recipientRepository;
    }

    public function index()
    {
        $recipients = $this->recipientRepository->getPaginate($this->nbrPerPage);
        $links = $recipients->render();

        return view('recipient.index', compact('recipients', 'links'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(RecipientRequest $request)
    {
        $recipient = $this->recipientRepository->store($request->all());

        return redirect('recipient')->withOk("Le bénéficiaire " . $recipient->name . " a été créé.");
    }

    public function show($id)
    {
        $recipient = $this->recipientRepository->getById($id);

        return view('show',  compact('recipient'));
    }

    public function edit($id)
    {
        $recipient = $this->recipientRepository->getById($id);

        return view('edit',  compact('recipient'));
    }

    public function update(RecipientRequest $request, $id)
    {
        $this->recipientRepository->update($id, $request->all());
        
        return redirect('recipient')->withOk("Le bénéficiaire " . $request->input('name') . " a été modifié.");
    }

    public function destroy($id)
    {
        $this->recipientRepository->destroy($id);

        return back();
    }

}
