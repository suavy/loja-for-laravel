<!-- Loja (backpack) sidebar -->
<li class="nav-title">LOJA</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('product') }}"><i class="nav-icon fad fa-shopping-bag"></i> Produits</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('category') }}"><i class="nav-icon fad fa-sitemap"></i> Catégories</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('collection') }}"><i class="nav-icon fad fa-hashtag"></i> Collections</a></li>
<li class='nav-item nav-dropdown'>
    <a class='nav-link nav-dropdown-toggle' href='#'><i class='nav-icon fad fa-tags'></i> Attributs</a>
    <ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('attribute') }}'><i class='nav-icon fad fa-tag'></i> Attributs</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('attribute-value') }}'><i class='nav-icon fad fa-sort-numeric-down-alt'></i> Valeurs d'attribut</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('attribute-set') }}'><i class='nav-icon fad fa-th-list'></i> Sets d'attributs</a></li>

    </ul>
</li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('tax') }}"><i class="nav-icon fad fa-percentage"></i> Taxes</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('country-delivery') }}"><i class="nav-icon fas fa-globe-europe"></i> Pays de livraison</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('setting') }}"><i class="nav-icon fad fa-cogs"></i> Réglages</a></li>

