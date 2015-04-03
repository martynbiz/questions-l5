today:
- reply to politics posts
- phone pam
- tax forms?





Adv of laravel ( ͡° ͜ʖ ͡°)

auth & csrf out-the-box
generator tool
tinker tool
dd()
array_* functions
testing


..adv for QA?

easier to organise subfolder routes (e.g. admin/.. account/..)
great mailer
much MUCH better asset management (gulp)
much cleaner, less code - less dev time






? admin/tags/delete bug
? how to put $auth in Controller so all controllers can access it?

..migrating
can still use ZF1 as a dependancy, as components (e.g. Zend_Locale)


? build caching into models - http://laravel.com/docs/4.2/queries (caching queries - removed?)
http://laravel.io/forum/03-28-2015-if-i-wanted-to-create-a-simple-library-class-api-client-in-laravel-5-where-would-i-put-it
? languages -- any tools?



THINGS/ WAYS TO TEST
- controllers: routes are ok
- models: relationships, custom methods
- Metroworks\Http\Reputation (points)












TODO

? 'url' => 'http://localhost:8000', // can this be the proper url? APP_URL?
? http://stackoverflow.com/questions/29369589/trying-to-install-pear-extension-with-composer
? does laravel have any out-of-the-box http clients
- "guzzlehttp/guzzle": "5.0.*@dev",




account - questions, answers, profile


AUTH
- switch over to SSO, keep the same methods on Auth
- allow it so that you can switch between auth systems easy enough



MIGRATE HTML, CSS, etc
- assets - revise again
- Theme - teepluss/laravel-theme
- bring in CSS, js
- admin: second layout, console style


Question
- total_views?



TEST CASES
- notification emails - reg and answer


Testing
- how to mock auth?
test - models, controllers (uses requests?), requests?


admin.users.show last logged in

JS
- more questions button
- ckeditor - questions and answers
- votes widget
- infinate scrolling - laravel respond json; backbone, mustache templates
- votes widget/ controller?
- http://ifightcrime.github.io/bootstrap-growl/

composer package: -- look at providers too, i'm not sure what's different about them
metroworks\laravel-tools
- Metroworks\Laravel5\Middleware\SamlPassiveLogin
- Metroworks\Laravel5\Middleware\AuthenticateAdmin
- Metroworks\Http\Reputation (points)
- Metroworks\Http\Subjects
- Metroworks\Http\Reviews
- Metroworks\Http\Solr?






docs
sso - remove the auth library from laravel, move into composer - Metroworks\Auth\Registrar;
.. or provider? which can i configure?
solr
teepluss


ENHANCEMENTS
- redesign topnav - empty panels, loaded with ajax; clicking main buttons takes you somewhere; slide down
- view helper to generate urls from questions (e.g. localhost:8000/1/slug)






TIDY UPs

bring in Text/Password.php with composer? -- do we need it??







load testing - zend qa vs laravel


DOCS

Everything get's returned to the view as an array. This is so that js can also fetch the same data without some complicated conversions (as front end templates cannot use 

gulp and phpunit testing

every model has date_* attributes (e.g. date_created)

don't delete users as we don't remove questions. to revoke their access, either disable or delete on sso