# Constructo (Szlazak Gestion)

Application Laravel de gestion pour entreprise BTP. Elle centralise les chantiers, stockage (équipements), équipe, agenda, fiches d'heures et un dashboard opérationnel.

## Sommaire
- Présentation
- Fonctionnalités
- Modules
- Stack technique
- Installation
- Configuration
- Scheduler & rappels email
- Exports
- Structure rapide
- Notes

## Présentation
Constructo (Szlazak Gestion) est une application de suivi et de pilotage interne pour une entreprise de construction. L'objectif est de regrouper l'activité quotidienne (chantiers, équipements, employés, heures, agenda) dans une interface claire et homogène.

## Fonctionnalités
- Dashboard complet: météo, heure/date en direct, indicateurs clés.
- Chantiers: statut, dates, responsable, tarif, affectations.
- Stockage: suivi du stock, état, localisation.
- Emprunts de stockage: suivi des prêts/retours, utilisateur, chantier, quantité, statuts.
- Équipe: gestion des profils et ancienneté.
- Agenda: événements avec statuts visibles.
- Fiches d'heures: filtres, export CSV/PDF, résumé hebdo 35h, panier et zone.
- Paramètres: changement de mot de passe + jauge de force.
- Notifications: rappel email 1h avant un événement.

## Modules
- `Chantiers`
- `Stockage`
- `Emprunts`
- `Équipe`
- `Agenda`
- `Fiches d'heures`
- `Dashboard`
- `Paramètres`

## Stack technique
**Backend**
- Laravel 8
- PHP 8.x
- MySQL

**Frontend / UI**
- Bootstrap 5
- Font Awesome
- Animate.css
- FullCalendar
- Flatpickr

## Dépendances principales (Composer)
- barryvdh/laravel-dompdf (PDF)
- guzzlehttp/guzzle (HTTP client)
- laravel/sanctum (auth API)
- fruitcake/laravel-cors (CORS)

## Exports
- CSV global fiches d'heures
- PDF global fiches d'heures (DOMPDF) avec logo, résumé et paniers

## Structure rapide
- `app/Http/Controllers` : logique métier
- `resources/views` : vues Blade (UI)
- `routes/web.php` : routes principales
- `app/Console/Commands` : tâches planifiées (rappels)

## Mise en ligne 
- https://szlazakgestion.fr/Szlazakgestion/login
- o2switch
- Tutoriel : https://www.youtube.com/watch?v=vZFujlyMSO4&t=59s
