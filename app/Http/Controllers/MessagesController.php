<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Inertia\Inertia;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['messages'] = Message::all();        

        return Inertia::render('Messages/Index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return Inertia::render('Messages/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateMessageRequest $request)
    {
       
       $mensaje = new Message;       

       if (auth()->guest()) {
        $mensaje->nombre = $request->nombre;
        $mensaje->email = $request->email;
       } else {
        $mensaje->nombre = auth()->user()->name;
        $mensaje->email = auth()->user()->email;
        $mensaje->user_id = auth()->user()->id;
       }
       
       $mensaje->mensaje = $request->mensaje;       
       $mensaje->save();

       return back()->with('info','El mensaje fue enviado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['mensaje'] = Message::findorFail($id);

        return Inertia::render('Messages/Show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['mensaje'] = Message::findorFail($id);

        return Inertia::render('Messages/Edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, string $id)
    {
       $mensaje = Message::findorFail($id);
       $mensaje->update($request->all());

       return view('Messages/Show')->with('success', 'El mensaje fue actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mensaje = Message::findorFail($id)->delete();

        return redirect ('Messages')->with('success', 'El mensaje fue eliminado exitosamente');

    }
}
