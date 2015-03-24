Adv of laravel

tinker tool
dd()
gulp for styles, js
much cleaner


..adv for QA?

easier to organise subfolder routes (e.g. admin/.. account/..)

? How to set /create as /ask
? Why is /5 not showing
? build caching into models - http://laravel.com/docs/4.2/queries (caching queries - removed?)
? can view return json when 
? how to test scope methods with Mockery (e.g. newest, not scopeNewest)

THINGS/ WAYS TO TEST

- models: validate, attributes, fillable, (see book)
- 

TODO

Theme
assets - revise again
bring in CSS, js

hometabs
- load with ajax

models validation - answers, tag, follow, etc
auth - change registration page
tags
ANSWERS: use controller nesting e.g. /5/answers/12/edit
test - models, controllers (uses requests?), requests?
infinate scrolling - laravel respond json; backbone, mustache templates
admin - users, tags, questions, answers, 
account - questions, answers, profile
docs
sso - remove the auth library from laravel, move into composer - Metroworks\Auth\Registrar;
.. or provider? which can i configure?
solr
redesign topnav - empty panels, loaded with ajax; clicking main buttons takes you somewhere; slide down


tags
- tag buttons on create/edit
- 


DOCS

Everything get's returned to the view as an array. This is so that js can also fetch the same data without some complicated conversions (as front end templates cannot use 