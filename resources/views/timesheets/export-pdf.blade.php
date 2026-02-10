<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Récapitulatif Fiches d'Heures</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #111827; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; font-size: 11px; }
        th, td { border: 1px solid #e5e7eb; padding: 6px 8px; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; }
        h1 { font-size: 16px; margin: 0 0 6px; }
        h2 { font-size: 13px; margin: 14px 0 6px; }
        .meta { color: #6b7280; font-size: 11px; margin-bottom: 12px; }
        .section { margin-bottom: 12px; }
        .totals-row td { font-weight: 700; background: #f9fafb; }
        .summary-table th { text-transform: uppercase; font-size: 10px; letter-spacing: 0.04em; }
        .user-table thead th { background: #eef2ff; }
        .user-table tr:nth-child(even) td { background: #f9fafb; }
        .badge { display: inline-block; padding: 2px 6px; border-radius: 999px; font-size: 10px; font-weight: 700; }
        .badge-ok { background: #dcfce7; color: #166534; }
        .badge-no { background: #fee2e2; color: #991b1b; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    @php
        $logoPath = public_path('logo.png');
        $logoSrc = null;
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logoSrc = 'data:image/png;base64,' . $logoData;
        }
    @endphp

    <table style="margin-bottom: 8px; border: 0;">
        <tr>
            <td style="border:0; width:70px;">
                @if($logoSrc)
                    <img src="{{ $logoSrc }}" alt="Logo" style="height:90px;">
                @endif
            </td>
            <td style="border:0;">
                <h1>Szlazak Gestion - Récapitulatif des fiches d'heures</h1>
                <div class="meta">Édité le {{ now()->format('d/m/Y H:i') }} | Période : .......................... au ..............................</div>
            </td>
        </tr>
    </table>

    @if(empty($summary))
        <table>
            <tr><td>Aucune donnée.</td></tr>
        </table>
    @else
        @php
            $totalHeuresTravaillees = 0;
            $totalHeuresSupp = 0;
            $totalPaniers = 0;
            foreach ($summary as $item) {
                foreach ($item['weeks'] as $week) {
                    $totalHeuresTravaillees += $week['total'];
                    $totalHeuresSupp += $week['heures_supp'];
                    $totalPaniers += !empty($week['panier_oui']) ? 1 : 0;
                }
            }
        @endphp

        <div class="section">
            <table class="summary-table">
                <thead>
                    <tr>
                        <th>Total personnes</th>
                        <th>Total heures</th>
                        <th>Total heures supp (35h)</th>
                        <th>Total paniers</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ count($summary) }}</td>
                        <td>{{ $totalHeuresTravaillees }}h</td>
                        <td>{{ $totalHeuresSupp }}h</td>
                        <td>{{ $totalPaniers }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @foreach($summary as $item)
            <h2>{{ $item['user']->nom ?? 'Utilisateur' }} ({{ $item['user']->role->nom ?? 'N/A' }})</h2>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Semaine</th>
                        <th>Période</th>
                        <th>Jours</th>
                        <th>Zone</th>
                        <th>Panier</th>
                        <th class="text-right">Heures</th>
                        <th class="text-right">Heures supp</th>
                        <th class="text-right">Total heures</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalNormalesPersonne = 0;
                        $totalSuppPersonne = 0;
                        $totalPersonne = 0;
                    @endphp
                    @foreach($item['weeks'] as $week)
                        @php
                            $totalNormalesPersonne += $week['heures_normales'];
                            $totalSuppPersonne += $week['heures_supp'];
                            $totalPersonne += $week['total'];
                            $zones = collect($week['zones'] ?? [])->filter()->unique()->sort()->values();
                            $zonesLabel = $zones->isEmpty() ? '-' : $zones->map(fn($z) => 'Zone ' . $z)->implode(', ');
                            $panierLabel = !empty($week['panier_oui']) ? 'Oui' : 'Non';
                        @endphp
                        <tr>
                            <td>S{{ $week['week_number'] }}</td>
                            <td>{{ $week['period'] }}</td>
                            <td>{{ $week['days'] }}</td>
                            <td>{{ $zonesLabel }}</td>
                            <td>
                                @if($panierLabel === 'Oui')
                                    <span class="badge badge-ok">Oui</span>
                                @else
                                    <span class="badge badge-no">Non</span>
                                @endif
                            </td>
                            <td class="text-right">{{ $week['heures_normales'] }}h</td>
                            <td class="text-right">{{ $week['heures_supp'] }}h</td>
                            <td class="text-right">{{ $week['total'] }}h</td>
                        </tr>
                    @endforeach
                    <tr class="totals-row">
                        <td colspan="5"><strong>Total {{ $item['user']->nom ?? '' }}</strong></td>
                        <td class="text-right"><strong>{{ $totalNormalesPersonne }}h</strong></td>
                        <td class="text-right"><strong>{{ $totalSuppPersonne }}h</strong></td>
                        <td class="text-right"><strong>{{ $totalPersonne }}h</strong></td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    @endif
</body>
</html>
