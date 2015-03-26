Adv of laravel

tinker tool
dd()
gulp for styles, js
much cleaner
array_* functions


..adv for QA?

easier to organise subfolder routes (e.g. admin/.. account/..)


? build caching into models - http://laravel.com/docs/4.2/queries (caching queries - removed?)
? can view return json when 


THINGS/ WAYS TO TEST

- models: validate, attributes, fillable, (see book)
- 

TODO

Answers
- answer from question page (redirect back to question show)
- edit
- delete
- use controller nesting e.g. /5/answers/12/edit

Tags
- build admin interface - create, edit, pagination
- admin auth/ acl
- display multi-select in edit
- add tags when asking

Questions
- more questions button
*save question - update slug event

ACL -- need roles table
$user->isAdmin()
$user->isAnswerer()
$user->isSubscriber()
$user->canUpdate($question) // or $answer
$user->canDelete($question) // or $answer

!hide email from json


auth 
- only show edit/ delete if authenticated and own the file (acl?)
- change registration page


test - models, controllers (uses requests?), requests?
infinate scrolling - laravel respond json; backbone, mustache templates
admin - users, tags, questions, answers, 
account - questions, answers, profile
docs
sso - remove the auth library from laravel, move into composer - Metroworks\Auth\Registrar;
.. or provider? which can i configure?
solr
redesign topnav - empty panels, loaded with ajax; clicking main buttons takes you somewhere; slide down

Theme
assets - revise again
bring in CSS, js

hometabs
- load with ajax

tags
- tag buttons on create/edit
- 

points

load test - zend qa vs laravel


DOCS

Everything get's returned to the view as an array. This is so that js can also fetch the same data without some complicated conversions (as front end templates cannot use 