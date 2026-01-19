<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();
        $stats = [
            'total' => Project::count(),
            'web' => Project::where('type', 'web')->count(),
            'mobile' => Project::where('type', 'mobile')->count(),
            'desktop' => Project::where('type', 'desktop')->count(),
        ];
        
        return view('admin.dashboard', compact('projects', 'stats'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:web,mobile,desktop',
            'year' => 'required|digits:4',
            'color' => 'required|string',
        ];

        if ($request->type === 'web') {
            $rules['company'] = 'required|string|max:255';
            $rules['logo_url'] = 'required|url';
            $rules['site_url'] = 'required|url';
            $rules['main_image'] = 'required|url';
        } elseif ($request->type === 'mobile') {
            $rules['company'] = 'required|string|max:255';
            $rules['logo_url'] = 'required|url';
            $rules['ios_url'] = 'nullable|url';
            $rules['android_url'] = 'nullable|url';
            $rules['main_image'] = 'required|url';
        } elseif ($request->type === 'desktop') {
            $rules['company'] = 'required|string|max:255';
            $rules['screenshots'] = 'required|array|min:1|max:10';
            $rules['screenshots.*'] = 'image|mimes:jpeg,png,jpg,gif|max:5120'; // 5MB max
        }

        $validated = $request->validate($rules);

        // Gérer l'upload des fichiers pour les projets desktop
        if ($request->type === 'desktop' && $request->hasFile('screenshots')) {
            $screenshotPaths = [];
            foreach ($request->file('screenshots') as $screenshot) {
                if ($screenshot && $screenshot->isValid()) {
                    $path = $screenshot->store('projects/screenshots', 'public');
                    $screenshotPaths[] = $path;
                }
            }
            $validated['screenshots'] = $screenshotPaths;
            $validated['main_image'] = $screenshotPaths[0] ?? null;
        }

        Project::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Projet créé avec succès !');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:web,mobile,desktop',
            'year' => 'required|digits:4',
            'color' => 'required|string',
        ];

        if ($request->type === 'web') {
            $rules['company'] = 'required|string|max:255';
            $rules['logo_url'] = 'required|url';
            $rules['site_url'] = 'required|url';
            $rules['main_image'] = 'required|url';
        } elseif ($request->type === 'mobile') {
            $rules['company'] = 'required|string|max:255';
            $rules['logo_url'] = 'required|url';
            $rules['ios_url'] = 'nullable|url';
            $rules['android_url'] = 'nullable|url';
            $rules['main_image'] = 'required|url';
        } elseif ($request->type === 'desktop') {
            $rules['company'] = 'required|string|max:255';
            $rules['screenshots'] = 'required|array|min:1|max:10';
            $rules['screenshots.*'] = 'image|mimes:jpeg,png,jpg,gif|max:5120'; // 5MB max
        }

        $validated = $request->validate($rules);

        // Gérer l'upload des fichiers pour les projets desktop
        if ($request->type === 'desktop' && $request->hasFile('screenshots')) {
            $screenshotPaths = [];
            foreach ($request->file('screenshots') as $screenshot) {
                if ($screenshot && $screenshot->isValid()) {
                    $path = $screenshot->store('projects/screenshots', 'public');
                    $screenshotPaths[] = $path;
                }
            }
            $validated['screenshots'] = $screenshotPaths;
            $validated['main_image'] = $screenshotPaths[0] ?? null;
        }

        $project->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Projet modifié avec succès !');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'Projet supprimé avec succès !');
    }
}
