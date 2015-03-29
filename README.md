today:
- reply to politics posts
- phone pam
- tax forms?





Adv of laravel ( ͡° ͜ʖ ͡°)

tinker tool
dd()
gulp for styles, js
much cleaner
array_* functions


..adv for QA?

easier to organise subfolder routes (e.g. admin/.. account/..)


? admin/tags/delete bug
? how to put $auth in Controller so all controllers can access it?


THINGS/ WAYS TO TEST
- controllers: routes are ok
- models: relationships, custom methods
- 

TODO

- caching - http://laravel.io/forum/03-29-2015-whats-the-best-test-friendly-method-to-use-cache-in-models
- pagination - http://laravel.io/forum/03-29-2015-pagination-links-html-is-being-escaped-in-my-view


votes controller?

points - how to make http calls?

how to mock auth?
notification emails - email has been hidden though :/ -- email templates/ views?

admin - users, tags, questions, answers, 
- questions
--- remove ask button
--- remove edit/ delete
--- make clickable to public area

account - questions, answers, profile

auth 
- landing page /admin
- change registration page


MIGRATE HTML, CSS, etc
- assets - revise again
- Theme?
- bring in CSS, js


Question
- total_views?




JS
- more questions button
- ckeditor - questions and answers
- votes widget
- infinate scrolling - laravel respond json; backbone, mustache templates

composer package: -- look at providers too, i'm not sure what's different about them
metroworks\laravel-tools
- Metroworks\Laravel5\Middleware\SamlPassiveLogin
- Metroworks\Laravel5\Middleware\AuthenticateAdmin
- Metroworks\Http\Reputation (points)
- Metroworks\Http\Subjects
- Metroworks\Http\Reviews
- Metroworks\Http\Solr?



test - models, controllers (uses requests?), requests?


docs
sso - remove the auth library from laravel, move into composer - Metroworks\Auth\Registrar;
.. or provider? which can i configure?
solr


ENHANCEMENTS
- redesign topnav - empty panels, loaded with ajax; clicking main buttons takes you somewhere; slide down





load testing - zend qa vs laravel


DOCS

Everything get's returned to the view as an array. This is so that js can also fetch the same data without some complicated conversions (as front end templates cannot use 

gulp and phpunit testing