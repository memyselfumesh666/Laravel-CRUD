# Laravel-CRUD

Laravel CRUD refers to implementing Create, Read, Update, and Delete operations using Laravel’s MVC architecture and Eloquent ORM. These operations form the backbone of most web applications, allowing you to manage database records efficiently.

🛠️ Laravel CRUD Workflow Overview

Here’s a step-by-step breakdown of how CRUD works in Laravel:

1. Create a Laravel Project
   
composer create-project laravel/laravel crudApp

2. Set Up Database Configuration
   
Edit .env file:

DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

3. Create a Migration & Model

php artisan make:model Product -m

In the migration file:

Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('details');
    $table->timestamps();
});

Run migration:

php artisan migrate

4. Create Controller

php artisan make:controller ProductController --resource

This generates methods for index, create, store, show, edit, update, and destroy.

5. Define Routes

In routes/web.php:

Route::resource('products', ProductController::class);

6. Create Blade Views
   
Create views like index.blade.php, create.blade.php, edit.blade.php, etc., inside resources/views/products.

7. Implement Controller Logic
   
Example for storing a product:


public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'details' => 'required',
    ]);

    Product::create($request->all());
    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}

