<?php

namespace App\Http\Controllers;

use App\Data\ProjectsData;
use Illuminate\View\View;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    public function show(string $slug): View|Response
    {

        $project = ProjectsData::find($slug);

        if (! $project) {
            abort(404);
        }

        return view('pages.project', compact('project'));
    }
}