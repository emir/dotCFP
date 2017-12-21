<?php

namespace App\Http\Controllers;

use App\Conference;
use Illuminate\Http\Request;

class ConferencesController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);

        return response()->view('conferences.create', compact('timezones'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $conference = new Conference();
        $conference->user_id = auth()->id();
        $conference->name = $request->get('name');
        $conference->description = $request->get('description');
        $conference->start_date = $request->get('start_date');
        $conference->end_date = $request->get('end_date');
        $conference->open_date = $request->get('open_date');
        $conference->close_date = $request->get('close_date');
        $conference->saveOrFail();

        flash()->success('Conference/Event created.');

        return redirect()->route('conferences.edit', $conference->slug);
    }

    /**
     * @param Conference $conference
     * @return \Illuminate\Http\Response
     */
    public function edit(Conference $conference)
    {
        $timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::ALL);

        return response()->view('conferences.edit', compact('conference', 'timezones'));
    }

    /**
     * @param Request $request
     * @param Conference $conference
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Conference $conference)
    {
        $conference->update($request->except(['user_id']));

        flash()->success('Conference/Event details updated.');

        return redirect()->route('conferences.edit', $conference->slug);
    }
}
