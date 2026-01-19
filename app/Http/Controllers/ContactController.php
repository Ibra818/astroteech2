<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Handle the contact form submission.
     */
    public function send(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255', 
            'email' => 'required|email|max:255',
            'projet' => 'required|in:web,mobile,desktop,autre',
            'message' => 'required|string|max:2000',
        ], [
            'prenom.required' => 'Le prénom est requis.',
            'nom.required' => 'Le nom est requis.',
            'email.required' => 'L\'email est requis.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'projet.required' => 'Le type de projet est requis.',
            'projet.in' => 'Le type de projet sélectionné n\'est pas valide.',
            'message.required' => 'Le message est requis.',
            'message.max' => 'Le message ne peut pas dépasser 2000 caractères.',
        ]);

        try {
            // Préparer les données pour l'email
            $contactData = [
                'prenom' => $validated['prenom'],
                'nom' => $validated['nom'],
                'email' => $validated['email'],
                'projet' => $this->getProjectTypeLabel($validated['projet']),
                'message' => $validated['message'],
                'date' => now()->format('d/m/Y H:i'),
            ];

            // Log des demandes de contact (pour le suivi)
            Log::info('Nouvelle demande de contact', $contactData);

            // Simuler l'envoi d'email (à remplacer par un vrai service d'email)
            $this->sendContactEmail($contactData);

            return redirect()->back()->with('success', 
                'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');

        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi du message de contact', [
                'error' => $e->getMessage(),
                'data' => $validated
            ]);

            return redirect()->back()
                ->with('error', 'Une erreur est survenue lors de l\'envoi de votre message. Veuillez réessayer.')
                ->withInput();
        }
    }

    /**
     * Get the project type label in French.
     */
    private function getProjectTypeLabel($type)
    {
        $labels = [
            'web' => 'Site Web',
            'mobile' => 'Application Mobile',
            'desktop' => 'Application Desktop',
            'autre' => 'Autre'
        ];

        return $labels[$type] ?? $type;
    }

    /**
     * Send the contact email (simulation for now).
     */
    private function sendContactEmail($data)
    {
        // Pour une vraie application, vous pouvez utiliser:
        // Mail::to('contact@astrotech.dev')->send(new ContactMail($data));
        
        // Pour le moment, on simule juste l'envoi
        // Dans un vrai projet, configurez les settings SMTP dans .env
        
        $emailContent = "
        Nouvelle demande de contact - AstroTech
        =====================================
        
        Nom: {$data['nom']} {$data['prenom']}
        Email: {$data['email']}
        Type de projet: {$data['projet']}
        Date: {$data['date']}
        
        Message:
        {$data['message']}
        
        =====================================
        ";

        // Log de l'email (en simulation)
        Log::info('Email de contact simulé', ['content' => $emailContent]);
        
        // Vous pouvez aussi sauvegarder en base de données
        $this->saveContactToDatabase($data);
    }

    /**
     * Save contact data to database (optional).
     */
    private function saveContactToDatabase($data)
    {
        // Ici vous pourriez sauvegarder en base si vous avez un modèle Contact
        // Contact::create($data);
        
        // Pour le moment, on utilise juste les logs
        Log::info('Contact sauvegardé', $data);
    }
}
