<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipientRequest;
use App\Repositories\RecipientRepository;
use Illuminate\Http\Request;

use App\Recipient;
use App\Configuration;

class RecipientController extends Controller
{
    protected $recipientRepository;

    public function __construct(RecipientRepository $recipientRepository)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('ajax', ['only' => 'update', 'store']);
        $this->recipientRepository = $recipientRepository;
    }

    public function index()
    {
        //Retrieve configuration
        $configuration = Configuration::take(1)->get();

        if($configuration->count() > 0)
        {
            $configuration = $configuration[0];

            $recipients = Recipient::all();

            return view('recipient.index', compact('recipients', 'configuration'));
        }
        else
        {
            return view('recipient.index')->with('error', 'Failed to connect to the API'); 
        }         
    }

    public function create()
    {
        return view('create');
    }

    public function store(RecipientRequest $request)
    {
        $recipient = $this->recipientRepository->store($request->all());
        return $recipient;
    }

    public function show($id)
    {
        $configuration = Configuration::take(1)->get();

        if($configuration->count() > 0)
        {
        $configuration = $configuration[0];

        $recipient = $this->recipientRepository->getById($id);

        return view('recipient.show',  compact('recipient', 'configuration'));
        }
        else
        {
            return view('recipient.index')->with('error', 'Failed to connect to the API');
        }
    }

    public function edit($id)
    {
        $recipient = $this->recipientRepository->getById($id);

        return $recipient;
    }

    public function update(RecipientRequest $request, $id)
    {
        $this->recipientRepository->update($id, $request->all());
        return response()->json();
        
        // return redirect('recipient')->withOk("Le bénéficiaire " . $request->input('name') . " a été modifié.");
    }

    public function destroy($id)
    {
        $this->recipientRepository->destroy($id);

        return back();
    }

}
