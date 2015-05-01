<?php
return [
    Models\Interfaces\BooksRepositoryInterface::class => Models\Book::class,
    Models\Interfaces\AuthorsRepositoryInterface::class => Models\Author::class,
    Models\Interfaces\EditorsRepositoryInterface::class => Models\Editor::class,
    Models\Interfaces\GenresRepositoryInterface::class => Models\Genre::class,
    Models\Interfaces\UsersRepositoryInterface::class => Models\User::class,
    Models\Interfaces\LibrariesRepositoryInterface::class => Models\Librarie::class,
    Models\Interfaces\LocationsRepositoryInterface::class => Models\Location::class
];