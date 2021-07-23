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
                <div class="card-header {{ $order->orderStatus->isProcessed() ?  "bg-warning" : "bg-primary" }}">
                    @if($order->orderStatus->isProcessed())
                        <span class="badge badge-pill badge-danger"><i class="fas fa-exclamation-circle"></i> Attention </span> Commande en attente d'envois
                    @endif
                </div>
                <div class="card-body">
                        <h2 class="card-title">Informations</h2>
                        <div class="ml-3 mb-4">
                            <h5 class="card-title pt-2">Commande <span class="badge badge-primary badge-pill">n° {{ $order->id }}</span></h5>
                            <h5 class="card-title pt-2">Passée le <b>{{ $order->created_at->format('Y/m/d à H:i') }}</b></h5>
                            <h5 class="card-title pt-2">Prix total de la commande
                                <span class="badge badge-primary badge-pill"><b>{{ loja_price_readable($order->amount) }} € </b></span>
                            </h5>
                        </div>

                    <h2 class="card-title">Produits commandés</h2>

                    <div class="ml-3">
                        @foreach($order->orderProducts as $product)
                        <h5 class="card-title pt-2">{{ $product->product->name }}</h5>
                        <ul class="list-group col-4">
                            <li class="list-group-item">Quantité: <span class="badge badge-primary badge-pill">{{$product->quantity}}</span></li>
                            <li class="list-group-item">{!!  $product->readable_attribute_value_bold !!}</li>
                            <li class="list-group-item">Prix:
                                <span class="badge badge-primary badge-pill"><b>{{ $product->readable_price_qty }} €</b></span>
                            </li>
                        </ul>
                        @endforeach
                        <br/>
                    </div>

                    <h2 class="card-title">Informations du client</h2>
                    @php $user = $order->user; @endphp
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nom & Prénom: <b>{{ $user->lastname." ".$user->firstname }}</b></li>
                        <li class="list-group-item">Téléphone: <b>{{ $user->address()->phone }}</b></li>
                        <li class="list-group-item">Adresse: <b>{{ $user->address()->readable}}</b></li>
                        <li class="list-group-item">Pays: <b>{{ $user->address()->country->name }}</b></li>
                        <li class="list-group-item">Informations supplémentaire: <b>{{ $user->address()->readable_other }}</b></li>
                    </ul>

                    <br/><br/>
                    @if($order->orderStatus->isProcessed())
                    <form method="POST" action="{{ route('admin.confirm.order') }}">
                        @csrf
                        <input type="hidden" name="order" value="{{ $order->id }}">
                        <label for="basic-url" class="form-label">Lien pour suivre la commande*</label>
                        <div class="input-group mb-3">
                            <input name="delivery_tracking" type="url" class="form-control"  pattern="https://.*" placeholder="https://example.com" required>
                        </div>


                        <div class="d-grid gap-2 d-md-flex justify-content-md-center btn-toolbar">

                            <button type="submit" class="btn btn-success m-2" type="button">Confirmer l'envois</button>
                            <a href="javascript:history.back()" class="btn btn-primary m-2" type="button">Retour</a>
                        </div>
                    </form>
                    @endif

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
