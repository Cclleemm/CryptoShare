# Cryptoshare

Cryptoshare was designed to offer a more rigorous and complete monitoring over your cryptocurrency mining business made with Suprnova pool. 
Follow your mining rig performances, track your gains and expenses, manage investors and keep traces of all transaction made from your Suprnova account. This web tool is powered with Laravel 5.5. 

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

Your server needs to meet the following requirements to run Laravel 5.5 and its dependencies

```
PHP >= 7.1
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
Tokenizer PHP Extension
XML PHP Extension
```

### Installing

1/ Install Laravel 5.5.* (More information [here](https://laravel.com/docs/5.5/installation))

```
composer global require "laravel/installer"
laravel new cryptoshare

```

or 

```
composer create-project --prefer-dist laravel/laravel cryptoshare
```
2/ Setup the MySQL database "cryptoshare"

3/ You should be able to access the home page of the application as a guest here.
Go to localhost/register to create an admin account and localhost/login to sign in and enable admin features.

4/ Give us a like !

## Deployment

Follow [instructions on Laravel website](https://laravel.com/docs/5.5/deployment) to deploy the application to a web server. 

## Built With

* [Dropwizard](http://www.dropwizard.io/1.0.2/docs/) - The web framework used
* [Maven](https://maven.apache.org/) - Dependency Management
* [ROME](https://rometools.github.io/rome/) - Used to generate RSS Feeds

## Contributing

## Authors

* **Thomas Cosialls** - *Initial work* - [Thomas CCosialls](https://github.com/tomtomdu73)

See also the list of [contributors](https://github.com/your/project/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
