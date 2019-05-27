sc2.n1.gg
=========
*Fast, reliable Starcraft 2 data and statistics*

## What's the issue I'm solving ?
[Aligulac](http://aligulac.com) is a wonderful website giving statistics and ratings about starcraft 2's players.  
It helps forging a story of the multiple events that occurred and giving an overview of the competitive landscape of SC2.  
However it's slow and often down.

## Why rewrite it ?
My project has also a different goal: the data and only the data. No processing of it, no rating, only making it accessible.  
I basically reduced the scope of the project to manage it better.  
If you want accurate ratings or predictions, aligulac is still the website you're looking for.

## Features
[sc2.n1.gg](https://sc2.n1.gg) gives a new starting point to starcraft 2's data and statistics:
- Modern stack: Symfony 4, PostgreSQL 11 with containers for development and ansible for deployment.
- Neutral: does not compute a rating but sticks to raw data. You can use the API to write your own rating.
- Fast: Special care to db queries and nginx caching to keep everything quick.
- Responsive: Mobile friendly interface (fact-checking on the phone is a reality).

## Situation and goals
The website is read only for now and gets all the data from Aligulac. I don't want to split the contributors efforts.  
The goal will never be to be totally real time. Adding new results to the database one or two days later is good enough.  
The website must be reliable. Uptime and response time are a big priority.  
I will write documentation.
