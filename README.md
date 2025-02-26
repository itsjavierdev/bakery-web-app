<p>
    <img src="https://github.com/user-attachments/assets/273dd76c-0942-4f23-a584-2031598aa680" alt="logo" align="left" width="70" height="auto"></img>
</p>


# Sistema para la panaderia "San Xavier"

Este proyecto, un sistema de panadería, proporciona una sólida plataforma para que la panadería San Xaview agilice sus operaciones y permita a los clientes realizar cómodamente sus pedidos en línea. Cuenta con una interfaz fácil de usar para navegar por los productos, un sistema de carrito de la compra seguro y un proceso para realizar pedido de manera fluida. La aplicación está diseñada para mejorar la eficiencia de la panadería digitalizando el proceso de pedido y proporcionando una experiencia en línea fluida a los clientes. Y una parte de administración para el personal y el propietario de la panadería para administrar el contenido de la parte del cliente, y recibir y crear pedidos, y ver análisis de los productos, ventas y otras funciones. Los desarrolladores pueden explorar el código base para entender los detalles de implementación.


## Contenido:

- [Tecnologías](#-tecnologías)
- [Instalación](#-instalación)
- [Guia de la estructura de carpetas](#-guia-de-la-estructura-de-carpetas)
- [Guía uso de componentes](#guía-uso-de-componentes)
- [Imágenes de la aplicación](#imagenes-de-la-aplicación)

## 💻 Tecnologías:

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white) ![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white) ![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white) ![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)

## 👩🏻‍💻 Instalación:

Primero debes configurar el entorno de desarrollo de laravel

Luego clona el repositorio con:

```
git clone git@github.com:itsjavierdev/bakery-web-app.git
```

### Corre estos comandos en la terminal

Installa composer y los modulos de node

```
composer install
npm i
```

Crea .env y genera una llave de encriptación

```
cp .env.example .env
php artisan key:generate
```

Limpia el cache del Framework

```
composer dump-autoload
```

Crea el enlace simbolico en el el fichero public de fichero storage

```
php artisan storage:link
```

Corre las migraciones, para configurar la base de datos y llenarla de datos de prueba

```
php artisan migrate --seed
```

## 🏃🏻‍♂️ Corre la aplicación:

#### Corre estos dos comandos en distintas terminales

Para correr los estilos

```
npm run dev
```

Para correr el server

```
php artisan serve
```

## 🔑 Primera autenticación:

#### Email

`test@example.com`

#### Contraseña

`password`

## 📁 Guia de la estructura de carpetas

#### Controladores

Al usar livewire, los controladores se usaron para las rutas estaticas con o sin parametros

```php
└─  app
   └─  Http
      └─ Controllers
         ├─ Customer.php            //controladores para la autenticación del cliente
         │  ├─ AuthManager.php
         │  └─ ... 
         ├─ Controller.php
         └─ UserProfileController.php  //ccontrolador para la información del usuario del personal
```

#### Componentes de livewire

Los componentes se separaron en carpetas para cada CRUD o HU

El aparatdo de cliente y adminitración fueron separados en diferentes carpetas

Cada modulo en el apartado de administracion tiene su propia carpeta (ManagementAdmin, ManagementCustomers, Paramenters, Transactions, Reports)

```php
└─ app
   └─ Livewire
      ├─ Forms  //para reglas de validación separadas en componentes livewire con más de una
      │  └─ Admin //con la mismas secciones de la carpeta livewire
      │      └─ Staff
      │          └─ ...
      ├─ Others  //para los que no tiene una sección espécifica
      └─ Admin  
         └─ ManagementAdmin  
             ├─ Profile
             │  ├─ DeleteUserForm.php
             │  ├─ LogoutOtherBrowserSessionsForm.php
             │  └─ ...
             ├─ Roles //Casi todas las seccioens de la app, tienen un crud con estos metodos
             │  ├─ Create.php
             │  └─ Delete.php
             │  └─ Read.php
             │  └─ Update.php
             │  └─ Detail.php
             │  └─ ...
             ├─ Dashboard.  //algunas carpetas como como el dashboard tiene otras carpetas mas (en este caso se separan los diferentes propositos de los gráficos)
             │  └─ Sales.php
             │  └─ Products.php
             │  └─ ...
             └─ NavigationMenu.  //todos los nav-links de la sidebar
```

#### Reportes

En esta carpeta se encuentran los reportes a excel


```php
└─ Exports
   └─ Sales //reportes según el modulo
      ├─ AllSalesExport 
      └─ ...
```

#### Vistas

```php
└─ resources
   └─ views
      ├─ components  //todos los componentes blade
      ├─ exports  //reportes o exportaciones a pdf
      ├─ layouts  //layouts para la aplicación
      ├─ livewire  //componentes dinámicos de livewire /(usados en pages, o con un layout)
      └─ pages  //todas las vistas estaticas
```

#### Componentes

Los componentes se separaron in atoms, molecules, organisms, templates, and layout

```php
├─ components
    └─ admin
        ├─ atoms  //todos los componentes básicos, generalmente una etiqueta html personalizada en estilo o funcionalidad
        │  ├─ inputs  //componentes inputs personalizados (text, checkbox, date, label, error) 
        │  ├─ table  //las etiquetas html de table (th, tr, table)
        │  │  ├─ columns  //columnas personalizadas para la tabla (formatea la información asignada por el datatable)
        │  │  └─ ...
        │  └─ ...
        ├─ layouts  //componentes usados como layout (sidebar, topbar)
        │  └─ ...
        ├─ molecules  //componentes mas complejos que usan mas de una etiqueta html, u otros componentes atoms
        │  └─ ...
        ├─ organisms  //componentes aun más complejos que utilizan componentes atoms o molecules
        │  └─ ...
        └─ templates  //componetes que se usan como plantilla para alguna sección (usan mas de un x-slot)
            └─ ...
```

#### Layouts

```php
├─ layouts
  ├─ admin-header.blade.  //layout para cada funcion en la parte administrativa con su titulo o encabezado (usa app.blade.php)
  ├─ admin.blade.php  //layout para casi todas las funciones administrativas que no requieran titulo o encabezado (o requieran uno mas personalizado)
  └─ guest.blade.php  //layout para el flujo de autenticación
  └─ report.blade.php  //layout para los reportes a pdf
```

#### Pages y componentes dinamicos de livewire

En el fichero "pages" van las vistas estaticas con carpetas separads para cada crud que tiene una vista estatica
En el fichero livewire vas los componentes livewire que se usan en un archivo de pages o una vista dinamica con un layout 
Excepto por la vista dashboard "/" que va separada sin ninguna carpeta

todas las caracteristicas del apartado administrativo estan en la carpeta admin

todos los modulos se separaron en diferentes carpetas (management-admin, management-customers, paramenters, transactions, reports, y customers) 

```php
├─ livewire
|  ├─ others  //sin sección especifica
|  └─ admin  //parte adminsitrativa
|     ├─ management-admin  //modulo admin (roles, usuario, personal)
|     |   ├─ profile  //(ejemplo) todas las secciones para la pages profile pages/profile/index.blade.php
|     |   │  └─ logout-other-browser-sessions-form.blade.php
|     |   │  └─ ...
|     |   ├─ roles  //casi cada sección en la app tiene un CRUD, pero las vista solo tiene create, update y detail porque delete y read usan una clase abstracta
|     |   │  └─ create.php
|     |   │  └─ update.php
|     |   │  └─ detail.php
|     |   │  └─ ...
|     │   └─ ...
|     ├─ Dashboard.  //algunas carpetas como como el dashboard tiene otras carpetas mas (en este caso se separan los diferentes propositos de los gráficos)
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

#### Todos los componentes usables

All basics components with the theme application

```php
├─ components
    └─  admin
        ├─ atoms
        │  ├─ inputs
        │  │  └─ //checkbox, date, txt, select, label, error, validation-error(list), group (div for group label, error and input with styles)
        │  ├─ table  //etiquetas table de html (th, tr, table)
        │  │  ├─ columns  //componentes que usa la datatable para formatear ciertos datos
        │  │  └─ table, th, td
        │  ├─ button-action.blade.php  //botones responsivo para cada fila de la tabla en un crud
        │  ├─ button.blade.php  //boton simple con diferentes colores como gray, blue, yellow, orange, red.
        │  ├─ button-rounded.blade.php  //boton redondeado para iconos
        │  ├─ secondary-button.blade.php  //boton simple con solo borde
        │  ├─ dropdown-link.blade.php  //elemento para la lista de un dropdown
        │  ├─ logo.blade.php  //logo de la aplicación en una etiqueta
        │  ├─ date-format.blade.php  //formatea un texto (fecha) al isoFormat('DD MMM YYYY')
        │  ├─ modal.blade.php  //modal con alpine
        │  ├─ nav-link.blade.php  //nav link para la sidebar
        │  ├─ nav-item.blade.php  //nav item para la sidebar
        │  └─ section-border.blade.php  //borde responsivo para separar secciones
        ├─ layouts
        │  ├─ sidebar.blade.php  //sidebar responsive animada
        │  └─ topbar.blade.php  //topbar necesaria para celulares (con el boton de abrir sidebar)
        ├─ molecules
        │  ├─ dropdown.blade.php
        │  ├─ nav-select.blade.php  //sección seleccionada del sidebar
        │  ├─ detail-row.blade.php //a single row for show single data column in detail of a role for example
        │  └─ message-alert.blade.php  //mensaje o alerta de confirmación (warning y danger también)
        │  └─ orderby.blade.php  //ordenar por columna para el datatable de celulares
        │  └─ search.blade.php  //input de buscar con filtro por columna
        │  └─ show-entries.blade.php  //cuantas filas mostrar por pagina
        │  └─ th-filter.blade.php  //un th con filtros de ordenar (asc y desc)
        ├─ organisms
        │  └─ datatable-propierties.blade.  //ordenar por y mostrar x filas para la datatable
        │  └─ item-actions.blade.php  //las 5 diferentes acciones para cada fila en una datatable de un crud
        │  └─ settings-dropdown.blade.php  //dropdown responsive para mostrar el usuario
        └─ templates
        │  ├─ card-mobile.blade.php  //componente de carta para una datatable responsiva
        │  ├─ detail-show.blade.php  //plantilla para el detalle (de un cliente, pedido, etc)
        │  ├─ action-section.blade.php  //plantilla con title, description, and a main content 
        │  ├─ authentication-card.blade.php  //plantilla para las paginas del flujo de autenticación
        │  ├─ confirmation-modal.blade.php  //modal para confirmar alguna eliminación con title, content, y footer para los botones del modal
        │  ├─ dialog-modal.blade.php  //dialog-modal para los formularios en un modal, con title, content y footer para los botnes de acción
        │  ├─ form-section.blade.php  //formulario con un title, descriptión y actions del formulario
        │  ├─ form-template.blade.php  //layourt para los formularios de crear o actualizar
        │  ├─ permissions-card.blade.php  //layout para mostrar roles por grupo de roles
        │  ├─ summary-card.blade.php  //layout para la tarjeta de resumen en el dashboard
        │  └─ section-title.blade.php  //para cada seccion con title y description (como las profile section)
```

## Guía uso de componentes

#### Mensaje de alerta/confirmación

Este se encuentra en resources/views/components/molecules

Un componente para mensajes de alerta exitosa, peligro o error

usar en una clase php para la misma vista con livewire:

```php
use Laravel\Jetstream\InteractsWithBanner;

use InteractsWithBanner;

public function proof()
{
    $this->banner('Message') //Exitoso (verde)
    $this->dangerBanner('Message') //peligro (rojo)
    $this->warningBanner('Message') //precaución (gris)
}
```

o en una redirección con:

```php
public function proof()
{
    session()->flash('flash.bannerStyle', 'success'); //(success, danger) (si no pasas esta session flash, la default es warning)
    session()->flash('flash.banner', 'message');
    return redirect()->ro('route')
}
```

#### Datable

un componente livewire abstracto para mostrar lista de información con filtros (ordenar por, paginación, busqueda)

Crea un componente livewire con

```
php artisan make:livewire example
```

Hereda de:

```php
use App\Livewire\Others\Datatable;

class UsersTable extends Datatable
{
}
```

Crea las columnas para mostrar en la tabla

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

Coloca las columnas para los filtros de busqueda por

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
```

Crea un array para establecer los botones de acción que se usaran en la tabla


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

agrega el nombre del modelo a usar para pasarlo, o poner una query especifica de este

```php
use App\Models\User;

public function query() : \Illuminate\Database\Eloquent\Builder
{
    return User::query();
}
```

Establece el prefijo de ruta (para update, detail, o algun prefijo de ruta que nos redigira los botones)

```php
public function routesPrefix(): string
    {
        return 'example';
    }
```

Remueve el metodo render de la clase livewire

Y finalmente agrega el componente a la vista

``` html
   <livewire:example>
```

#### DeleteRow 

Un componente livewire abstracto para borrar una fila con el boton de eliminar en un datatable u otro sitio

Este abre un modal de confimación de eliminación, y luego eliminar la fila o lo deseado

Crea un componente livewire con

```
php artisan make:livewire ExampleDelete
```

Hereda de:

```php
use App\Livewire\Others\DeleteRow;

class ExampleDelete extends DeleteRow
{
}
```

Pasa el modelo

```php
use App\Models\Model;

public function model()
{
    return Model::class;
}
```

pasa la clase que se requiera re-renderizar luego de eliminar (para mostrar cambios)


```php
public function componentToRenderAfterDelete()
{
    return Read::class;
}
```

Establece los mensajes de confirmacion, o un array vacio para los valores por defecto

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

si tiene un modelo relacionado (category y products se relacionan, y tiene restricciones) pasa el modelo para realizar la confirmación antes


```php
public function relatedModels(): array
    {
        return ['product'];
    }

```

Pon el componente livewire en la page, ademas de poder pasar una ruta en caso de querer redirigir luego de eliminar

```php
<livewire:example redirect="example.index">
```

## Imagenes de la Aplicación

### Apartado de realizar pedido por el cliente

#### Vista principal

![HomePage](https://github.com/user-attachments/assets/6c995fa6-658a-4bb5-9b27-211ac31e6674)

#### Vista tienda/todos los productos

![Shop](https://github.com/user-attachments/assets/300e5b50-e5a6-4de6-9d83-46b1ad80f251)

#### Vista detalle de un producto

![DetailProduct](https://github.com/user-attachments/assets/d53bc886-d34c-4ce1-929b-841f60d0fef3)

#### Vista Carrito

![Cart](https://github.com/user-attachments/assets/35cc70c4-8b23-4a8f-8f2d-9be2ba3d0f18)

#### Vista Gestionar Direcciones

![direcciones](https://github.com/user-attachments/assets/ef42df3d-5ad9-44c3-a2be-5f82ce547df7)

#### Vista Checkout/Realizar Pedido

![checkout](https://github.com/user-attachments/assets/e745fcc1-108a-47a8-9378-bf1dae17ff7d)

#### Vista Registro de cliente

![RegistrarCliente](https://github.com/user-attachments/assets/7f5cbe54-5d22-41e2-8fac-9fcf220688cb)

#### Vista Inicio de sesión del cliente

![LoginCliente](https://github.com/user-attachments/assets/7751a2f5-a8cb-49bc-8594-105ca693ee18)

### Apartado Administrativo del sistema

#### Vista inicio de sesión del personal

<img width="1512" alt="login personal" src="https://github.com/user-attachments/assets/9678a9a4-ec15-4c04-b750-d7306ae84321" />

#### Vista dashboard

<img width="1512" alt="dashboard" src="https://github.com/user-attachments/assets/0ffa0721-af39-48d9-a0f3-cf20cbb783da" />

#### Vista agregar rol

<img width="1512" alt="gestionar roles" src="https://github.com/user-attachments/assets/5096f295-f379-427a-ac10-b94096166201" />

#### Vista agregar producto

<img width="1512" alt="gestionar productos" src="https://github.com/user-attachments/assets/90e4d24a-be4d-4fe9-9d32-389c73e3b51a" />

#### Vista principal información de contacto de la empresa

<img width="1512" alt="gestionar info de la empresa" src="https://github.com/user-attachments/assets/3d318826-7dbf-41d7-9734-d6757b8997b8" />

#### Vista principal gestionar pedidos

<img width="1512" alt="gestionar pedidos" src="https://github.com/user-attachments/assets/428f0479-cdf1-4a10-92a8-d9d65cf33e7d" />

#### Vista entregar pedido

<img width="1512" alt="entregar pedido" src="https://github.com/user-attachments/assets/2569be2f-f079-438b-9770-973f044a2d23" />

#### Vista reportes de ventas

<img width="1512" alt="reportes de ventas" src="https://github.com/user-attachments/assets/2304fec3-fb84-4b81-bbc5-3580706a383d" />

#### Vista reporte de pedidos

<img width="1512" alt="reporte de pedidos" src="https://github.com/user-attachments/assets/6b6fe410-14b4-49ed-9a68-aa583d2aab65" />

### Ejemplo algunos reportes

#### Reporte de productos por entregar

<img width="1512" alt="reporte de productos por entregar" src="https://github.com/user-attachments/assets/c938400b-91b9-4aae-a1c2-8f8404657c19" />

#### Reporte de ventas por productos

<img width="1511" alt="reporte de ventas por productos" src="https://github.com/user-attachments/assets/86069e50-d845-416c-9fc4-b674c646fc27" />

#### Reporte de ventas diarias por un rango de fechas

<img width="1512" alt="reporte de ventas diarias" src="https://github.com/user-attachments/assets/7c8de5f8-68cf-4d4b-92b1-03f0e7fd412f" />

#### Comprobante de venta

<img width="1512" alt="Comprobante de venta" src="https://github.com/user-attachments/assets/1fe406cb-f4fa-49d1-95bd-23039a4edc9b" />

#### Comprobante de pago 

<img width="1512" alt="Comprobante de pago" src="https://github.com/user-attachments/assets/46518f0d-94c3-41e2-83f4-b98eb968195f" />

### Algunos email que envia la aplicación

#### Correo de verificar correo electronico del cliente

![verificar email cliente](https://github.com/user-attachments/assets/9f951440-4343-4f48-a4c0-ce556fa17173)

#### Correo de confirmación de pedido

![confirmacion pedido cliente](https://github.com/user-attachments/assets/7397b55c-303f-454f-bf89-dfde13315d90)





