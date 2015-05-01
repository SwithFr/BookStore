<?php

return $routes = [
    # Routes pages
    'default'         => 'index/page',
    'searchAll'       => 'searchAll/page',

    # Routes auteurs
    'A_index'         => 'index/author',
    'A_add'           => 'add/author',
    'A_view'          => 'view/author',
    'A_search'        => 'search/author',

    # Routes éditeurs
    'E_index'         => 'index/editor',
    'E_add'           => 'add/editor',
    'E_search'        => 'search/editor',
    'E_view'          => 'view/editor',

    # Routes genres
    'G_index'         => 'index/genre',

    # Routes livres
    'B_index'         => 'index/book',
    'B_populars'      => 'populars/book',
    'B_add'           => 'add/book',
    'B_edit'          => 'edit/book',
    'B_delete'        => 'delete/book',
    'B_godelete'      => 'goDelete/book',
    'B_view'          => 'view/book',

    # Routes bibliothèques
    'L_index'         => 'index/librarie',
    'L_add'           => 'add/librarie',
    'L_view'          => 'view/librarie',

    # Routes utilisateurs
    'U_check'         => 'check/user',
    'U_disconnect'    => 'disconnect/user',
    'U_register'      => 'register/user',
    'U_account'       => 'account/user',

    # Routes emplacements
    'Lo_add'          => 'add/location',

    # Routes erreurs
    'Er_unauthorized' => 'unauthorized/error',
    'Er_notLogged'    => 'notLogged/error',
    'Er_missingParams'=> 'missingParams/error'
];