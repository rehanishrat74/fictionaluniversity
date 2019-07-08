copy past single-event.php into single-professor.php.

from custom fields , show related programs to event and professors.


we want to show relationship between professors and programs

single-professor.php displays the professor and his related programs(subjects) taught by this professor.
so in programs(subjects), we do want to show corresponding profesors.
lets edit single-program.php

so we split the relations ships in single-program.php into two seperate files.
<?php  include 'single-program_relationship1with_events.php'; ?>
and
<?php  include 'single-program_relationship2with_professors.php'; ?>
