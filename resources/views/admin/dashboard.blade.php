@extends(backpack_view('blank'))



@php
    use Backpack\CRUD\app\Library\Widget;

    $orderProcessed = \Suavy\LojaForLaravel\Models\Order::query()->processed()->count();

    if($orderProcessed > 0){
        $widgets['before_content'][] = [
        'type'        => 'progress',
        'class'       => 'card text-white bg-warning mb-2',
        'value'       => $orderProcessed,
        'description' => 'Nouvelles commandes',
        ];
    }


    $totalUser = \App\Models\User::query()->count();
    $widgets['before_content'][] = [
        'type'        => 'progress',
        'class'       => 'card text-white bg-primary mb-2',
        'value'       => $totalUser,
        'description' => 'Utilisateurs inscrits',
    ];

    $orders = \Suavy\LojaForLaravel\Models\Order::query()->count();


    $widgets['before_content'][] = [
    'type'        => 'progress',
    'class'       => 'card text-white bg-primary mb-2',
    'value'       => $orders,
    'description' => 'Total des commandes',
    ];


@endphp

@section('content')
@endsection
