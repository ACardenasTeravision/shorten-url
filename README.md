# Shorten URL - Full Stack Challenge

## Simple API to shorten urls.

---

### REQUIREMENTS

* Laravel 5.8
* MySQL

---

### INSTALLATION

1. Clone the repository.
2. Create a virtualhost.
3. Create an empty database.
4. Move to the project's root folder.
5. Install dependencies with `composer install`
6. If you don't have .env file copy the .env.example and rename it using `cp .env.example .env`
7. Add database name and app url to the .env configuration.
8. Run `php artisan key:generate` to generate the app key.
9. Run `php artisan migrate` to create the database tables.
10. Run `php artisan serve` to start the local server.
11. Test API routes.

---

### CHALLENGES
- Understand how shorten urls work. Was necessary to read about tools like Bitly and TinyURL, the advantages that it gives and why is these useful.
- Use Goutte. Know how to use this library to extract information of a page. Figure out how to crawl element in the page to get the title.
---

### REASONING
- Database: To store the shortened urls was necessary to create a database table with the right fields: the original url, a code of 6 random characters mixed with numbers, the shortened url, the title of the page and the number of times this shortened link is visited.

- API routes:
  - 'get-top-urls': Returns the top 100 most visited urls.
  - 'create-shorten-url/{url}' Requires the original url, creates a new entry in the database and returns the shortened version.
  - 'get-redirect-link/{shorten_url}' Requires the shortened_url and returns the full url.

---

### FUTURE IMPROVEMENTS
- Add comments to the code
- Check all the validations
