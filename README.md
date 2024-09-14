## laravel_vue_websocket_forum

### install:
- git [clone](https://github.com/FlatronSamatron/laravel_vue_websocket_forum.git) 
- composer install
- npm install || npm install --legacy-peer-deps
- artisan migrate
- php artisan storage:link
- npm run serve


### Models => `php artisan make:model Section -m`:
- [Section.php](app%2FModels%2FSection.php)
- [Branch.php](app%2FModels%2FBranch.php)
- [Theme.php](app%2FModels%2FTheme.php)
- [Message.php](app%2FModels%2FMessage.php)
- [Complaint.php](app%2FModels%2FComplaint.php)
- [Image.php](app%2FModels%2FImage.php)
- [Role.php](app%2FModels%2FRole.php)

### Controllers => `php artisan make:controller SectionController -r -m Section`:
- [SectionController.php](app%2FHttp%2FControllers%2FSectionController.php)
- [BranchController.php](app%2FHttp%2FControllers%2FBranchController.php)
- [ThemeController.php](app%2FHttp%2FControllers%2FThemeController.php)
- [MessageController.php](app%2FHttp%2FControllers%2FMessageController.php)
- [UserController.php](app%2FHttp%2FControllers%2FUserController.php)
- [ImageController.php](app%2FHttp%2FControllers%2FImageController.php)
- Admin:
  - [MainController.php](app%2FHttp%2FControllers%2FAdmin%2FMainController.php)

### Requests => `php artisan make:request Section/StoreRequest`:
- Section:
  - [StoreRequest.php](app%2FHttp%2FRequests%2FSection%2FStoreRequest.php)
  - [UpdateRequest.php](app%2FHttp%2FRequests%2FSection%2FUpdateRequest.php)
- Branch:
  - [StoreRequest.php](app%2FHttp%2FRequests%2FBranch%2FStoreRequest.php)
  - [UpdateRequest.php](app%2FHttp%2FRequests%2FBranch%2FUpdateRequest.php)
- Theme:
  - [StoreRequest.php](app%2FHttp%2FRequests%2FTheme%2FStoreRequest.php)
  - [UpdateRequest.php](app%2FHttp%2FRequests%2FTheme%2FUpdateRequest.php)
- Message:
  - [StoreRequest.php](app%2FHttp%2FRequests%2FMessage%2FStoreRequest.php)
  - [UpdateRequest.php](app%2FHttp%2FRequests%2FMessage%2FUpdateRequest.php)
- Complaint:
  - [StoreRequest.php](app%2FHttp%2FRequests%2FComplaint%2FStoreRequest.php)
- Image:
  - [StoreRequest.php](app%2FHttp%2FRequests%2FImage%2FStoreRequest.php)

### Resources => `php artisan make:resource Section/SectionResource`:
- Section:
  - [SectionResource.php](app%2FHttp%2FResources%2FSection%2FSectionResource.php)
  - [SectionWithBranchesResource.php](app%2FHttp%2FResources%2FSection%2FSectionWithBranchesResource.php)
- Branch:
  - [BranchResource.php](app%2FHttp%2FResources%2FBranch%2FBranchResource.php)
  - [BranchWithChildrenResource.php](app%2FHttp%2FResources%2FBranch%2FBranchWithChildrenResource.php)
- Theme:
  - [ThemeResource.php](app%2FHttp%2FResources%2FTheme%2FThemeResource.php)
- Message:
  - [MessageResource.php](app%2FHttp%2FResources%2FMessage%2FMessageResource.php)
- User:
  - [UserResource.php](app%2FHttp%2FResources%2FUser%2FUserResource.php)
- Image:
  - [ImageResource.php](app%2FHttp%2FResources%2FImage%2FImageResource.php)
- Complaint:
  - [ComplaintResource.php](app%2FHttp%2FResources%2FComplaint%2FComplaintResource.php)

### Migrations:
- [2024_09_09_081343_create_sections_table.php](database%2Fmigrations%2F2024_09_09_081343_create_sections_table.php)
- [2024_09_09_124903_create_branches_table.php](database%2Fmigrations%2F2024_09_09_124903_create_branches_table.php)
- [2024_09_10_084954_create_themes_table.php](database%2Fmigrations%2F2024_09_10_084954_create_themes_table.php)
- [2024_09_10_135632_create_messages_table.php](database%2Fmigrations%2F2024_09_10_135632_create_messages_table.php)
- [2024_09_12_105752_create_message_user_likes_table.php](database%2Fmigrations%2F2024_09_12_105752_create_message_user_likes_table.php)
- [2024_09_12_165646_create_message_user_answers_table.php](database%2Fmigrations%2F2024_09_12_165646_create_message_user_answers_table.php)
- [2024_09_12_192759_create_complaints_table.php](database%2Fmigrations%2F2024_09_12_192759_create_complaints_table.php)
- [2024_09_13_075423_create_images_table.php](database%2Fmigrations%2F2024_09_13_075423_create_images_table.php)
- [2024_09_14_105559_create_roles_table.php](database%2Fmigrations%2F2024_09_14_105559_create_roles_table.php)
- [2024_09_14_105718_create_role_user_table.php](database%2Fmigrations%2F2024_09_14_105718_create_role_user_table.php)

webstorm:
- recent files => ctrl+e

packages:
- composer require intervention/image