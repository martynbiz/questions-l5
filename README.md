Adv of laravel ( ͡° ͜ʖ ͡°)

tinker tool
dd()
gulp for styles, js
much cleaner
array_* functions


..adv for QA?

easier to organise subfolder routes (e.g. admin/.. account/..)


..migrating

can still use ZF1 as a dependancy, as components (e.g. Zend_Locale)


? build caching into models - http://laravel.com/docs/4.2/queries (caching queries - removed?)
http://laravel.io/forum/03-28-2015-if-i-wanted-to-create-a-simple-library-class-api-client-in-laravel-5-where-would-i-put-it


THINGS/ WAYS TO TEST
- controllers: routes are ok
- models: relationships, custom methods
- 

TODO

Tags
- build admin interface - create, edit, pagination
- admin auth/ acl
- display multi-select in edit
- add tags when asking

Questions
- more questions button
*save question - update slug event

!hide email from json


auth 
- only show edit/ delete if authenticated and own the file (acl?)
- change registration page



composer package: -- look at providers too, i'm not sure what's different about them
metroworks\laravel-tools
- Metroworks\Laravel5\Middleware\SamlPassiveLogin
- Metroworks\ApiClient\Reputation
- Metroworks\ApiClient\Subjects
- Metroworks\ApiClient\Reviews



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
