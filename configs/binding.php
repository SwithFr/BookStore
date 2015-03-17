<?php
 return [
    Models\Interfaces\BooksRepositoryInterface::class => Models\Book::class,
    Models\Interfaces\AuthorsRepositoryInterface::class => Models\Author::class,
    Models\Interfaces\EditorsRepositoryInterface::class => Models\Editor::class,
     Models\Interfaces\GenresRepositoryInterface::class => Models\Genre::class
 ];