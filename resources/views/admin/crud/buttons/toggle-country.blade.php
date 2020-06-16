@if ($crud->hasAccess('update'))
    <a href="{{ url($crud->route.'/'.$entry->getKey().'/toggle-country') }} " class="btn btn-xs btn-default">
        @if($entry->disabled) Activer @else Désactiver @endif
    </a>
@endif
