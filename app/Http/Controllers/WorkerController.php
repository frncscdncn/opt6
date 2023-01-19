<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Worker;
use App\Models\Company;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workers = Worker::all();
        return view('workers.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('workers.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkerRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images/workers', 'public');
            $nameImage = substr($path, strlen('images/workers/'));
        }
        
        $worker = new Worker();
        $worker->name = $request->name;
        $worker->email = $request->email;
        $worker->phone_number = $request->phone_number;
        $worker->company_id = $request->company_id;
        $worker->image = ($request->hasFile('image')) ? $nameImage : null;

        $worker->save();

        return redirect()->route('workers.index')->with('success','Сотрудник успешно добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        if (!$worker->image) $worker->image = 'no-image.webp';
        return view('workers.show',compact('worker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function edit(Worker $worker)
    {
        $companies = Company::all();
        return view('workers.edit', compact('worker', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkerRequest $request, Worker $worker)
    {   
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('images/workers/' . $worker->image);
            $image = $request->file('image');
            $path = $image->store('images/workers', 'public');
            $nameImage = substr($path, strlen('images/workers/'));
        }

        $worker->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'company_id' => $request->company_id,
            'image' => ($request->hasFile('image')) ? $nameImage : $worker->image
        ]);

        return redirect()->route('workers.show', $worker)->with('success','Данные сотрудника обновлены!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return redirect()->route('workers.index')->with('success','Сотрудник удален');
    }
}
