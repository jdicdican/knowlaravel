# knowlaravel
Laravel project for experiments


This will serve as repo for all experiments knowing how to code laravel.

#### Setup

1. Create `.env` file to your root directory
2. Copy content from `.env.example` to newly created `.env` (make sure you make necessary changes on `.env` depending on your local setup)
3. Create database on your local (name it anything you want, initial name: `knowlaravel_db`)
4. Run `composer install`
5. Run `php artisan migrate`
6. Run `php artisan serve` (then access to browser)

If nothing goes wrong, you're all set.



#### Code Setup (The Blog)

##### Database schema

- Article
    - id
    - title
    - body
    - author_id
    - timestamps (created_at, updated_at)
    - softdeletes (deleted_at)

- Author
    - id
    - firstname
    - lastname
    - timestamps (created_at, updated_at)
    - softdeletes (deleted_at)

- User
    - id
    - username
    - password
    - user_type (1 => Admin, 2 => Author)

##### Logic

1. User can login (admin/author)
2. An admin can do CRUD (Create/Read/Update/Delete) with authors
3. An author can login
4. An author can do CRUD with articles
5. Guest can view articles without logging in
