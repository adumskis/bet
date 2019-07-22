# Bet API

## This API built using
* Lumen framework v5.8;
* PHP v7.3;
* MariaDB v10.4;
* Redis v4.0;
* Homestead vagrant box v8.0.

## How to run locally
* Clone repository;
* Copy `.env.example` to `.env`;
* Copy `Homestead.yaml.example` to `Homestead.yaml`;
* Build vagrant VM: `vagrant up`;
* Connect to VM: `vagrant ssh`;
* Go to project directory: `cd code`;
* Install composer dependencies: `composer install`;
* Run migrations: `php artisan migrate`;
* Run example request using Postman (or other) client.


## Example request

* URL: http://bet.test/api/bet
* Method: POST

```json
{
  "player_id": 1,
  "stake_amount": "5",
  "selections": [
      {
        "id": 1,
        "odds": "1.601"
      }
  ]
}
```
