<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigurationRequest;
use App\Repositories\ConfigurationRepository;
use Illuminate\Http\Request;

use App\Configuration;

class ConfigurationController extends Controller
{
    protected $configurationRepository;

    public function __construct(ConfigurationRepository $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    public function index()
    {
        $configurations = Configuration::all();

        return view('configuration.index', compact('configurations'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(ConfigurationRequest $request)
    {
        if(Configuration::all()->count() == 0)
        {
            $configuration = $this->configurationRepository->store($request->all());
            return redirect('configuration')->withOk("La configuration a été créé avec succés !");
        }
        else
        {
            return redirect('configuration')->withOk('Une configuration existe déja!');
        }

    }

    public function show($id)
    {
        $configuration = $this->configurationRepository->getById($id);

        return view('show',  compact('configuration'));
    }

    public function edit($id)
    {
        $configuration = $this->configurationRepository->getById($id);

        return view('edit',  compact('configuration'));
    }

    public function update(ConfigurationRequest $request, $id)
    {
        $this->configurationRepository->update($id, $request->all());
        
        return redirect('configuration')->withOk("La configuration a été modifié avec succés!");
    }

    public function destroy($id)
    {
        $this->configurationRepository->destroy($id);

        return back();
    }
}
