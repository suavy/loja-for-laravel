@extends(backpack_view('blank'))

@php
    $defaultBreadcrumbs = [
      trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
      $crud->entity_name_plural => url($crud->route),
      trans('backpack::crud.preview') => false,
    ];

    // if breadcrumbs aren't defined in the CrudController, use the default breadcrumbs
    $breadcrumbs = $breadcrumbs ?? $defaultBreadcrumbs;


    $order = \Suavy\LojaForLaravel\Models\Order::query()->findOrFail(request('id'));


@endphp

@section('header')
    <section class="container-fluid d-print-none">
        <a href="javascript: window.print();" class="btn float-right"><i class="la la-print"></i></a>
        <h2>
            <span class="text-capitalize">{!! $crud->getHeading() ?? $crud->entity_name_plural !!}</span>
            <small>{!! $crud->getSubheading() ?? mb_ucfirst(trans('backpack::crud.preview')).' '.$crud->entity_name !!}.</small>
            @if ($crud->hasAccess('list'))
                <small class=""><a href="{{ url($crud->route) }}" class="font-sm"><i class="la la-angle-double-left"></i> {{ trans('backpack::crud.back_to_all') }} <span>{{ $crud->entity_name_plural }}</span></a></small>
            @endif
        </h2>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    <b>Commande n° {{ $order->id }}</b>
                </div>
                <div class="card-body">
                    {{-- Order data--}}
                    <h2 class="card-title">La commande</h2>
                        <ul class="list-group">
                            <li class="list-group-item list-group-item-primary">
                                <div class="row">
                                    <dt class="col-sm-1">Quantité</dt>
                                    <dt class="col-sm-3">Produit</dt>
                                    <dt class="col-sm-8">Attributes</dt>
                                </div>
                            </li>
                            @foreach($order->orderProducts as $product)
                                <li class="list-group-item">
                                    <div class="row">
                                        <dd class="col-sm-1">{{$product->quantity}}</dd>
                                        <dd class="col-sm-3">{{ $product->product->name }}</dd>
                                        <dd class="col-sm-8">{{ $product->readable_attribute_value }}</dd>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    <br/>
                    <p><b>Prix total de la commande :</b> {{ $order->amount }}</p>

                    {{-- User data--}}
                    <h2 class="card-title">Le client</h2>
                    @php $user = $order->user; @endphp
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <dt class="col-sm-3">Nom & Prénom</dt>
                                <dd class="col-sm-9">{{ $user->lastname." ".$user->firstname }}</dd>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <dt class="col-sm-3">Téléphone</dt>
                                <dd class="col-sm-9">{{ optional($user->address())->phone }}</dd>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <dt class="col-sm-3">Adresse</dt>
                                <dd class="col-sm-9">{{ optional($user->address())->readable}}</dd>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <dt class="col-sm-3">Pays</dt>
                                <dd class="col-sm-9">{{ optional($user->address())->country->name }}</dd>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <dt class="col-sm-3">Informations supplémentaire</dt>
                                <dd class="col-sm-9">{{ optional($user->address())->readable_other }}</dd>
                            </div>
                        </li>
                    </ul>
                    <br/>
                    {{-- Follow link--}}
                    <h2 class="card-title">Gestion de la commande</h2>
                    <form method="POST" action="{{ route('admin.confirm.order') }}">
                        @csrf
                        <input type="hidden" name="order" value="{{ $order->id }}">
                        <label for="basic-url" class="form-label">Lien de suivi*</label>
                        <div class="input-group mb-3">
                            <input name="delivery_tracking" type="url" class="form-control"  pattern="https://.*" placeholder="https://example.com" required>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success me-md-2" type="button">Confirmer l'envoie</button>
                            <a href="javascript:history.back()" class="btn btn-default"><span class="la la-ban"></span> &nbsp;Retour</a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection


@section('after_styles')
    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css').'?v='.config('backpack.base.cachebusting_string') }}">
    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/show.css').'?v='.config('backpack.base.cachebusting_string') }}">
@endsection

@section('after_scripts')
    <script src="{{ asset('packages/backpack/crud/js/crud.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
    <script src="{{ asset('packages/backpack/crud/js/show.js').'?v='.config('backpack.base.cachebusting_string') }}"></script>
@endsection
