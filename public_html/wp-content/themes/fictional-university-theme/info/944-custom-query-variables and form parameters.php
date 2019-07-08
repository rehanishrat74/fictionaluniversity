

fictional-university.dev/about-us/?skyColor=blue
s for search
p for pagination.

to use custom query variables , we need to register variables.

Files: functions.php
add_filter( 'query_vars', 'universityQueryVars');
registered variable = 'skyBlue';

in page.php, we will check skyBlue query variable value.
$skyColorValue=sanitize_text_field(get_query_var('skyColor')); // to prevent injections.


in page.php, we will create a form and will pass query parameters.
