# Booking System - Laravel Project

## Project Setup Instructions

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & NPM
- Git

### Installation Steps

1. **Clone the Repository**
    ```bash
    git clone https://github.com/kartik110/booking-system.git
    cd booking-system
    ```

2. **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3. **Environment Setup**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure Environment File**
    - Open `.env` file and update database credentials
    - Configure SMTP settings:
      ```
      MAIL_MAILER=smtp
      MAIL_HOST=your_smtp_host
      MAIL_PORT=your_smtp_port
      MAIL_USERNAME=your_username
      MAIL_PASSWORD=your_password
      MAIL_ENCRYPTION=tls
      MAIL_FROM_ADDRESS=your_email
      ```

5. **Database Migration**
    ```bash
    php artisan migrate
    ```

6. **Build Assets**
    ```bash
    npm run dev
    ```

7. **Start Development Server**
    ```bash
    php artisan serve
    ```

The application will be available at `http://localhost:8000`

## Contributing
Please read the [Contributing Guidelines](CONTRIBUTING.md) before submitting any pull requests.

## License
This project is licensed under the MIT License.