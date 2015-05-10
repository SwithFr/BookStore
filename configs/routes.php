<?php

return $routes = [
    # Routes pages
    'default'         => 'index/page',
    'searchAll'       => 'searchAll/page',

    # Routes authors
    'A_index'         => 'index/author',
    'A_view'          => 'view/author',
    'A_search'        => 'search/author',

    # Routes editors
    'E_index'         => 'index/editor',
    'E_search'        => 'search/editor',
    'E_view'          => 'view/editor',

    # Routes genres
    'G_index'         => 'index/genre',

    # Routes books
    'B_index'         => 'index/book',
    'B_populars'      => 'populars/book',
    'B_view'          => 'view/book',

    # Routes libraries
    'L_index'         => 'index/librarie',
    'L_view'          => 'view/librarie',

    # Routes users
    'U_check'         => 'check/user',
    'U_disconnect'    => 'disconnect/user',
    'U_register'      => 'register/user',

    # Routes errors
    'Er_unauthorized' => 'unauthorized/error',
    'Er_notLogged'    => 'notLogged/error',
    'Er_missingParams'=> 'missingParams/error',

    # Need connexion
    'needConnexion'   => [

        # Users
        'U_account' => 'account/user',

        # Books
        'B_add'           => 'add/book',
        'B_edit'          => 'edit/book',
        'B_delete'        => 'delete/book',
        'B_godelete'      => 'goDelete/book',
        'B_voteU'         => 'voteUp/book',
        'B_voteD'         => 'voteDown/book',

        # Authors
        'A_add'           => 'add/author',
        'A_edit'          => 'edit/author',
        'A_votU'          => 'voteUp/author',
        'A_voteD'         => 'voteDown/author',

        # Editors
        'E_add'           => 'add/editor',

        # Libray
        'L_add'           => 'add/librarie',

        # Locations
        'Lo_add'          => 'add/location',
    ]
];