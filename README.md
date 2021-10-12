# jumia-task

This is jumia task that uses the database provided (SQLite 3) to list and categorize country phone numbers.

Phone numbers are categorized by country, state (valid or not valid), country code and number.

The page renders a list of all phone numbers available in the DB, and you can filter by country and state.

## Requirements

In order to run this project you just only have Docker installed.

## Up & Running

Once you have cloned the project run:
> docker-compose up

To enter inside the project run:
> docker exec -it Laravel_php bash

You can access the customer phones view through:
> http://localhost:8000/customer/phones

## Unit-Test

To run the tests you can run:
> docker exec -it Laravel_php bash -c "vendor/bin/phpunit"
