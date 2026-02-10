@php
    $toastItems = [];
    if (session('success')) {
        $toastItems[] = ['type' => 'success', 'icon' => 'check-circle', 'title' => 'Succès', 'message' => session('success')];
    }
    if (session('error')) {
        $toastItems[] = ['type' => 'danger', 'icon' => 'triangle-exclamation', 'title' => 'Erreur', 'message' => session('error')];
    }
    if (session('warning')) {
        $toastItems[] = ['type' => 'warning', 'icon' => 'triangle-exclamation', 'title' => 'Attention', 'message' => session('warning')];
    }
    if (session('info')) {
        $toastItems[] = ['type' => 'info', 'icon' => 'circle-info', 'title' => 'Info', 'message' => session('info')];
    }
    if (session('status')) {
        $toastItems[] = ['type' => 'info', 'icon' => 'circle-info', 'title' => 'Info', 'message' => session('status')];
    }
    if (isset($errors) && $errors->any()) {
        $message = $errors->first();
        if ($errors->count() > 1) {
            $message .= ' (+ ' . ($errors->count() - 1) . ' autre' . ($errors->count() > 2 ? 's' : '') . ')';
        }
        $toastItems[] = ['type' => 'danger', 'icon' => 'triangle-exclamation', 'title' => 'Validation', 'message' => $message];
    }
@endphp

@if(count($toastItems) > 0)
    <div class="toast-container position-fixed top-0 end-0 p-3 app-toast-container">
        @foreach($toastItems as $toast)
            <div class="toast app-toast text-bg-{{ $toast['type'] }} border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="4500">
                <div class="toast-header">
                    <i class="fas fa-{{ $toast['icon'] }} me-2 text-{{ $toast['type'] }}"></i>
                    <strong class="me-auto">{{ $toast['title'] }}</strong>
                    <small class="text-muted">Maintenant</small>
                    <button type="button" class="btn-close ms-2 mb-1" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ $toast['message'] }}
                </div>
            </div>
        @endforeach
    </div>
@endif
