## laravel_vue_websocket_forum

### install:
- git [clone](https://github.com/FlatronSamatron/laravel_vue_websocket_forum.git) 
- composer install
- npm install
- artisan migrate


### Model => `php artisan make:model Section -m`:
- [Section.php](app%2FModels%2FSection.php)

### Controller => `php artisan make:controller SectionController -r -m Section`:
- [SectionController.php](app%2FHttp%2FControllers%2FSectionController.php)

### Request => `php artisan make:request Section/StoreRequest`:
- Section:
  - [StoreRequest.php](app%2FHttp%2FRequests%2FSection%2FStoreRequest.php)
  - [UpdateRequest.php](app%2FHttp%2FRequests%2FSection%2FUpdateRequest.php)

### Resource => `php artisan make:resource Section/SectionResource`:
- Section:
  - [SectionResource.php](app%2FHttp%2FResources%2FSection%2FSectionResource.php)