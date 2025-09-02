# Mini Issue Tracker (Laravel)

Mini-tracker for projects and issues, with tags and comments.
Uses **Blade + AJAX** for some reload-free interactions and takes care of N+1 with **eager loading**.

## What's included

- **Projects**
- List / Create / Edit / Delete
- Project **show** with listing of issues of that project
- **Issues**
- Listing with **filters** (status, priority, tag)
- **Search with debounce (AJAX)** while writing
- Create / Edit / Delete
- Issue **show**
- **Tags**
- Create / List / Delete
- **Attach/Detach to an issue (AJAX, no reload)**
- **Comments**
- Loading of comments to an issue **with AJAX** (paginated)
- **Add comment with AJAX** (prepend + form cleaning)
- **Other**
- **Eager loading** to avoid N+1
- **Migrations, factories, seeders** for demo data
- **Simple **Pagination** with clean style in Blade




---

## Setup

1. **Installation** 
```bash
git clone
cd testTask
composer install
cp .env.example .env
php artisan key: generate
php artisan migrate --seed
php artisan serve
