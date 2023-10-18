<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Chirp;



use App\Models\User;
use Illuminate\View\View;
use App\Policies\ChirpPolicy;
use  \Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;


class ChirpController extends Controller
{
      /**
     * Display a listing of the resource.
     */
 /**
     * Update the given blog post.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */


    public function index(): view
    {
        return view('chirpes.index', [
            'chirpes' => Chirp::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
           $validated = $request->validate([
                'message' => 'required|string|max:255',
            ]);

            $request->user()->chirps()->create($validated);

            return \redirect(route('chirpes.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /** @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function edit(Chirp $chirpe): view
    {
        // if (! Gate::allows('update-chirp', $chirp)) {
        //     abort(403);
        // }
        if (Gate::any(['update-chirpe', 'edit-chirp'], $chirpe)) {

            $this->authorize('update', $chirpe);
        }


        return view('chirpes.edit', [
            'chirpe' => $chirpe]);
    }

    /**
     * Update the specified resource in storage.
     */
              /**
     * Update the given chirp.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Chirp $chirpe): RedirectResponse
    {
            if (! Gate::allows('update-chirpe', $chirpe)) {
            abort(403);
          }

            $this->authorize('update', $chirpe);

            $validated = $request->validate([
                'message' => 'required|string|max:255',
            ]);
            $chirpe->update($validated);



        return \redirect(route('chirpes.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirpe): RedirectResponse
    {
        $this->authorize('delete', $chirpe);

        $chirpe->delete();

        return \redirect(route('chirpes.index'));
    }
}
