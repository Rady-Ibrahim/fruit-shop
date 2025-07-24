<<<<<<< HEAD
# fruit-shop
=======


## Project Description
A simple e-commerce project that allows users to browse products, add them to the cart, and complete the checkout process. The project includes a dynamic user interface with features such as product management, category management, cart functionality, and order placement.

---

## Key Features
- **Product Management**:
  - View all products.
  - Add new products.
  - Edit and delete products.
- **Category Management**:
  - View all categories.
  - Add new categories.
  - Edit and delete categories.
- **Cart**:
  - Add products to the cart.
  - Update quantities.
  - Remove products.
- **Order Placement**:
  - Enter customer details (name, email, address, phone).
  - View order details.
  - Save the order to the database.
- **Password Reset**:
  - Send a password reset link via email.
- **Dynamic User Interface**:
  - Responsive design using Bootstrap.
  - Attractive product and image display.

---

## Technologies Used
- **Backend**: Laravel (PHP Framework)
- **Frontend**: Blade Templates (HTML, CSS, JavaScript)
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **Email Integration**: SMTP (Gmail)
- **Session Management**: Database

---

## Project Structure
- **Routes**:
  - `web.php`: Contains all the routes for the frontend.
  - `api.php`: Can be used to add API endpoints in the future.
- **Controllers**:
  - `ProductController`: Manages products.
  - `CategoryController`: Manages categories.
  - `CartController`: Manages the cart.
  - `OrderController`: Manages orders.
- **Views**:
  - `layouts/master.blade.php`: Main layout template.
  - `product/order.blade.php`: Order placement page.
  - `auth/passwords/email.blade.php`: Password reset request page.
  - `auth/passwords/reset.blade.php`: Password reset page.
- **Models**:
  - `Product`: Represents a product.
  - `Category`: Represents a category.
  - `Order`: Represents an order.
  - `Cart`: Represents the cart.

---

## How to Run the Project
1. **Install Dependencies**:
   ```bash
   composer install
   npm install

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
>>>>>>> 9d16802 (Initial commit)
