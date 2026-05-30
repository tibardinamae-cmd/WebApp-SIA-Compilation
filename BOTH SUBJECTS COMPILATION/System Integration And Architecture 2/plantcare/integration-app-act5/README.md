# Laravel API Integration Application

A Laravel application demonstrating authentication, role-based access control, REST API integration, and API token authentication.

## Features

### Authentication & Authorization
- **User Registration & Login**: Standard Laravel Breeze authentication
- **Role-Based Access**: Admin and User roles with different dashboard views
- **Forgot Password**: Complete password reset functionality (emails logged in development)
- **Email Verification**: User email verification system

### API Integration
- **External API Consumption**: Integration with JSONPlaceholder and Open-Meteo APIs
- **API Token Authentication**: Laravel Sanctum for secure API access
- **Caching**: 10-minute cache for external API responses
- **Error Handling**: Graceful handling of API failures

### Dashboard Features
- **Admin Dashboard**: User management, search/filter functionality, external data display
- **User Dashboard**: Personal weather information and API token management
- **Search & Filter**: Advanced user search by name/email and role filtering
- **Weather Display**: Current weather information from Open-Meteo API

## API Endpoints

### Protected Endpoints (Require Authentication)
- `GET /api/users` - List all users (Admin only via role check)

### Public Endpoints
- `GET /` - Welcome page
- `GET /weather` - Weather dashboard

## API Token Usage

1. **Create Token**: Log in and visit your dashboard, then use the "API Token Management" section
2. **Token Name**: Choose a descriptive name for your token (e.g., "Admin API Token", "Mobile App Token")
3. **Usage**: Include the token in the Authorization header:

```bash
curl -H "Authorization: Bearer YOUR_TOKEN_HERE" http://localhost:8000/api/users
```

### Example API Call
```bash
# Replace YOUR_TOKEN with the actual token from your dashboard
curl -H "Authorization: Bearer YOUR_TOKEN" \
     -H "Accept: application/json" \
     http://localhost:8000/api/users
```

## Setup Instructions

1. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

2. **Environment Setup**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Setup**:
   ```bash
   php artisan migrate
   ```

4. **Build Assets**:
   ```bash
   npm run build
   ```

5. **Start Application**:
   ```bash
   php artisan serve
   ```

## Mail Configuration

By default, emails are logged to `storage/logs/laravel.log` for development. To use a real mail service, update `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourapp.com
```

## Testing the Application

1. **Register Users**: Create accounts with different roles (admin/user)
2. **Test Authentication**: Login/logout functionality
3. **Forgot Password**: Use the "Forgot your password?" link on login page
4. **API Tokens**: Generate tokens from dashboard and test API endpoints
5. **Search/Filter**: Admin users can search and filter the user list
6. **External APIs**: View weather data and external posts

## Security Features

- CSRF protection on all forms
- SQL injection prevention via Eloquent ORM
- XSS protection via Blade templating
- Rate limiting on sensitive operations
- Secure password hashing
- API token authentication with Sanctum

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
