@csrf
{!! Former::text('address[firstname]')->label("Nom")->required() !!}
{!! Former::text('address[lastname]')->label("Prénom")->required() !!}
{!! Former::select('address[country_id]')->label('Pays')->options($countriesSelect)->required() !!}
{!! Former::text('address[street]')->label("Adresse")->required() !!}
{!! Former::text('address[city]')->label("Ville")->required() !!}
{!! Former::text('address[state]')->label("State")->required() !!}
{!! Former::text('address[zip_code]')->label("Code postal")->required() !!}
{!! Former::text('address[other]')->label("Autres informations") !!}




