<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class BoardsController extends Controller
{
    public function show(Project $project, Board $board)
    {
        abort_if($project->private && !auth()->user()?->hasAdminAccess(), 404);

        return view('board', [
            'project' => $project,
            'board' => $board,
        ]);
    }
}
