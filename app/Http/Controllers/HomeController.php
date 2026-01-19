<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display the projects page.
     */
    public function projets()
    {
        $desktopProjects = \App\Models\Project::published()->latest()->get();
        
        return view('projets', compact('desktopProjects'));
    }

    /**
     * Display the project details page.
     */
    public function show($id)
    {
        $project = \App\Models\Project::findOrFail($id);
        
        return view('projets.show', compact('project'));
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Get all projects (desktop, web, mobile)
     */
    private function getDesktopProjects()
    {
        // Projet Desktop unique avec toutes les captures d'écran
        $desktopProject = [
            'id' => 1,
            'title' => 'Système de Gestion Commerciale',
            'description' => 'Application desktop complète pour la gestion commerciale incluant gestion des produits, caisse, utilisateurs, statistiques et maintenance.',
            'type' => 'desktop',
            'year' => '2024',
            'color' => 'emerald',
            'screenshots' => [
                'images/desktop/gestion_produits.png',
                'images/desktop/caisse.png',
                'images/desktop/diao_dashboard.png',
                'images/desktop/diao_login.png',
                'images/desktop/users.png',
                'images/desktop/statistiques.png',
                'images/desktop/docus.png',
                'images/desktop/ventes_historiques.png',
                'images/desktop/maintenance.png'
            ],
            'mainImage' => 'images/desktop/diao_dashboard.png',
            'features' => [
                'Gestion complète des produits et inventaire',
                'Système de caisse et point de vente',
                'Dashboard administratif avec analytics',
                'Gestion des utilisateurs et permissions',
                'Rapports et statistiques détaillés',
                'Système de maintenance intégré'
            ]
        ];

        // Projets Web (à remplir avec les vraies données)
        $webProjects = [
            // Exemple de structure pour les projets web
            // [
            //     'id' => 100,
            //     'title' => 'Nom du site',
            //     'description' => 'Description du projet web',
            //     'type' => 'web',
            //     'year' => '2024',
            //     'color' => 'blue',
            //     'company' => 'Nom de l\'entreprise',
            //     'logo' => 'URL du logo',
            //     'url' => 'https://example.com',
            //     'mainImage' => 'URL de l\'image principale'
            // ]
        ];

        // Projets Mobile (à remplir avec les vraies données)
        $mobileProjects = [
            // Exemple de structure pour les projets mobile
            // [
            //     'id' => 200,
            //     'title' => 'Nom de l\'app',
            //     'description' => 'Description de l\'application mobile',
            //     'type' => 'mobile',
            //     'year' => '2024',
            //     'color' => 'purple',
            //     'appName' => 'Nom de l\'application',
            //     'logo' => 'URL du logo',
            //     'iosUrl' => 'https://apps.apple.com/...',
            //     'androidUrl' => 'https://play.google.com/...',
            //     'mainImage' => 'URL de l\'image principale'
            // ]
        ];

        return array_merge([$desktopProject], $webProjects, $mobileProjects);
    }
}
