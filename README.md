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
```
- Article
    - id
    - title
    - body
    - author_id
    - timestamps (created_at, updated_at)
    - softdeletes (deleted_at)

- User
    - id
    - username
    - password
    - user_type (1 => Admin, 2 => Author)
    - timestamps

- User Detail (Author & Admin Profile)
    - id
    - user_id
    - firstname
    - lastname
    - timestamps
```

##### Logic

##### Phase 1
1. User can login (admin/author)
2. An admin can do CRUD (Create/Read/Update/Delete) with authors
3. An author can login
4. An author can do CRUD with articles
5. Guest can view articles without logging in

##### Phase 2 (Authors)
1. User can register as author (`user_type` = 2)
2. Can CRUD articles
3. Can view/edit profile

##### Phase 3 (Regular users)
1. Regular user can create (register) an account using email (`user_type` = 3)
2. Can edit/view profile
3. Can **Save to bookmark** articles
4. Can **Vote up**/**Vote down** articles
5. Can do **comments** on articles
