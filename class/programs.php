<?php
/**
 * A class that contains code to implement a documents page
 *
 * @author Tom Ford <t.ford@ncl.ac.uk>
 * @copyright 2015 Newcastle University
 *
 */

    class Programs extends Siteaction
    {
      /**
       * Handle documents operations /documents/xxxx
       *
       * @param object $context The context object for the site
       *
       * @return string    A template name
       */

        public function handle($context)
        {

            /**
             * ASK LINDSAY HOW TO CALL SITE INFO HERE??
             * HOW can I call findALL?? to get all students
             * ALSO HOW TO PASS IN AN ARRAY WITH ADDVAL!
             */
//            SiteInfo::students();

            $studentID = R::findOne('rolename', 'name = ?', [ 'Student' ])->id;
//
//            $idsOfStudents = R::findAll('role', 'rolename_id = ?', [$studentID]);
//
//            $p = array_map(function($s){return $s->user_id;}, $idsOfStudents);
//
//            $students = array();
//            foreach ($p as $id)
//            {
//                array_push($students, R::findOne('user', 'id = ?', [$id]));
//            }


//            $context->local()->addval('s', $idsOfStudents); // add to local



//            $themes = siteinfo.themes(); How do I call this? Ask Lindsay
            $context->local()->addval('donesearch', true);

            $themes = R::findAll('theme', 'order by id'); //find all theme beans
            $context->local()->addval('themes', $themes); // add to local

//            $context->local()->addval('done', true);
//
            /**
             * Content only executes when there is a post with search in the paramaters
             */
            $formd = $context->formdata(); //Gets parameters out of page! Use as search bar!
            if (($searchval = $formd->post('search', '')) !== '')
            {
                $context->local()->addval('searchval', $searchval);
                $results  = R::findOne( 'theme', ' name LIKE ? ', array($searchval) );
//                $context->local()->addval('searches', $results);
                $context->local()->addval('searches', $results);
                $context->local()->addval('donesearch', true);

            }


            return 'programs.twig';
        }
    }
?>
