<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Client::class);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $clients = Client::with('contactUser')->get();
        } elseif ($user->hasRole('manager')) {
            $clients = Client::with('contactUser')
                ->where('id', $user->clientManaged?->id)
                ->get();
        } else {
            abort(403);
        }

        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Client::class);
        $managers = User::role('manager')->get();
        return view('clients.create', compact('managers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Client::class);
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_user_id' => ['nullable', 'exists:users,id'],
            'email' => 'required|email|unique:clients,email',
            'address' => 'nullable|string|max:500',
            'logo' => 'sometimes|file|image|max:2048',
        ]);

        $client = Client::create([
            'name' => $request->input('name'),
            'contact_user_id' => $request->input('contact_user_id'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
        ]);

        if ($request->hasFile('logo')) {
        $client->addMediaFromRequest('logo')->toMediaCollection('logos');
        }


        return redirect()->route('clients.index')
            ->with('success', 'Cliente criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        $this->authorize('view', $client);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $this->authorize('update', $client);
        $managers = User::role('manager')->get();
        return view('clients.edit', compact('client', 'managers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $this->authorize('update', $client);
        $request->validate([
            'name' => 'required|string|max:255',
            'contact_user_id' => ['nullable', 'exists:users,id'],
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'logo' => 'sometimes|file|image|max:2048',
        ]);

        $client->update([
            'name' => $request->input('name'),
            'contact_user_id' => $request->input('contact_user_id'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        if ($request->hasFile('logo')) {
        $client->clearMediaCollection('logos');
        $client->addMediaFromRequest('logo')->toMediaCollection('logos');
        }

        return redirect()->route('clients.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $this->authorize('delete', $client);
        $client->delete();
        return redirect()->route('clients.index')
            ->with('success', 'Cliente excluído com sucesso!');
    }
}
