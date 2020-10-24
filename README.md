Bags Kata
========================

## Introduction
Hi!
This is my solution. It is written in PHP because I'm more comfortable to configure this language.

## Choice
 - *Use Hexagonal architecture:* for this challenge I choose a clean architecture. I create 3 separate layers: application: point of entry, Domain: all logic, and repository: access to data. Maybe I could use DDD, using Value Object,... but It a sunny Sunday ;)
 - *Use TDD*: As you can see in my git history, I created a test and then command/commandHandler. Maybe I could improve tests by creating tests for domain and maybe acceptance tests.
 - *Simple design:* I created the minimum test and minimum documentation, if you need more information, please tell me.
 - *Check code:* PHP is a dynamic language, I added some tools like [PHPStan](https://github.com/phpstan/phpstan) to analyze the code. Furthermore, I use PHP-CS-Fixer to reformate code according to PHP guidelines. I use mutant testing to improve my tests
 - *Docker:* I create a Makefile (I usually forget Docker commands) and add a simple PHP image for development

## Improvement
- Create Value Objects for more semantic and validation
- Add more test: as I said before, this project needs more
- Improve InMemoryRepository

## How to run
You can use Docker, and the Makefile to run.
```
$ make run
         Welcome to Twitter Console
----------------------------------------------
Please type one of the following commands:
 - Post: <username> -> <message>
 - Follow: <username> follows <other user>
 - Read: <username>
 - Wall: <username> wall
Type '...' on a line by itself when you're done.
Enjoy
>
```


