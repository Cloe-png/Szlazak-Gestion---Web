<?php

namespace App\Http\Controllers;

use App\Models\Timesheet;
use App\Models\User;
use App\Models\Chantier;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TimesheetController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Timesheet::with(['user', 'chantier'])
            ->orderBy('date_travail', 'desc');

        $dateFrom = request('date_from');
        $dateTo = request('date_to');
        $chantierId = request('chantier_id');

        if ($user && !$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        if ($dateFrom) {
            $query->whereDate('date_travail', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('date_travail', '<=', $dateTo);
        }
        if ($chantierId) {
            if ($user && !$user->isAdmin()) {
                $isAssigned = $user->chantiersAttribues()
                    ->where('chantiers.id', $chantierId)
                    ->exists();
                if (!$isAssigned) {
                    abort(403);
                }
            }
            $query->where('chantier_id', $chantierId);
        }

        $timesheets = $query->get();
        $chantiers = $user && !$user->isAdmin()
            ? $user->chantiersAttribues()->orderBy('nom')->get()
            : Chantier::orderBy('nom')->get();
        $filters = [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
            'chantier_id' => $chantierId,
        ];

        if ($user && !$user->isAdmin()) {
            return view('timesheets.index-lite', compact('timesheets'));
        }

        return view('timesheets.index', compact('timesheets', 'chantiers', 'filters'));
    }

    public function create(Request $request)
    {
        $user = auth()->user();

        if ($user && !$user->isAdmin()) {
            $users = User::with('role')->whereKey($user->id)->get();
            $chantiers = $user->chantiersAttribues()->where('statut', '!=', 'TerminÃ©')->get();
            $selectedUser = $user->id;
        } else {
            $users = User::all();
            $chantiers = Chantier::where('statut', '!=', 'TerminÃ©')->get();
            $selectedUser = $request->get('user_id');
        }

        return view('timesheets.create', compact('users', 'chantiers', 'selectedUser'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            $request->merge(['user_id' => $user->id]);
            $isAssigned = $user->chantiersAttribues()
                ->where('chantiers.id', $request->chantier_id)
                ->exists();
            if (!$isAssigned) {
                abort(403);
            }
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'chantier_id' => 'required|exists:chantiers,id',
            'date_travail' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'pause' => 'boolean',
            'panier' => 'boolean',
            'heures_supp' => 'nullable|numeric|min:0',
            'zone' => 'nullable|integer|min:1|max:4',
        ]);

        $date = Carbon::parse($request->date_travail);
        $mois = $date->translatedFormat('F Y');
        $jour = $date->translatedFormat('l');

        Timesheet::create([
            'user_id' => $request->user_id,
            'chantier_id' => $request->chantier_id,
            'date_travail' => $request->date_travail,
            'mois' => $mois,
            'jour' => $jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'pause' => $request->pause ?? false,
            'panier' => $request->panier ?? false,
            'heures_supp' => $request->heures_supp ?? 0,
            'zone' => $request->zone,
        ]);

        if ($user && !$user->isAdmin()) {
            return redirect()->route('timesheets.index')
                ->with('success', 'Fiche d\'heures crÃ©Ã©e avec succÃ¨s.');
        }

        return redirect()->route('users.show', $request->user_id)
            ->with('success', 'Fiche d\'heures crÃ©Ã©e avec succÃ¨s.');
    }

    public function show(Timesheet $timesheet)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin() && $timesheet->user_id !== $user->id) {
            abort(403);
        }

        $timesheet->load(['user', 'chantier']);
        if ($user && !$user->isAdmin()) {
            return view('timesheets.show-lite', compact('timesheet'));
        }
        return view('timesheets.show', compact('timesheet'));
    }

    public function edit(Timesheet $timesheet)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        $users = User::all();
        $chantiers = Chantier::all();

        return view('timesheets.edit', compact('timesheet', 'users', 'chantiers'));
    }

    public function update(Request $request, Timesheet $timesheet)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'chantier_id' => 'required|exists:chantiers,id',
            'date_travail' => 'required|date',
            'heure_debut' => 'required|date_format:H:i',
            'heure_fin' => 'required|date_format:H:i|after:heure_debut',
            'pause' => 'boolean',
            'panier' => 'boolean',
            'heures_supp' => 'nullable|numeric|min:0',
            'zone' => 'nullable|integer|min:1|max:4',
        ]);

        $date = Carbon::parse($request->date_travail);
        $mois = $date->translatedFormat('F Y');
        $jour = $date->translatedFormat('l');

        $timesheet->update([
            'user_id' => $request->user_id,
            'chantier_id' => $request->chantier_id,
            'date_travail' => $request->date_travail,
            'mois' => $mois,
            'jour' => $jour,
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'pause' => $request->pause ?? false,
            'panier' => $request->panier ?? false,
            'heures_supp' => $request->heures_supp ?? 0,
            'zone' => $request->zone,
        ]);

        if ($user && !$user->isAdmin()) {
            return redirect()->route('timesheets.index')
                ->with('success', 'Fiche d\'heures mise Ã  jour avec succÃ¨s.');
        }

        return redirect()->route('users.show', $request->user_id)
            ->with('success', 'Fiche d\'heures mise Ã  jour avec succÃ¨s.');
    }

    public function destroy(Timesheet $timesheet)
    {
        $user = auth()->user();
        if ($user && !$user->isAdmin()) {
            abort(403);
        }

        $userId = $timesheet->user_id;
        $timesheet->delete();

        if ($user && !$user->isAdmin()) {
            return redirect()->route('timesheets.index')
                ->with('success', 'Fiche d\'heures supprimÃ©e avec succÃ¨s.');
        }

        return redirect()->route('users.show', $userId)
            ->with('success', 'Fiche d\'heures supprimÃ©e avec succÃ¨s.');
    }

    public function exportWeekly(Request $request, User $user)
    {
        if (!auth()->check() || auth()->user()->role_id !== 1) {
            abort(403);
        }

        $request->validate([
            'week' => 'required|regex:/^\\d{4}-W\\d{2}$/',
        ]);

        [$year, $week] = explode('-W', $request->week);
        $start = Carbon::now()->setISODate((int) $year, (int) $week)->startOfWeek(Carbon::MONDAY);
        $end = (clone $start)->endOfWeek(Carbon::SUNDAY);

        $timesheets = Timesheet::with('chantier:id,nom')
            ->where('user_id', $user->id)
            ->whereBetween('date_travail', [$start->toDateString(), $end->toDateString()])
            ->orderBy('date_travail')
            ->get();

        $filename = 'timesheets_' . $user->id . '_' . $start->format('Ymd') . '_' . $end->format('Ymd') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($timesheets, $user, $start, $end) {
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF");

            fputcsv($output, [
                'Employé',
                'Email',
                'Semaine',
                'Date',
                'Chantier',
                'Heure début',
                'Heure fin',
                'Pause',
                'Panier',
                'Heures supp',
                'Total heures',
            ], ';');

            $weekLabel = $start->format('d/m/Y') . ' - ' . $end->format('d/m/Y');

            foreach ($timesheets as $t) {
                fputcsv($output, [
                    $user->nom,
                    $user->email,
                    $weekLabel,
                    $t->date_formatee,
                    $t->chantier->nom ?? 'N/A',
                    $t->heure_debut_formatee,
                    $t->heure_fin_formatee,
                    $t->pause ? 'Oui' : 'Non',
                    $t->panier ? 'Oui' : 'Non',
                    $t->heures_supp,
                    $t->total_heures,
                ], ';');
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportGlobal(Request $request)
    {
        if (!auth()->check() || auth()->user()->role_id !== 1) {
            abort(403);
        }

        $query = Timesheet::with(['user', 'chantier'])
            ->orderBy('date_travail', 'desc');

        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $chantierId = $request->get('chantier_id');

        if ($dateFrom) {
            $query->whereDate('date_travail', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('date_travail', '<=', $dateTo);
        }
        if ($chantierId) {
            $query->where('chantier_id', $chantierId);
        }

        $timesheets = $query->get();

        if ($request->get('format') === 'pdf') {
            $summary = [];
            $groupedByUser = $timesheets->groupBy('user_id');
            foreach ($groupedByUser as $userId => $userTimesheets) {
                $user = $userTimesheets->first()->user;
                $weeks = $userTimesheets->groupBy(function ($item) {
                    return Carbon::parse($item->date_travail)->format('Y-W');
                });

                $userWeeks = [];
                foreach ($weeks as $weekKey => $weekTimesheets) {
                    $firstDate = $weekTimesheets->first()->date_travail;
                    $dateDebut = Carbon::parse($firstDate)->startOfWeek();
                    $dateFin = Carbon::parse($firstDate)->endOfWeek();
                    $weekNumber = Carbon::parse($firstDate)->weekOfYear;
                    $totalSemaine = $weekTimesheets->sum('heures_travaillees');
                    $heuresSupp = max(0, $totalSemaine - 35);
                    $heuresNormales = $totalSemaine - $heuresSupp;
                    $zones = $weekTimesheets->pluck('zone')->filter()->unique()->values()->all();
                    $panierOui = $weekTimesheets->contains(function ($t) { return (bool) $t->panier; });

                    $userWeeks[] = [
                        'week_number' => $weekNumber,
                        'period' => $dateDebut->format('d/m/Y') . ' - ' . $dateFin->format('d/m/Y'),
                        'days' => $weekTimesheets->count(),
                        'heures_normales' => $heuresNormales,
                        'heures_supp' => $heuresSupp,
                        'total' => $totalSemaine,
                        'zones' => $zones,
                        'panier_oui' => $panierOui,
                    ];
                }

                $summary[] = [
                    'user' => $user,
                    'weeks' => $userWeeks,
                ];
            }

            $pdf = Pdf::loadView('timesheets.export-pdf', [
                'summary' => $summary,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
            ])->setPaper('a4', 'portrait')
              ->setOptions([
                  'defaultFont' => 'DejaVu Sans',
                  'isHtml5ParserEnabled' => true,
                  'isRemoteEnabled' => true,
              ]);

            $filenamePdf = 'timesheets_global_' . now()->format('Ymd_His') . '.pdf';
            return $pdf->download($filenamePdf);
        }

        $filename = 'timesheets_global_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($timesheets) {
            $output = fopen('php://output', 'w');
            fwrite($output, "\xEF\xBB\xBF");

            fputcsv($output, [
                'Employe',
                'Email',
                'Chantier',
                'Date',
                'Jour',
                'Heure debut',
                'Heure fin',
                'Pause',
                'Panier',
                'Heures supp',
                'Total heures',
            ], ';');

            foreach ($timesheets as $t) {
                fputcsv($output, [
                    $t->user->nom ?? 'N/A',
                    $t->user->email ?? 'N/A',
                    $t->chantier->nom ?? 'N/A',
                    $t->date_formatee,
                    $t->jour,
                    $t->heure_debut_formatee,
                    $t->heure_fin_formatee,
                    $t->pause ? 'Oui' : 'Non',
                    $t->panier ? 'Oui' : 'Non',
                    $t->heures_supp,
                    $t->total_heures,
                ], ';');
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }
}
