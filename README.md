

# Over Engineered CRUD Using TALL Stack
## Stack Used
- **[TailwindCSS](https://tailwindcss.com/)**
- **[AlpineJS](https://alpinejs.dev/)**
- **[Livewire](https://laravel-livewire.com/)**
- **[Laravel](https://laravel.com/)**

## Installation
1. Clone this repository 
    > git clone https://github.com/anggarapp/tall-crud-over-engineered.git
2. Install dependency
    > composer install

    > npm install
3. Configure `.env` file or copy from example
    > cp .env.example .env
4. Generate App Key
    > php artisan key:generate
5. Migrate database
    > php artisan migrate:fresh
6. Create link for storage
    > php artisan storage:link
7. Ready to run
    > php artisan serve

    > npm run dev
    
## CRUD Details
- ### **Posts Page**
    - Create Post contain **title**, **content**, with multiple **tags** and **images**.
    - List of Posts **title**, **content** with pagination.
    - Search Posts by **title** or **content**.
    - Update **title**, **content**, **tags** on selected Post
    - Show and Update (Delete & Remove) related **images** of selected Post
    - Delete Post without remove related **tags** and **images**.
- ### **Images Page**
    - Create individual Image contain **name**, **image**, **tags**
    - List of all Images contain **image** and **name**
    - Update **name**, **image**, **tags** of individual Image
    - Delete Image
- ### **Tags Page**
    - Create individual Tags
    - List of all Tags and show related Posts and Images
    - Update Tag **name**.
    - Delete Tag and Remove it relation to any Posts or Images 

## Model Relations
- Many to Many
    - posts >-< images
- Many to Many Polymorphism
    - tags >-< images|posts


