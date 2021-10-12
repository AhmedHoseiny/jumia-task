# jumia-task

This is jumia task to Create a single page application that uses the database provided (SQLite 3) to list and categorize country phone numbers.

Phone numbers should be categorized by country, state (valid or not valid), country code and number.

The page should render a list of all phone numbers available in the DB. It should be possible to filter by country and state.

## Requirements

In order to run this project you must have PHP7+, Docker, Composer and SQLite 3 installed.

## Up & Running

Once you have cloned the project run:
> docker-compose up --build

You can access the customer phones view through:
> http://localhost:8000/customer/phones

If you need to list all running containers run:
> docker ps

## Unit-Test

To run the tests you can run:
> vendor/bin/phpunit
