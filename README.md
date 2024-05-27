<p>   
    <img src="https://github.com/itsjavierdev/bakery-admin/assets/156542069/07c18365-f44e-48f7-8c9a-8ed801165ed2" alt="logo" align="left" width="80" height="auto" ></img>
</p>

# System for Bakery San Xavier

This project, an Bakery System, provides a robust platform for the bakery San Xaview to streamline their operations and enable customers to conveniently place orders online. It features a user-friendly interface for product browsing, a secure shopping cart system, and a seamless checkout process. The application is designed to enhance the efficiency of bakery businesses by digitizing the ordering process and providing a smooth online experience for customers. And a admin part for the staff and the bakery owner to administrate the content of the customer part content, and receive and create orders, and see the analytics products, sales and others functions. Developers can explore the codebase to understand the implementation details.

## 💻 Technologies:

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white) ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) ![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white) ![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)

## 👩🏻‍💻 Installation:

First you have to configure your laravel environment

Then clone this repository with

```
git clone git@github.com:itsjavierdev/bakery-system.git
```

### Run all this command lines in the laragon terminal

Install composer and node module

```
composer install
npm i
```

Create .env and generate encryption key

```
cp .env.example .env
php artisan key:generate
```

Clean cache in framework

```
composer dump-autoload
```

Create symbolic link from public folder to storage folder

```
php artisan storage:link
```

Run the migrations, to set the database and seeders

```
php artisan migrate --seed
```

## 🏃🏻‍♂️ Run the aplication:

#### Run these two command line in different terminal

For run the styles

```
npm run dev
```

For run the server

```
php artisan serve
```

## 🔑 First Authenticate:

#### Email

`test@example.com`

#### Password

`password`

## 📁 File Structure guide

#### Controllers

I use livewire so, the controllers just was used for static routes controller with and without params

```php
└─  app
   └─  Http
      └─ Controllers
         ├─ Controller.php
         └─ UserProfileController.php  //controller for set the profile user account
```

#### Livewire components

Components where separate in folders for each CRUD or HU

Customer and admin parts are separates in different folders

Each module in admin part have his own folder  (ManagementAdmin, ManagementCustomers, Paramenters, Transactions, Reports)

```php
└─ app
   └─ Livewire
      ├─ Forms  //for separate validation rules in livewire components with more than one
      │  └─ Admin //are separate in same livewire folder sections
      │      └─ Staff
      │          └─ ...
      ├─ Others  //dont have and specifict section
      └─ Admin  
         └─ ManagementAdmin  
             ├─ Profile
             │  ├─ DeleteUserForm.php
             │  ├─ LogoutOtherBrowserSessionsForm.php
             │  └─ ...
             ├─ Roles //Almost every section of the app, has a crud with that methods
             │  ├─ Create.php
             │  └─ Delete.php
             │  └─ Read.php
             │  └─ Update.php
             │  └─ Detail.php
             │  └─ ...
             ├─ Dashboard.  //some folders like dashboard have another folders for separate more (in this case separate teh different charts for different proposals)
             │  └─ Sales.php
             │  └─ Products.php
             │  └─ ...
             └─ NavigationMenu.  //all the sidebar nav-links
```

#### Reports

In this folder are the excel exports for reports

```php
└─ Exports
   └─ Sales //reports by module
      ├─ AllSalesExport 
      └─ ...
```

#### Views

```php
└─ resources
   └─ views
      ├─ components  //all components blade (jestream default and custom)
      ├─ exports  //in this folder are the pdf exports for reports and proofs of payments
      ├─ layouts  //layout for all app
      ├─ livewire  //dinamic livewire components /(used in pages, or with a layout)
      └─ pages  //all static views
```

#### Components

The components were separate in atoms, molecules, organisms, templates, and layout

```php
├─ components
    └─ admin
        ├─ atoms  //all basics components, generally a html tag with styles and/or functionality
        │  ├─ inputs  //all inputs components (text, checkbox, date, label, error)
        │  ├─ table  //all table tags html components (th, tr, table)
        │  │  ├─ columns  //columns customize for the table (where go a single row and column data)
        │  │  └─ ...
        │  └─ ...
        ├─ layouts  //all components used in layout for all pages (sidebar, topbar)
        │  └─ ...
        ├─ molecules  //more complex components, generally use more than one html tag, and some atoms components
        │  └─ ...
        ├─ organisms  //more complex components, generally use some atoms and molecules components
        │  └─ ...
        └─ templates  //blade components that is used like a template for some section (use mora than one x-slot)
            └─ ...
```

#### Layouts

```php
├─ layouts
  ├─ admin-header.blade.  //layout for almost everything function in admin, with a title or header (use app.blade.php)
  ├─ admin.blade.php  //layout for almost everything function in admin
  └─ guest.blade.php  //layout for the authentication flow pages
  └─ report.blade.php  //layout for pdf export reports
```

#### Pages and dinamics livewire components

In pages folder goes the static views in separate folders for each HU flow that has a static view
In livewire folder goes the livewire components that is used in a pages view or a view dinamic used with a layout
Except the "/" view (dashboard) that goes separately without any folder

all admin feature are in a admin folder

all modules are separate in different folders (management-admin, management-customers, paramenters, transactions, reports, and customers parts have her own folder outside of admin folder) 

```php
├─ livewire
|  ├─ others  //dont have a specifict section
|  └─ admin  //group of admin part
|     ├─ management-admin  //group of admin module (roles, user, staff)
|     |   ├─ profile  //(example) all section for the profile pages used in pages/profile/index.blade.php
|     |   │  └─ logout-other-browser-sessions-form.blade.php
|     |   │  └─ ...
|     |   ├─ roles  //almost every section in the app has a CRUD, but the view just have create, update and detail, because delete and read use a abstract class
|     |   │  └─ create.php
|     |   │  └─ update.php
|     |   │  └─ detail.php
|     |   │  └─ ...
|     │   └─ ...
|     ├─ Dashboard.  //some folders like dashboard have another folders for separate more (in this case separate teh different charts for different proposals)
|     │  └─ Sales.php
|     │  └─ Products.php
|     │  └─ ...
|     └─ navigation-menu.blade.php
├─ pages
|  ├─ admin  
|  |  ├─ management-admin  
|  |  │  ├─ auth
|  |  │  │  ├─ forgot-password.blade.php
|  |  │  │  └─ ...
|  |  │  ├─ profile
|  |  │  │  └─ index.blade.php
|  |  │  └─ dashboard.blade.php
```

#### All usable components

All basics components with the theme application

```php
├─ components
    └─  admin
        ├─ atoms
        │  ├─ inputs
        │  │  └─ //checkbox, date, txt, select, label, error, validation-error(list), group (div for group label, error and input with styles)
        │  ├─ table  //all table tags html components (th, tr, table)
        │  │  ├─ columns  //columns customize for the table (where go a single row and column data)
        │  │  └─ table, th, td
        │  ├─ button-action.blade.php  //button responsive for the row data crud
        │  ├─ button.blade.php  //button simple with colors gray, blue, yellow, orange, red.
        │  ├─ button-rounded.blade.php  //button for icons 
        │  ├─ secondary-button.blade.php  //button simple white with outline
        │  ├─ dropdown-link.blade.php  //a single item for dropdown with href
        │  ├─ dropdown-link.blade.php  //a single item for dropdown with button
        │  ├─ logo.blade.php  //app logo in a tag
        │  ├─ date-format.blade.php  //formate a text (date) to isoFormat('DD MMM YYYY')
        │  ├─ modal.blade.php  //modal with alpine
        │  ├─ nav-link.blade.php  //single nav item for sidebar
        │  ├─ nav-item.blade.php  //single nav item for select nav
        │  └─ section-border.blade.php  //border for separate sections responsive
        ├─ layouts
        │  ├─ sidebar.blade.php  //animated sidebar responsive
        │  └─ topbar.blade.php  //topbar for mobile (with a toggle button for sidebar in large screens)
        ├─ molecules
        │  ├─ dropdown.blade.php
        │  ├─ nav-select.blade.php  //nav select with a group of nav
        │  ├─ detail-row.blade.php //a single row for show single data column in detail of a role for example
        │  ├─ th-filters.blade.php //a th with order filter
        │  └─ message-alert.blade.php  //success alert (warning and danger too)
        │  └─ orderby.blade.php  //order by a column for the data table mobile
        │  └─ search.blade.php  //search input with the by column filter
        │  └─ show-entries.blade.php  //how much entrie show in a page input component
        │  └─ th-filter.blade.php  //th with filter for datatable
        ├─ organisms
        │  └─ datatable-propierties.blade.  //orderby search and show-entrie for the datatable
        │  └─ item-actions.blade.php  //all 4 action for the row data crud
        │  └─ settings-dropdown.blade.php  //dropdown for user responsive isMobile prop (for change from sidebar to topbar)
        └─ templates
        │  ├─ card-mobile.blade.php  //cards component for a table responsive
        │  ├─ detail-show.blade.php  //template for detail view
        │  ├─ action-section.blade.php  //template with a title, description, and a main content
        │  ├─ authentication-card.blade.php  //template for authentication flow pages
        │  ├─ confirmation-modal.blade.php  //modal for confirmations like delete something, with a title, content and footer for the buttons
        │  ├─ dialog-modal.blade.php  //dialog-modal, for forms in a modal, with title, a content and footer for the buttons
        │  ├─ form-section.blade.php  //form with a title description and actions for button
        │  ├─ form-template.blade.php  //layout to create / update form, with content and footer actions
        │  ├─ permissions-card.blade.php  //layout to show the roles by group
        │  ├─ summary-card.blade.php  //layout for card for summary in dashboard
        │  └─ section-title.blade.php  //for a section, set the title and description appart of the content (like profile sections)
```

## How use some components

#### Message alert

The file is in resources/views/components/molecules

A component or message alerts like success, warning, and error

use in a php class with for the same view with livewire:

```php
use Laravel\Jetstream\InteractsWithBanner;

use InteractsWithBanner;

public function proof()
{
    $this->banner('Message') //success (green)
    $this->dangerBanner('Message') //danger (red)
    $this->warningBanner('Message') //warning (gray)
}
```

or in a redirect with:

```php
public function proof()
{
    session()->flash('flash.bannerStyle', 'success');  (success, danger) (if dont passed this session flash, default is warning)
    session()->flash('flash.banner', 'message');
    return redirect()->ro('route')
}
```

#### Datable

A livewire component abstract for show data with filters (orderby, pagination, search)

Make a livewire component with

```
php artisan make:livewire example
```

Extends that

```php
use App\Livewire\Others\Datatable;

class UsersTable extends Datatable
{
}
```

Create the columns for show in the table

```php
use App\View\Table\Column;

public function columns() : array
{
  return [
      Column::make('content', 'Content'),
      //set which column in show defaul (the other user can select to show)
       Column::make('name', 'Name')->isDefault(),
       //if has date in a isoFormat so you can search in that format
       Column::make('created_at', 'Created At'),       
       //with another component to show                             
       Column::make('created_at', 'Created At')->component('admin.atoms.table.columns.users.status'), 
   ];
}
```

Set the columns for search filter

```php
 public function filters(): array
    {
        return [
            Filter::make('id', 'ID'),
            //in joins with ambiguous columns name, passes liked this
            Filter::make('staff.name', 'Nombre'),
            //for filter in 
            Filter::make('created_at', 'Fecha de registro')->date(),
        ];
    }

Create an array to set the actions buttons you are going to use

```php
public function actions() : array
{
  return [
      'detail',
      'delivery',
      'update',
      'delete'
   ];
}
```

Add the name of the used model and pass it

```php
use App\Models\User;

public function query() : \Illuminate\Database\Eloquent\Builder
{
    return User::query();
}
```

Set routes prefix (for update, detail or some router prefix name)

```php
public function routesPrefix(): string
    {
        return 'example';
    }
```

Remove the render method of your livewire class

And finally add the component to the view

``` html
   <livewire:example>
```

#### DeleteRow 

A livewire component abstract for delete row with the delete button in a datatable, or other site

It open a modal confirmation to delete, an with the confirm delete de row of the model

Make a livewire component with

```
php artisan make:livewire ExampleDelete
```

```php
use App\Livewire\Others\DeleteRow;

class ExampleDelete extends DeleteRow
{
}
```

Passes the model 

```php
use App\Models\Model;

public function model()
{
    return Model::class;
}
```

Passes the class to re render after the delete (to show the changes)

```php
public function componentToRenderAfterDelete()
{
    return Read::class;
}
```

Set the confirmation messages, pasa un array vacio para poner los valores por defecto

```php
protected function confirmationMessages(): array
{
    return [
        'title' => 'Eliminar Rol',
        'description' => '¿Estás seguro de que quieres eliminar este rol?'
        'success'=>'Rol eliminado correctamente'
    ];
}
```

if has related model (category with products relateds) passes the model/s name to confirm before it

```php
public function relatedModels(): array
    {
        return ['product'];
    }

```
Put the livewire component in your page, can passes a route name if wanna redirect after delete

```php
<livewire:example redirect="example.index">
```