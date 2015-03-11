<?php

return $routes = [
    'default'         => 'index/book',
    # Routes auteurs
    'A_index'         => 'index/author',
    'A_add'           => 'add/author',

    # Routes éditeurs
    'E_index'         => 'index/editor',
    'E_add'           => 'add/editor',

    # Routes genres
    'G_index'         => 'index/genre',

    # Routes livres
    'B_populars'      => 'populars/book',
    'B_add'           => 'add/book',
    'B_edit'          => 'edit/book',
    'B_view'          => 'view/book',

    # Routes bibliothèques
    'L_index'         => 'index/librarie',
    'L_add'           => 'add/librarie',

    # Routes utilisateurs
    'U_check'         => 'check/user',
    'U_disconnect'    => 'disconnect/user',
    'U_register'      => 'register/user',
    'U_account'       => 'account/user',

    # Routes emplacements
    'Lo_add'          => 'add/location',

    # Routes erreurs
    'Er_unauthorized' => 'unauthorized/error',
    'Er_notLogged'    => 'notLogged/error'
];